<?php

namespace App\Http\Controllers\Api;

use App\Models\AcademicClass;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Services\Class\AcademicClassService;
use App\Http\Requests\AcademicClass\StoreAcademicClassRequest;
use App\Http\Requests\AcademicClass\UpdateAcademicClassRequest;

class AcademicClassController extends Controller
{
    protected $academic_class;

    public function __construct()
    {
        $this->academic_class = new AcademicClassService();
    }

    public function index(): JsonResponse
    {
        $classes = $this->academic_class->index();
        return formatResponse(0, 200, 'Success', $classes);
    }

    public function store(StoreAcademicClassRequest $request): JsonResponse
    {
        $class = $this->academic_class->store($request->validated());
        return formatResponse(0, 200, 'Success', $class);
    }

    public function show(AcademicClass $class): JsonResponse
    {
        return formatResponse(0, 200, 'Success', $class);
    }

    public function update(UpdateAcademicClassRequest $request, AcademicClass $class): JsonResponse
    {
        $this->academic_class->update($request->validated(), $class);
        return formatResponse(0, 200, 'Success', $class->refresh());
    }

    public function destroy(AcademicClass $class): JsonResponse
    {
        $this->academic_class->softDelete($class);
        return $this->index();
    }
}


