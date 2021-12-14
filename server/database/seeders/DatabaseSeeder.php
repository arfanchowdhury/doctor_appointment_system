<?php

namespace Database\Seeders;

use App\Models\Speciality;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BloodGroupSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(SpecialitySeeder::class);
        $this->call(DaySeeder::class);
        $this->call(ScheduleSeeder::class);
        $this->call(AppointmentSeeder::class);

        $specialities = Speciality::all();
        User::doctors()->get()->each(function ($user) use ($specialities)
        {
            $user->specialities()->attach(
                $specialities->random(2)->pluck('id')->toArray(),
            );
        });
    }
}
