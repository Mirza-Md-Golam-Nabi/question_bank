<?php

namespace App\Http\Controllers\Api;

use App\Models\Subject;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Services\Subject\SubjectService;
use App\Http\Requests\Subject\StoreSubjectRequest;
use App\Http\Requests\Subject\SubjectRequest;
use App\Http\Requests\Subject\UpdateSubjectRequest;

class SubjectController extends Controller
{
    protected $subject;

    public function __construct()
    {
        $this->subject = new SubjectService();
    }

    public function index(SubjectRequest $request): JsonResponse
    {
        $department_id = $request->department_id;

        $subjects = $this->subject->index($department_id);

        return formatResponse(0, 200, 'Success', $subjects);
    }

    public function store(StoreSubjectRequest $request): JsonResponse
    {
        $subject = $this->subject->store($request->validated());

        return formatResponse(0, 200, 'Success', $subject);
    }

    public function show(Subject $subject): JsonResponse
    {
        return formatResponse(0, 200, 'Success', $subject);
    }

    public function update(UpdateSubjectRequest $request, Subject $subject): JsonResponse
    {
        $this->subject->update($request->validated(), $subject);

        return formatResponse(0, 200, 'Success', $subject->refresh());
    }

    public function destroy(Subject $subject): JsonResponse
    {
        $department_id = $subject->department_id;

        $this->subject->softDelete($subject);

        $request = $this->customDepartmentRequest($department_id);

        return $this->index($request);
    }

    protected function customDepartmentRequest(int $department_id)
    {
        $request = new SubjectRequest();

        return $request->merge([
            'department_id' => $department_id
        ]);
    }
}
