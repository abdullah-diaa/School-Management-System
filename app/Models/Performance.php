<?php
use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    protected $fillable = [
        'subject_id',
        'grade_id',
    ];

    // ... other relationships or methods ...

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
}
