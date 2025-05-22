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
            'ssc' => [
                'name' => 'Class 09-10',
            ],
            'hsc' => [
                'name' => 'Class 11-12',
            ],
        ];

        foreach ($classes as $class) {
            AcademicClass::firstOrCreate(
                ['name' => $class['name']],
            );
        }
    }
}
