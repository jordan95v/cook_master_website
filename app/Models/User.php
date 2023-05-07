<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use LaravelDaily\Invoices\Classes\Party;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_banned',
        'image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin(): bool
    {
        return ($this->role != 0) ? true : false;
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function invoices()
    {
        return $this->hasMany(OrderInvoice::class);
    }

    public function customer(array $fields): Party
    {
        return new Party([
            'name' => $this->name,
            'custom_fields' => [
                'email' => $this->email,
                'location' => $fields['address'] . ', ' . $fields['zipcode'] . ' ' . $fields['city'],
            ],
        ]);
    }

    public function isSubscribed(): bool
    {
        foreach (["starter", "pro"] as $plan) {
            if ($this->subscribed($plan) || $this->subscribed($plan . "_annual")) {
                return true;
            }
        }
        return false;
    }
}
