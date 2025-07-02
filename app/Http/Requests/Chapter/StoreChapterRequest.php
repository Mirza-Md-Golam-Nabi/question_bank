<?php

namespace App\Http\Requests\Chapter;

use Illuminate\Validation\Rule;
use App\Http\Requests\BaseRequest;

class StoreChapterRequest extends BaseRequest
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
        $chapter_id = $this->chapter?->id ?? null;

        return [
            'subject_id' => [
                'required',
                'integer',
                'exists:subjects,id',
                Rule::unique('chapters')
                    ->where('chapter_order', request('chapter_order'))
                    ->ignore($chapter_id)
            ],
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('chapters')
                    ->where('subject_id', request('subject_id'))
                    ->ignore($chapter_id)
            ],
            'chapter_order' => [
                'required',
                'integer',
                'max:250',
                Rule::unique('chapters')
                    ->where('subject_id', request('subject_id'))
                    ->ignore($chapter_id)
            ]
        ];
    }

    public function messages()
    {
        return [
            'subject_id.unique' => 'Please check subject id and chapter order',
        ];
    }
}
