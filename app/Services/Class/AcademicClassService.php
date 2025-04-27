<?php

namespace App\Services\Class;

use App\Models\AcademicClass;

class AcademicClassService
{
    public function __construct()
    {
        //
    }

    public function index(): object
    {
        return AcademicClass::orderBy('en_name', 'asc')
            ->get();
    }

    public function store(array $data): object
    {
        return AcademicClass::create($data);
    }

    public function update(array $data, AcademicClass $class): bool
    {
        return $class->update($data);
    }

    public function softDelete(AcademicClass $class): bool
    {
        return $class->delete();
    }
}
