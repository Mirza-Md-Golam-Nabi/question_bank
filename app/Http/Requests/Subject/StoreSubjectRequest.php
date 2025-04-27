<?php

namespace App\Http\Requests\Subject;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class StoreSubjectRequest extends FormRequest
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
        $subject_id = $this->subject?->id ?? null;

        return [
            'class_id' => ['required', 'integer', 'exists:academic_classes,id'],
            'department_id' => ['required', 'integer', 'exists:departments,id'],
            'en_name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('subjects', 'en_name')
                    ->ignore($subject_id)
            ],
            'bn_name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('subjects', 'bn_name')
                    ->ignore($subject_id)
            ]
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
