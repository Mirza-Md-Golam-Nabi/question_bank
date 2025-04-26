<?php

namespace Database\Seeders;

use App\Models\AcademicClass;
use Illuminate\Database\Seeder;

class AcademicClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classes = [
            'Class 09-10',
            'Class 11-12',
        ];

        foreach ($classes as $class) {
            AcademicClass::firstOrCreate(['name' => $class]);
        }
    }
}
