<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function brand()
    {
        return $this->belongsTo(Brand::class, "brand_id");
    }

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function comments()
    {
        return $this->hasMany(ProductComment::class, "product_id");
    }

    public function rating()
    {
        $rating = 0;
        foreach ($this->comments as $comment) {
            $rating += $comment->rating;
        }

        if ($this->comments->count() == 0) {
            return 0;
        }
        return $rating / $this->comments->count();
    }
}
