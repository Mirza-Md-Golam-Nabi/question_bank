<?php

namespace Database\Seeders\Concerns;

trait SeederHelper
{
    protected function getAcademicClasses(): array
    {
        return [
            'Class 09-10',
            'Class 11-12',
        ];
    }

    protected function getDepartments(): array
    {
        return [
            'Science',
            'Commerce',
            'Arts',
        ];
    }

    protected function getSchoolSubjectList(): array
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

    protected function getCollegeSubjectList(): array
    {
        return [
            'Science' => [
                'Higher Mathematics 1st Paper',
                'Physics 1st Paper',
                'Chemistry 1st Paper',
                'Biology 1st Paper',
                'Higher Mathematics 2nd Paper',
                'Physics 2nd Paper',
                'Chemistry 2nd Paper',
                'Biology 2nd Paper',
            ],
            'Commerce' => [
                'Accounting 1st Paper',
                'Business Organization and Management 1st Paper',
                'Finance, Banking, and Insurance 1st Paper',
                'Production Management & Marketing 1st Paper',
                'Accounting 2nd Paper',
                'Business Organization and Management 2nd Paper',
                'Finance, Banking, and Insurance 2nd Paper',
                'Production Management & Marketing 2nd Paper',
            ],
            'Arts' => [
                'Economics 1st Paper',
                'History 1st Paper',
                'Geography 1st Paper',
                'Sociology 1st Paper',
                'Economics 2nd Paper',
                'History 2nd Paper',
                'Geography 2nd Paper',
                'Sociology 2nd Paper',
            ],
        ];
    }
}
