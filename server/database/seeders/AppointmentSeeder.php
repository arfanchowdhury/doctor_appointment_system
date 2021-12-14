<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $doctor  = User::doctors()->first();
        $patient = User::patients()->first();

        Appointment::insert([
            [
                'doctor_id'        => $doctor->id,
                'patient_id'       => $patient->id,
                'appointment_date' => now()->format('Y-m-d'),
                'start_at'         => '11:00',
                'end_at'           => '11:30',
                'is_pending'       => true,
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
        ]);
    }
}
