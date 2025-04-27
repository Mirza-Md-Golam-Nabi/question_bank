<?php

namespace App\Services\Department;

use App\Models\Department;

class DepartmentService
{
    public function __construct()
    {
        //
    }

    public function index(): object
    {
        return Department::orderBy('en_name', 'asc')
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
