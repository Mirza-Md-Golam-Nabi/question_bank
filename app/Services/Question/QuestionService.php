<?php

namespace App\Services\Question;

use App\Models\Question;
use Illuminate\Support\Facades\DB;

class QuestionService
{
    public function __construct()
    {
        //
    }

    public function index(): object
    {
        return Question::with('question_option')
            ->orderBy('subject_id', 'asc')
            ->orderBy('chapter_id', 'asc')
            ->orderBy('topic_id', 'asc')
            ->orderBy('question_text', 'asc')
            ->get();
    }

    public function store(array $data): object
    {
        return DB::transaction(function () use ($data) {
            $question = Question::create($data);

            $question->question_option()->create([
                'options' => $data['options'],
            ]);

            $question->users()->attach(authUser()->id);

            return $question->load('question_option', 'users');
        });
    }

    public function update(array $data, Question $question): bool
    {
        return DB::transaction(function () use ($question, $data) {
            $question->update($data);

            $question->question_option()->update([
                'options' => $data['options'],
            ]);

            return true;
        });
    }

    public function softDelete(Question $question): bool
    {
        return DB::transaction(function () use ($question) {
            $question_delete = $question->delete();

            $option_delete = $question->question_option()->delete();

            return $question_delete && $option_delete;
        });
    }
}
