<?php

namespace App\Services\Subject;

use App\Models\Subject;

class SubjectService
{
    public function __construct()
    {
        //
    }

    public function index(): object
    {
        return Subject::orderBy('class_id', 'asc')
            ->orderBy('department_id', 'asc')
            ->orderBy('en_name', 'asc')
            ->get();
    }

    public function store(array $data): object
    {
        return Subject::create($data);
    }

    public function update(array $data, Subject $subject): bool
    {
        return $subject->update($data);
    }

    public function softDelete(Subject $subject): bool
    {
        return $subject->delete();
    }
}
