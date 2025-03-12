<?php
namespace App\Models;

  use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Student extends Model
{
  
  use HasFactory;
    protected $fillable = [
        'admission_number',
        'first_name',
        'last_name',
        'gender',
        'address',
        'phone_number',
        'academic_classes_id',
        'guardians_id',
        'user_id',
        'profile_picture',
    ];
    
    protected $casts = [
        'date_of_birth' => 'date',
    ];

    
    
    
    
    // Other attributes and methods...

    public function user()
    {
        return $this->belongsTo(User::class);
    }



    public function academicClass()
{
    return $this->belongsTo(AcademicClass::class, 'academic_classes_id');
}

    
      public function subjects()
    {
        return $this->academicClass->subjects();
    }

    public function guardians()
    {
        return $this->belongsTo(Guardian::class);
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
public function performance()
{
    // You need to define the logic to calculate performance for an individual student
    // Example: Calculate the average grade for the student
    $averageGrade = $this->grades()->avg('grade');

    return [
        'average_grade' => $averageGrade,
        // Add more performance metrics as needed
    ];
}

    
    
}
