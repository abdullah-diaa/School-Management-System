<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttendanceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'student_id' => 'required|exists:students,id',
            'academic_classes_id' => 'required|exists:academic_classes,id',
            'date' => 'required|date',
            'status' => 'required|boolean',
            'remarks' => 'nullable|string',
        ];
    }
}
