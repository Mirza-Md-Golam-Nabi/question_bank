<?php

namespace App\Services\Subject;

use App\Models\Subject;

class SubjectService
{
    public function __construct()
    {
        //
    }

    public function index(int $department_id): object
    {
        return Subject::where('department_id', $department_id)
            ->orderBy('name', 'asc')
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
