<?php

namespace App\Services\Department;

use App\Models\Department;

class DepartmentService
{
    public function __construct()
    {
        //
    }

    public function index(int $class_id): object
    {
        return Department::where('academic_class_id', $class_id)
            ->orderBy('name', 'asc')
            ->get();
    }

    public function store(array $data): object
    {
        return Department::create($data);
    }

    public function update(array $data, Department $department): bool
    {
        return $department->update($data);
    }

    public function softDelete(Department $department): bool
    {
        return $department->delete();
    }
}
