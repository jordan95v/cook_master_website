<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;

    protected $hidden = ['courses', 'formation_users'];

    protected $guarded = [];

    public function courses()
    {
        return $this->hasMany(FormationCourse::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function formation_users()
    {
        return $this->hasMany(FormationUser::class);
    }
}
