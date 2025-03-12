<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AcademicClassRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'class_name' => 'required|string|max:255',
            'class_level' => 'required|string|max:255',
            'class_description' => 'nullable|string',
            'class_teacher_id' => 'nullable|exists:teachers,id',
            'capacity' => 'nullable|integer',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            // ... other validation rules
        ];
    }
}
