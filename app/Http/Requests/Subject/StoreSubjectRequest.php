<?php

namespace App\Http\Requests\Subject;

use Illuminate\Validation\Rule;
use App\Http\Requests\BaseRequest;

class StoreSubjectRequest extends BaseRequest
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
        $department_id = $this->input('department_id');

        return [
            'department_id' => ['required', 'integer', 'exists:departments,id'],
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('subjects', 'name')
                    ->where(fn($query) => $query->where('department_id', $department_id))
                    ->ignore($subject_id)
            ]
        ];
    }
}
