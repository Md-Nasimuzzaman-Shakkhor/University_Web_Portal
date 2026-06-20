<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    // This allows Laravel's Notice::create() to work with your form
    protected $fillable = ['title', 'type', 'content'];
}