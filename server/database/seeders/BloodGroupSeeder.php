<?php

namespace Database\Seeders;

use App\Models\BloodGroup;
use Illuminate\Database\Seeder;

class BloodGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BloodGroup::insert([
            [
                'name'       => 'A+',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'A-',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'B+',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'B-',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'O+',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'O-',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'AB+',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'AB-',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
