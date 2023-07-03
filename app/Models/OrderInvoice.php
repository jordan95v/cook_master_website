<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderInvoice extends Model
{
    protected $guarded = [];

    public function url()
    {
        return asset("storage/invoices/" . $this->serial . ".pdf");
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    use HasFactory;
}
