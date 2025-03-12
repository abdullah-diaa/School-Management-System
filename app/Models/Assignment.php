<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable = [
        'title',
        'description',
        'deadline',
        'teacher_id',
        'academic_class_id',
        'subject_id',
    ];



   protected $casts = [
        'deadline' => 'datetime', // Cast 'deadline' attribute to a datetime object
    ];
    // Relationships
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function academicClass()
    {
        return $this->belongsTo(AcademicClass::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    // Additional methods or scopes as needed for business logic
}
