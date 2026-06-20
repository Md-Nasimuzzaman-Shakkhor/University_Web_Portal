<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    // This "fillable" array tells Laravel it's safe to save these specific columns
    protected $fillable = [
        'title', 
        'description', 
        'price'
    ];
}