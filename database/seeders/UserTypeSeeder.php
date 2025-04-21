<?php

namespace Database\Seeders;

use App\Models\UserType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            'Super Admin',
            'Admin',
            'Student',
        ];

        foreach ($types as $type) {
            UserType::firstOrCreate(['title' => $type]);
        }
    }
}
