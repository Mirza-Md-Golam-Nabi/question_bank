<?php

namespace App\Http\Controllers\Api;

use App\Models\Department;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Services\Department\DepartmentService;
use App\Http\Requests\Department\DepartmentRequest;
use App\Http\Requests\Department\StoreDepartmentRequest;
use App\Http\Requests\Department\UpdateDepartmentRequest;

class DepartmentController extends Controller
{
    protected $department;

    public function __construct()
    {
        $this->department = new DepartmentService();
    }

    public function index(DepartmentRequest $request): JsonResponse
    {
        $class_id = $request->class_id;

        $departments = $this->department->index($class_id);

        return formatResponse(0, 200, 'Success', $departments);
    }

    public function store(StoreDepartmentRequest $request): JsonResponse
    {
        $department = $this->department->store($request->validated());

        return formatResponse(0, 200, 'Success', $department);
    }

    public function show(Department $department): JsonResponse
    {
        return formatResponse(0, 200, 'Success', $department);
    }

    public function update(UpdateDepartmentRequest $request, Department $department): JsonResponse
    {
        $this->department->update($request->validated(), $department);

        return formatResponse(0, 200, 'Success', $department->refresh());
    }

    public function destroy(Department $department): JsonResponse
    {
        $class_id = $department->academic_class_id;

        $this->department->softDelete($department);

        $request = $this->customDepartmentRequest($class_id);

        return $this->index($request);
    }

    private function customDepartmentRequest(int $class_id)
    {
        $request = new DepartmentRequest();

        return $request->merge(['class_id' => $class_id]);
    }
}
