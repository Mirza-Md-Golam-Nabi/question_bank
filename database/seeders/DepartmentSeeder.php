<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\AcademicClass;
use Illuminate\Database\Seeder;
use Database\Seeders\Concerns\SeederHelper;

class DepartmentSeeder extends Seeder
{
    use SeederHelper;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classes = $this->getAcademicClasses();

        $departments = $this->getDepartments();

        foreach ($classes as $class) {
            $class_id = AcademicClass::where('name', $class)->value('id');

            foreach ($departments as $department) {
                Department::firstOrCreate([
                    'academic_class_id' => $class_id,
                    'name' => $department
                ]);
            }
        }
    }
}
