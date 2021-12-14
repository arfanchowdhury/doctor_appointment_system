<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PatientController extends Controller
{
    public function getPatientForAdmin()
    {
        $patients = User::patients()->get();

        return response()->json([
            'data'   => $patients,
            'status' => sizeof($patients) ? true : false,
        ]);
    }

    public function getPatientForDoctor()
    {
        $patients = DB::table('appointments')
            ->join('users', 'appointments.patient_id', '=', 'users.id')
            ->where('appointments.doctor_id', Auth()->user()->id)
            ->where('appointment_date', date('Y-m-d'))
            ->select('users.name as name', 'users.email as email')
            ->get();

        return response()->json([
            'data'   => $patients->unique(),
            'status' => sizeof($patients) ? true : false,
        ]);
    }
}
