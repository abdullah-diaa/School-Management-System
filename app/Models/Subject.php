<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    // Define relationships if needed
    // For example, if a subject has many grades
    public function academicClasses() 
    {
        return $this->belongsToMany(AcademicClass::class)->withTimestamps();
    }

    public function grades() {
        return $this->hasMany(Grade::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
