<?php

namespace App\Http\Requests\Topic;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class StoreTopicRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return in_array(authUser()->user_type_id, [1, 2]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $topic_id = $this->topic?->id ?? null;

        return [
            'chapter_id' => [
                'required',
                'integer',
                'exists:chapters,id',
                Rule::unique('topics')
                    ->where('topic_order', request('topic_order'))
                    ->ignore($topic_id)
            ],
            'en_name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('topics')
                    ->where('chapter_id', request('chapter_id'))
                    ->ignore($topic_id)
            ],
            'bn_name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('topics')
                    ->where('chapter_id', request('chapter_id'))
                    ->ignore($topic_id)
            ],
            'topic_order' => [
                'required',
                'integer',
                'max:250',
                Rule::unique('topics')
                    ->where('chapter_id', request('chapter_id'))
                    ->ignore($topic_id)
            ]
        ];
    }

    public function messages()
    {
        return [
            'chapter_id.unique' => 'Please check chapter id and topic order',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $response = null;

        if ($this->is('api/*')) {
            $response = failedValidationForApi($validator);
        }

        $exception = $validator->getException();

        throw (new $exception($validator, $response))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}
