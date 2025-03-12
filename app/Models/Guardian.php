<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    protected $fillable = [
        'father_name',
        'mother_name',
        'email',
        'phone_number',
        // Add other fields as needed
    ];

    public function students()
    {
        return $this->hasMany(Student::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
