<?php

namespace Database\Seeders;

use App\Models\Speciality;
use Illuminate\Database\Seeder;

class SpecialitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Speciality::insert([
            [
                'name'       => 'Aviation Medicine',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Cardiology',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Chest & Respiratory Medicine',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Colorectal Surgery',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Cancer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Cardiology & Medicine',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Chest diseases & Asthma',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Dentistry',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Diabetics',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Dermatology',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
