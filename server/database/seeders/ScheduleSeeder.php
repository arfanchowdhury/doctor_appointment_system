<?php

namespace Database\Seeders;

use App\Models\Day;
use App\Models\User;
use App\Models\Schedule;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $doctors = User::doctors()->get();
        $days    = Day::all();

        foreach ($doctors as $doctor)
        {
            foreach ($days as $day)
            {
                Schedule::create(
                    [
                        'user_id'        => $doctor->id,
                        'day_id'         => $day->id,
                        'start_at'       => '09:00',
                        'end_at'         => '18:00',
                        'break_start_at' => '14:00',
                        'break_end_at'   => '15:00',
                        'is_offday'      => Str::lower($day->name)  == 'friday' ? 1 : 0,
                        'created_at'     => now(),
                        'updated_at'     => now(),
                    ],
                );
            }
        }

    }
}
