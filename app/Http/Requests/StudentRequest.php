<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $studentId = $this->route('student') ? $this->route('student')->id : null;

        return [
            'admission_number' => 'required|string|unique:students,admission_number,' . $studentId,
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|digits:11|max:255',
            'academic_classes_id' => 'required|exists:academic_classes,id',
            'guardians_id' => 'nullable|exists:guardians,id',
            'user_id' =>'required|exists:users,id|unique:students,user_id,'. $studentId,
        ];
    }
}
