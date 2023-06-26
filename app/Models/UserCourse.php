<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCourse extends Model
{
    // This model is used to check wether or not a user can see a course.

    use HasFactory;
    protected $guarded = [];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
