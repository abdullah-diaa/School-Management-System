<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicClass extends Model
{
    protected $fillable = [
        'class_name',
        'class_level',
        'class_description',
        'class_teacher_id',
        'capacity',
        'start_date',
        'end_date',
        // ... other fields
    ];

    public function classTeacher()
    {
        return $this->belongsTo(Teacher::class, 'class_teacher_id');
    }
    
    public function grades()
{
    return $this->hasMany(Grade::class, 'academic_classes_id');
}

public function students() {
        return $this->hasMany(Student::class);
    }

    public function subjects()
{
    return $this->belongsToMany(Subject::class, 'academic_class_subject', 'academic_class_id', 'subject_id');
}

    

}
