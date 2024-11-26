<?php

namespace App\Http\Requests\UserTask;

use Illuminate\Foundation\Http\FormRequest;

class UserTaskUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required',
            'file' => 'nullable|mimes:doc,docx,pdf,xls,xlsx,ppt,pptx'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Title field should be filled.',
            'file.mimes' => 'The file should be a type of doc,docx,pdf,xls,xlsx,ppt,pptx'
        ];
    }
}
