<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentLife extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'category', 'image_url'];
}