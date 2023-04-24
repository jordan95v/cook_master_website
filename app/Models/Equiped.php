<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equiped extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'equipment_id',
    ];


    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }
}
