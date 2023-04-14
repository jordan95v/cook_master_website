<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        "name",
        "slug",
        "image",
        "description",
        "website",
        "contact_email",
    ];

    use HasFactory;
}
