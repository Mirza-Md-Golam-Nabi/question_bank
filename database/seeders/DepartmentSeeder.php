<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            ['en_name' => 'Science', 'bn_name' => 'বিজ্ঞান'],
            ['en_name' => 'Commerce', 'bn_name' => 'বাণিজ্য'],
            ['en_name' => 'Arts', 'bn_name' => 'মানবিক'],
        ];

        foreach ($departments as $department) {
            Department::firstOrCreate(
                ['en_name' => $department['en_name']],
                ['bn_name' => $department['bn_name']]
            );
        }
    }
}
