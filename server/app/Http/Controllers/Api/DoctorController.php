<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Doctor\StoreDoctorRequest;
use App\Http\Requests\Doctor\UpdateGapRequest;
use App\Models\Appointment;
use App\Models\Day;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Support\Str;

class DoctorController extends Controller
{

    public function index()
    {
        $doctors = User::doctors()->with('specialities')->get();

        return response()->json([
            'data'   => $doctors,
            'status' => sizeof($doctors) ? true : false,
        ]);
    }

    public function store(StoreDoctorRequest $request)
    {
        $doctor = User::create($request->validated() + ['password' => 'secret'] + ['role_id' => 2] + ['gap' => 30]);
        User::find($doctor->id)->specialities()->attach($request->validated()['specialities']);
        $days = Day::all();

        foreach ($days as $day)
        {
            Schedule::create([
                'user_id'   => $doctor->id,
                'day_id'    => $day->id,
                'is_offday' => Str::lower($day->name) == 'friday' ? true : false]);
        }

        return response()->json([
            'status' => $doctor ? true : false,
        ]);
    }

    public function updateGap(UpdateGapRequest $request)
    {
        $appointment = Appointment::where('appointment_date', '>=', now())->first();
        $status      = false;

        if ($appointment == null)
        {
            $status = User::find(Auth()->user()->id)->update($request->validated());
        }

        return response()->json([
            'status' => $status,
        ]);
    }
}
