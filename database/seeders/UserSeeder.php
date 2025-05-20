<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            [
                'phone' => '01825712671',
            ],
            [
                'name' => 'Super Admin',
                'email' => 'super_admin@gmail.com',
                'user_type_id' => 1,
                'password' => 12345678,
            ]
        );

        User::firstOrCreate(
            [
                'phone' => '01689325961',
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'user_type_id' => 2,
                'password' => 12345678,
            ]
        );

        User::firstOrCreate(
            [
                'phone' => '01825712672',
            ],
            [
                'name' => 'Student',
                'email' => 'student@gmail.com',
                'user_type_id' => 3,
                'password' => 12345678,
            ]
        );

        User::firstOrCreate(
            [
                'phone' => '01825712673',
            ],
            [
                'name' => 'Data Entry',
                'email' => 'data_entry@gmail.com',
                'user_type_id' => 4,
                'password' => 12345678,
            ]
        );
    }
}
