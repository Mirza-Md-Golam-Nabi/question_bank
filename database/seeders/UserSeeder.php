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
                'email' => 'golamnabi411330@gmail.com',
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
                'email' => 'golamnabi@gmail.com',
                'user_type_id' => 2,
                'password' => 12345678,
            ]
        );

        User::firstOrCreate(
            [
                'phone' => '01825712674',
            ],
            [
                'name' => 'Student',
                'email' => 'golamnabi@gmail.com',
                'user_type_id' => 3,
                'password' => 12345678,
            ]
        );
    }
}
