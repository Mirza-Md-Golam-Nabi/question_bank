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
}
