<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id', 
        'full_name', 
        'email', 
        'phone', 
        'status', 
        'ssc_result', 
        'hsc_result'
    ];

    // Relationship to the Course (Department)
    public function course() {
        return $this->belongsTo(Course::class);
    }
}