<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $teacherId = $this->route('teacher') ? $this->route('teacher')->id : null;

        return [
            'user_id' => 'required|exists:users,id|unique:teachers,user_id,' . $teacherId,
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'subject_id' => 'required|exists:subjects,id',
            'qualification' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'admission_number' => 'required|string|unique:teachers,admission_number,' . $teacherId,
            'gender' => 'required|in:male,female',
        ];
    }

    /**
     * Get the validation rules that apply to the store request.
     *
     * @return array
     */
    
}
