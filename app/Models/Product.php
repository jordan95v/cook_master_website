<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "price",
        "brand_id",
        "image",
        "description",
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class, "brand_id");
    }
}
