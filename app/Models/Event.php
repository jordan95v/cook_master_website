<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function created_by_user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function participants()
    {
        return $this->belongsToMany(User::class, 'participeds');
    }

    public function start()
    {
        $date = Carbon::createFromFormat('Y-m-d H:i:s', $this->date . ' ' . $this->start_time);
        return $date->isoFormat('Y-MM-DDTHH:mm:ss');
    }

    public function end()
    {
        $date = Carbon::createFromFormat('Y-m-d H:i:s', $this->date . ' ' . $this->end_time);
        return $date->isoFormat('Y-MM-DDTHH:mm:ss');
    }
}
