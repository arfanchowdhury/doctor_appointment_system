<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Schedule\UpdateScheduleRequest;
use App\Models\Appointment;
use App\Models\Day;
use App\Models\Schedule;
use App\Models\User;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules   = Schedule::where('user_id', Auth()->user()->id)->get();
        $days        = Day::all();
        $gap         = Auth()->user()->gap;
        $appointment = Appointment::where('doctor_id', Auth()->user()->id)
            ->where('appointment_date', '>=', now())->first();

        return response()->json([
            'schedules'       => $schedules,
            'days'            => $days,
            'gap'             => $gap,
            'has_appointment' => $appointment ? true : false,
            'status'          => sizeof($schedules) && !is_null($gap) ? true : false,
        ]);
    }

    public function update(UpdateScheduleRequest $request, Schedule $schedule)
    {
        $appointment = Appointment::where('doctor_id', Auth()->user()->id)
            ->where('appointment_date', '>=', now())->first();
        $status = false;

        if ($appointment == null)
        {
            $status = $schedule->update($request->validated());
        }

        return response()->json([
            'status' => $status,
        ]);
    }

    public function getDoctorSchedule($doctor_id, $date)
    {
        $patient_appointments = Appointment::where('patient_id', Auth()->user()->id)
            ->where('appointment_date', $date)
            ->get();

        $status = false;

        if ($patient_appointments->count() <= 2 && $patient_appointments->where('doctor_id', $doctor_id)->count() == 0)
        {
            $appointments = Appointment::where('doctor_id', $doctor_id)->where('appointment_date', $date)
                ->select('start_at', 'end_at')
                ->get();

            $gap             = User::find($doctor_id)->gap;
            $day_id          = Day::where('name', date('l', strtotime($date)))->pluck('id');
            $doctor_schedule = Schedule::where('user_id', $doctor_id)
                ->where('day_id', $day_id)
                ->where('is_offday', 0)
                ->first();

            if (!is_null($doctor_schedule))
            {
                $start_at       = date('H:i', strtotime($doctor_schedule->start_at));
                $end_at         = date('H:i', strtotime($doctor_schedule->end_at));
                $break_start_at = date('H:i', strtotime($doctor_schedule->break_start_at));
                $break_end_at   = date('H:i', strtotime($doctor_schedule->break_end_at));

                for ($i = 0; $start_at < $end_at; $i++)
                {
                    if (($start_at < $break_start_at || $start_at >= $break_end_at)
                        && (!$appointments->contains('start_at', date('H:i:s', strtotime($start_at)))))
                    {
                        $status = true;
                        break;
                    }

                    $start_at = date('H:i', strtotime($start_at) + 60 * $gap);
                }
            }
        }

        return response()->json([
            'status' => $status,
        ]);
    }

}
