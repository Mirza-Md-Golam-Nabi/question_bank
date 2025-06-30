<?php

namespace App\Http\Requests\Department;

use Illuminate\Validation\Rule;
use App\Http\Requests\BaseRequest;

class StoreDepartmentRequest extends BaseRequest
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
        $departmentId = $this->route('department');
        $class_id = $this->input('academic_class_id');

        return [
            'academic_class_id' => [
                'required',
                'exists:academic_classes,id'
            ],
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('departments', 'name')
                    ->where(fn($query) => $query->where('academic_class_id', $class_id))
                    ->ignore($departmentId),
            ]
        ];
    }
}
