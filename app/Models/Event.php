<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    //méthode pour récupérer les utilisateurs d'un événement
    public function participants()
    {
        //méthode pour récupérer les participants d'un événement(table cible, table qui contient les clés étrangères)
        return $this->belongsToMany(User::class, 'participeds');
    }
}
