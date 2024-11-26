<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class TaskStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'doer' => 'required',
            'title' => 'required',
            'description' => 'nullable',
            'file' => 'nullable|mimes:doc,docx,pdf,xls,xlsx,ppt,pptx',
            'deadline' => 'required|date',
            'category_id' => 'required|integer',
            'area_id' => 'required|array',
        ];
    }

    public function messages()
    {
        return [
            'doer.required' => 'The task should have a some doer',
            'title.required' => 'The task should have a some title',
            'file.mimes' => 'The file should be the type of doc,docx,pdf,xls,xlsx,ppt,pptx',
            'deadline.required' => 'The deadline should be given for the task',
            'deadline.date' => 'The deadline should be a type of date',
            'category_id.required' => 'The category is should be shown',
            'category_id.integer' => 'The category is should be a type of integer',
            'area_id.required' => 'The area is should be shown',
            'area_id.array' => 'The area is should be a type of array',
        ];
    }
}
