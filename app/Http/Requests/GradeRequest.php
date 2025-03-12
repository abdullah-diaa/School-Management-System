<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GradeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
            'grade' => 'required|numeric|between:0,100', // Adjust based on your grading system
            'remark' => 'nullable|string|max:255',
            'academic_classes_id' => 'required|exists:academic_classes,id','student_id' => Rule::unique('grades')->where(function ($query) {
            return $query->where([
                'subject_id' => $this->subject_id,
                'academic_classes_id' => $this->academic_classes_id,
            ]);
        }),
            
        ];
    }
}
