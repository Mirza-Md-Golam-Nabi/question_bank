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
            $class_id = AcademicClass::where('en_name', 'Class 11-12')->value('id') ?? AcademicClass::first()?->id;

            $dept_id = Department::where('en_name', $department)->value('id');

            foreach ($subjects[$department] as $subject) {
                Subject::firstOrCreate(
                    ['en_name' => $subject['en_name']],
                    [
                        'class_id' => $class_id,
                        'department_id' => $dept_id,
                        'bn_name' => $subject['bn_name']
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
                [
                    'en_name' => 'Higher Mathematics',
                    'bn_name' => 'উচ্চতর গণিত'
                ],
                [
                    'en_name' => 'Physics',
                    'bn_name' => 'পদার্থ বিজ্ঞান'
                ],
                [
                    'en_name' => 'Chemistry',
                    'bn_name' => 'রসায়ন'
                ],
                [
                    'en_name' => 'Biology',
                    'bn_name' => 'জীব বিজ্ঞান'
                ]
            ],
            'Commerce' => [
                [
                    'en_name' => 'Accounting',
                    'bn_name' => 'হিসাববিজ্ঞান'
                ],
                [
                    'en_name' => 'Business Organization and Management',
                    'bn_name' => 'ব্যবসায় সংগঠন ও ব্যবস্থাপনা'
                ],
                [
                    'en_name' => 'Finance, Banking, and Insurance',
                    'bn_name' => 'অর্থসংস্থান, ব্যাংকিং ও বীমা'
                ],
                [
                    'en_name' => 'Production Management & Marketing',
                    'bn_name' => 'উৎপাদন ব্যবস্থাপনা ও বিপণন'
                ]
            ],
            'Arts' => [
                [
                    'en_name' => 'Economics',
                    'bn_name' => 'অর্থনীতি'
                ],
                [
                    'en_name' => 'History',
                    'bn_name' => 'ইতিহাস'
                ],
                [
                    'en_name' => 'Geography',
                    'bn_name' => 'ভূগোল'
                ],
                [
                    'en_name' => 'Sociology',
                    'bn_name' => 'সমাজ বিজ্ঞান'
                ]
            ],
        ];
    }
}
