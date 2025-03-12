<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuardianRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
{
    $guardianId = $this->route('guardian')->id ?? null; // Get the current guardian ID

    return [
        'father_name' => 'required|string|max:255',
        'mother_name' => 'required|string|max:255',
        'email' => 'required|email|unique:guardians,email,' . $guardianId,
        'phone_number' => 'required|string|digits:11|max:20|unique:guardians,phone_number,' . $guardianId,
        // Add other validation rules for additional fields as needed
    ];
}


    public function messages()
    {
        return [
            'email.unique' => 'The email address is already in use.',
            // Add custom messages for other rules as needed
        ];
    }
}
