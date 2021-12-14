<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $blood_groups = collect([1, 2, 3, 4, 5]);

        User::insert([
            [
                'name'           => 'Administrator',
                'email'          => 'admin@admin.com',
                'password'       => bcrypt('secret'),
                'role_id'        => 1,
                'created_at'     => now(),
                'updated_at'     => now(),
                'gender'         => 1,
                'birth_date'     => '1997-01-01',
                'phone_no'       => '01234567891',
                'address'        => 'Chittagong',
                'blood_group_id' => $blood_groups->random(),
                'gap'            => null,
            ],
            [
                'name'           => 'Dr. Mohammad Kafil Uddin',
                'email'          => 'kafil@gmail.com',
                'password'       => bcrypt('secret'),
                'role_id'        => 2,
                'created_at'     => now(),
                'updated_at'     => now(),
                'gender'         => 1,
                'birth_date'     => '1997-01-01',
                'phone_no'       => '01234567892',
                'address'        => 'Chittagong',
                'blood_group_id' => $blood_groups->random(),
                'gap'            => 30,
            ],
            [
                'name'           => 'Dr. Mohd. Ibrahim Khalil Ullah',
                'email'          => 'khalil@gmail.com',
                'password'       => bcrypt('secret'),
                'role_id'        => 2,
                'created_at'     => now(),
                'updated_at'     => now(),
                'gender'         => 1,
                'birth_date'     => '1997-01-01',
                'phone_no'       => '01234567893',
                'address'        => 'Chittagong',
                'blood_group_id' => $blood_groups->random(),
                'gap'            => 30,
            ],
            [
                'name'           => 'Prof. Dr. Mohammad Masud Karim',
                'email'          => 'karim@gmail.com',
                'password'       => bcrypt('secret'),
                'role_id'        => 2,
                'created_at'     => now(),
                'updated_at'     => now(),
                'gender'         => 1,
                'birth_date'     => '1997-01-01',
                'phone_no'       => '01234567894',
                'address'        => 'Chittagong',
                'blood_group_id' => $blood_groups->random(),
                'gap'            => 30,
            ],
            [
                'name'           => 'Ridwan',
                'email'          => 'ridwan@gmail.com',
                'password'       => bcrypt('secret'),
                'role_id'        => 3,
                'created_at'     => now(),
                'updated_at'     => now(),
                'gender'         => 1,
                'birth_date'     => '1997-01-01',
                'phone_no'       => '01234567895',
                'address'        => 'Chittagong',
                'blood_group_id' => $blood_groups->random(),
                'gap'            => null,
            ],
            [
                'name'           => 'Ankan',
                'email'          => 'ankan@gmail.com',
                'password'       => bcrypt('secret'),
                'role_id'        => 3,
                'created_at'     => now(),
                'updated_at'     => now(),
                'gender'         => 1,
                'birth_date'     => '1997-01-01',
                'phone_no'       => '01234567896',
                'address'        => 'Chittagong',
                'blood_group_id' => $blood_groups->random(),
                'gap'            => null,
            ],
            [
                'name'           => 'Arfan',
                'email'          => 'arfan@gmail.com',
                'password'       => bcrypt('secret'),
                'role_id'        => 3,
                'created_at'     => now(),
                'updated_at'     => now(),
                'gender'         => 1,
                'birth_date'     => '1997-01-01',
                'phone_no'       => '01234567897',
                'address'        => 'Chittagong',
                'blood_group_id' => $blood_groups->random(),
                'gap'            => null,
            ],
        ]);
    }
}
