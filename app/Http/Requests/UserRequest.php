<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return $this->createRules();

            case 'PUT':
            case 'PATCH':
                return $this->updateRules();

            default:
                return [];
        }
    }

    private function createRules()
    {
        return [
            'user_name' => 'required|string|max:255|regex:/^[a-zA-Z0-9_]+$/|unique:users',
            'email' => 'required|email|unique:users,email',
            'password' =>  ['required', 'string', 'min:8'],
            'role' => 'required|in:Admin,Student,Teacher',
            'status' => 'required|in:1,0',
            'date_of_birth' => 'nullable|date',
            'profile_picture' => 'image|mimes:jpeg,png,jpg,gif,svg', // Removed trailing pipe
            'region' => 'nullable|string|max:255',
        ];
    }

    private function updateRules()
{
    $userId = $this->route('user');

    return [
        'user_name' => 'required|string|max:255|regex:/^[a-zA-Z0-9_]+$/|unique:users,user_name,' . $userId,
        'email' => 'required|email|unique:users,email,' . $userId,
        'password' =>  ['nullable', 'string', 'min:8'],
        'role' => 'required|in:Admin,Student,Teacher',
        'status' => 'required|in:1,0',
            'date_of_birth' => 'nullable|date',
        'date_of_birth' => 'nullable|date',
        'profile_picture' => 'image|mimes:jpeg,png,jpg,gif,svg', // Removed trailing pipe
        'region' => 'nullable|string|max:255',
    ];
}

}
