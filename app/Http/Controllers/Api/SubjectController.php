<?php

namespace App\Http\Controllers\Api;

use App\Models\Subject;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Services\Subject\SubjectService;
use App\Http\Requests\Subject\StoreSubjectRequest;
use App\Http\Requests\Subject\UpdateSubjectRequest;

class SubjectController extends Controller
{
    protected $subject;

    public function __construct()
    {
        $this->subject = new SubjectService();
    }

    public function index(): JsonResponse
    {
        $subjects = $this->subject->index()->load('academic_class', 'department');
        return formatResponse(0, 200, 'Success', $subjects);
    }

    public function store(StoreSubjectRequest $request): JsonResponse
    {
        $subject = $this->subject->store($request->validated());
        return formatResponse(0, 200, 'Success', $subject);
    }

    public function show(Subject $subject): JsonResponse
    {
        $subject->load('academic_class', 'department');
        return formatResponse(0, 200, 'Success', $subject);
    }

    public function update(UpdateSubjectRequest $request, Subject $subject): JsonResponse
    {
        $this->subject->update($request->validated(), $subject);
        return formatResponse(0, 200, 'Success', $subject->refresh()->load('academic_class', 'department'));
    }

    public function destroy(Subject $subject): JsonResponse
    {
        $this->subject->softDelete($subject);
        return $this->index();
    }
}
