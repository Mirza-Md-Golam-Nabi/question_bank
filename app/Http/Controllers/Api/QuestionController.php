<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Question;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Services\Question\QuestionService;
use App\Http\Requests\Question\StoreQuestionRequest;
use App\Http\Requests\Question\UpdateQuestionRequest;

class QuestionController extends Controller
{
    protected $question;

    public function __construct()
    {
        $this->question = new QuestionService();
    }

    public function index(): JsonResponse
    {
        $questions = $this->question->index();
        return formatResponse(0, 200, 'Success', $questions);
    }

    public function store(StoreQuestionRequest $request): JsonResponse
    {
        try {
            $question = $this->question->store($request->validated());

            return formatResponse(0, 200, 'Success', $question);
        } catch (Exception $e) {
            return formatResponse(1, 500, $e->getMessage(), null);
        }
    }

    public function show(Question $question): JsonResponse
    {
        return formatResponse(0, 200, 'Success', $question->load('question_option'));
    }

    public function update(UpdateQuestionRequest $request, Question $question): JsonResponse
    {
        try {
            $this->question->update($request->validated(), $question);

            return formatResponse(0, 200, 'Success', $question->load('question_option')->refresh());
        } catch (Exception $e) {
            return formatResponse(1, 500, $e->getMessage(), null);
        }
    }

    public function destroy(Question $question): JsonResponse
    {
        try {
            $delete = $this->question->softDelete($question);

            if (! $delete) {
                return formatResponse(1, 400, 'Error! Please try again.', null);
            }

            return formatResponse(0, 200, 'Success', $this->question->index());
        } catch (Exception $e) {
            return formatResponse(1, 500, $e->getMessage(), null);
        }
    }
}
