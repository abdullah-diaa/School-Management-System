<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'phone',
        'subject_id',
        'qualification',
        'address',
        'admission_number',
        'gender',
    ];

    // Relationships
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function teachingSchedule()
    {
        return $this->hasMany(TeachingSchedule::class, 'teacher_id');
    }

    public function workloads()
    {
        return $this->hasMany(Workload::class, 'teacher_id');
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class, 'teacher_id');
    }

    public function events()
    {
        return $this->hasMany(Event::class, 'teacher_id');
    }

    public function exams()
    {
        return $this->hasMany(Exam::class, 'teacher_id');
    }


    // Additional methods or scopes as needed for business logic
}
