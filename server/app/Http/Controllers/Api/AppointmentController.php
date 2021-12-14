<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Appointment\StoreAppointmentRequest;
use App\Http\Requests\Appointment\StoreDoctorAppointmentRequest;
use App\Http\Requests\Appointment\UpdateFeedbackRequest;
use App\Models\Appointment;
use App\Models\Day;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = null;

        if (Auth()->user()->role_id == 1)
        {
            $appointments = Appointment::all();
        }
        else if (Auth()->user()->role_id == 2)
        {
            $appointments = DB::table('users')
            ->join('appointments', 'users.id', '=', 'appointments.patient_id')
            ->where('appointments.doctor_id', Auth()->user()->id)
                ->select(
                    'users.name as patient_name',
                    'users.email as patient_email',
                    'users.phone_no as patient_phone_no',
                    'users.address as patient_address',
                    'users.gender as patient_gender',
                    'appointments.*',
                )
                ->where('is_pending', 1)
                ->orderBy('id', 'desc')
                ->get();

        }
        else if (Auth()->user()->role_id == 3)
        {
            $appointments = DB::table('users')
                ->join('appointments', 'users.id', '=', 'appointments.doctor_id')
                ->where('appointments.patient_id', Auth()->user()->id)
                ->select(
                    'users.name as doctor_name',
                    'users.email as doctor_email',
                    'users.phone_no as doctor_phone_no',
                    'users.address as doctor_address',
                    'appointments.*'
                )
                ->get();
        }

        $status = sizeof($appointments) ? true : false;

        return response()->json([
            'data'   => $appointments,
            'status' => $status,
        ]);
    }

    public function patientAppointmentStore(StoreAppointmentRequest $request)
    {
        $appointments = Appointment::where('doctor_id', $request->doctor_id)
            ->where('appointment_date', $request->appointment_date)
            ->select('start_at', 'end_at')
            ->get();

        $gap             = User::find($request->doctor_id)->gap;
        $day_id          = Day::where('name', date('l', strtotime($request->appointment_date)))->pluck('id');
        $doctor_schedule = Schedule::where('user_id', $request->doctor_id)
            ->where('day_id', $day_id)
            ->where('is_offday', 0)
            ->first();

        $status = false;

        if (!is_null($doctor_schedule))
        {
            $start_at       = date('H:i', strtotime($doctor_schedule->start_at));
            $end_at         = date('H:i', strtotime($doctor_schedule->end_at));
            $break_start_at = date('H:i', strtotime($doctor_schedule->break_start_at));
            $break_end_at   = date('H:i', strtotime($doctor_schedule->break_end_at));

            for ($i = 0; $start_at < $end_at; $i++)
            {
                $shift_start = $start_at;
                $shift_end   = date('H:i', strtotime($start_at) + 60 * $gap);

                if (($start_at < $break_start_at || $start_at >= $break_end_at)
                    && (!$appointments->contains('start_at', date('H:i:s', strtotime($start_at)))))
                {
                    $appointment = Appointment::create($request->validated() +
                        ['patient_id' => Auth()->user()->id] +
                        ['start_at' => $shift_start] +
                        ['end_at' => $shift_end]
                    );

                    $status = $appointment ? true : false;

                    break;
                }

                $start_at = date('H:i', strtotime($start_at) + 60 * $gap);
            }
        }

        return response()->json([
            'status' => $status,
        ]);
    }

    public function doctorAppointmentStore(StoreDoctorAppointmentRequest $request)
    {

        $appointment = Appointment::create($request->validated() + ['doctor_id' => Auth()->user()->id]);

        $status = $appointment ? true : false;

        return response()->json([
            'status' => $status,
        ]);
    }

    public function markAsChecked($id)
    {
        $status = Appointment::findOrFail($id)->update(['checked_at' => now(), 'is_pending' => 0]);

        return response()->json([
            'status' => $status,
        ]);
    }

    public function saveFeedback(UpdateFeedbackRequest $request, $id)
    {
        $appointment = Appointment::findOrFail($id);

        if (is_null($appointment->feedback))
        {
            $status = $appointment->update($request->validated());
        }
        else
        {
            $status = false;
        }

        return response()->json([
            'status' => $status,
        ]);
    }
}
