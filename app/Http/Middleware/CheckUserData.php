<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use App\Models\Student;

class CheckUserData
{
    public function handle($request, Closure $next)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Get the user's role
        $role = Auth::user()->role;

        // Check if the user's role is Student and if they have filled out the Student data row
        if ($role === 'Student' && !Auth::user()->student) {
            return redirect()->route('students.create');
        }

        // Check if the user's role is Teacher and if they have filled out the Teacher data row
        if ($role === 'Teacher' && !Auth::user()->teacher) {
            return redirect()->route('teachers.create');
        }

        // If the user has filled out the required data row, allow access to the requested page
        return $next($request);
    }
}
