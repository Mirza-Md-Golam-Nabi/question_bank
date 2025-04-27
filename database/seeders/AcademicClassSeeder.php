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
                'en_name' => 'Class 09-10',
                'bn_name' => 'ক্লাস ০৯-১০',
            ],
            'hsc' => [
                'en_name' => 'Class 11-12',
                'bn_name' => 'ক্লাস ১১-১২',
            ],
        ];

        foreach ($classes as $class) {
            AcademicClass::firstOrCreate(
                ['en_name' => $class['en_name']],
                ['bn_name' => $class['bn_name']]
            );
        }
    }
}
