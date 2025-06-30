<?php

namespace Database\Seeders;

use App\Models\AcademicClass;
use Illuminate\Database\Seeder;
use Database\Seeders\Concerns\SeederHelper;

class AcademicClassSeeder extends Seeder
{
    use SeederHelper;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classes = $this->getAcademicClasses();

        foreach ($classes as $class) {
            AcademicClass::firstOrCreate(
                ['name' => $class],
            );
        }
    }
}
