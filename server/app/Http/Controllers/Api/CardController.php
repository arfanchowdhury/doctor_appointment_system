<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\User;

class CardController extends Controller
{
    public function getUserCardDetails()
    {
        if (Auth()->user()->role_id == 2)
        {
            $appointments = Appointment::where('doctor_id', Auth()->user()->id)->get();
        }
        else if (Auth()->user()->role_id == 3)
        {
            $appointments = Appointment::where('patient_id', Auth()->user()->id)->get();
        }
        $total     = $appointments->count();
        $completed = $appointments->where('is_pending', 0)->count();
        $cancelled = $appointments->where('appointment_date', '<', date('Y-m-d'))->where('is_pending', 1)->count();
        $pending   = $appointments->where('appointment_date', '>=', date('Y-m-d'))->where('is_pending', 1)->count();

        return response()->json([
            'total'     => $total,
            'completed' => $completed,
            'cancelled' => $cancelled,
            'pending'   => $pending,
        ]);
    }

    public function getAdminCardDetails()
    {
        $user         = User::all();
        $users        = $user->count();
        $doctors      = $user->where('role_id', 2)->count();
        $patients     = $user->where('role_id', 3)->count();
        $appointments = Appointment::all()->count();

        return response()->json([
            'users'        => $users,
            'doctors'      => $doctors,
            'patients'     => $patients,
            'appointments' => $appointments,
        ]);

    }
}
