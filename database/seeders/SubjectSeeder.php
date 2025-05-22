<?php

namespace Database\Seeders;

use App\Models\AcademicClass;
use App\Models\Department;
use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = $this->departmentList();
        $subjects = $this->subjectList();

        foreach ($departments as $department) {
            $class_id = AcademicClass::where('name', 'Class 11-12')->value('id') ?? AcademicClass::first()?->id;

            $dept_id = Department::where('name', $department)->value('id');

            foreach ($subjects[$department] as $subject) {
                Subject::firstOrCreate(
                    ['name' => $subject],
                    [
                        'class_id' => $class_id,
                        'department_id' => $dept_id,
                    ]
                );
            }
        }
    }

    protected function departmentList(): array
    {
        return [
            'Science',
            'Commerce',
            'Arts',
        ];
    }

    protected function subjectList(): array
    {
        return [
            'Science' => [
                'Higher Mathematics',
                'Physics',
                'Chemistry',
                'Biology',
            ],
            'Commerce' => [
                'Accounting',
                'Business Organization and Management',
                'Finance, Banking, and Insurance',
                'Production Management & Marketing',
            ],
            'Arts' => [
                'Economics',
                'History',
                'Geography',
                'Sociology',
            ],
        ];
    }
}
