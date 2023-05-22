<?php

namespace App\Models;

use Carbon\Carbon;
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
        'is_service_provider',
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

    public function orderInvoices()
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
        if ($this->subscriptions()->count() > 0) {
            $sub = $this->subscriptions()->first()->asStripeSubscription();
            if ($sub->status == 'active') {
                return true;
            }
        }
        return false;
    }

    public function getSubscription()
    {
        if (!$this->isSubscribed()) {
            return null;
        }
        return array($this->subscriptions()->first(), $this->subscriptions()->first()->asStripeSubscription());
    }

    public function getNextBillingDate(): string
    {
        if (!$this->isSubscribed()) {
            return null;
        }
        $sub = $this->subscriptions()->first()->asStripeSubscription();
        return Carbon::createFromTimeStamp($sub->current_period_end)->format('d M Y');
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
