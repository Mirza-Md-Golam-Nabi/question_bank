<?php

namespace App\Http\Requests\Question;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class StoreQuestionRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return authUser()->isEligibleToAddQuestion();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'subject_id' => [
                'required',
                'exists:subjects,id'
            ],
            'chapter_id' => [
                'required',
                Rule::exists('chapters', 'id')->where(function ($query) {
                    $query->where('subject_id', request('subject_id'));
                }),
            ],
            'topic_id' => [
                'required',
                Rule::exists('topics', 'id')->where(function ($query) {
                    $query->where('chapter_id', request('chapter_id'));
                }),
            ],
            'question_text' => [
                'required',
                'string',
                'max:500'
            ],
            'correct_option_index' => [
                'required',
                'integer',
                'between:0,3'
            ],
            'options' => [
                'required',
                'array',
                'size:4'
            ],
        ];
    }
}
