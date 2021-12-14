<?php

namespace Database\Seeders;

use App\Models\Day;
use Illuminate\Database\Seeder;

class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Day::insert([
            [
                'name'       => 'Saturday',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Sunday',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Monday',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Tuesday',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Wednesday',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Thursday',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Friday',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
