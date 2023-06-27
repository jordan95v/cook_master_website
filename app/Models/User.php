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
        'is_active',
        'key',
        'godfather_key',
        'first_order_discount',
        'godfather_had_discount',
        'total_discount',
        'api_key',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'api_key',
        'role',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Custom method after that comment.

    public function isAdmin(): bool
    {
        return ($this->role != 0) ? true : false;
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

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function orderInvoices()
    {
        return $this->hasMany(OrderInvoice::class);
    }

    public function brands()
    {
        return $this->hasMany(Brand::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function participations()
    {
        return $this->hasMany(Participed::class);
    }

    public function finished_courses()
    {
        return $this->hasMany(FinishedCourse::class);
    }

    public function formations()
    {
        return $this->hasMany(Formation::class);
    }

    public function taken_formations()
    {
        return $this->hasMany(FormationUser::class);
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }
    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }
    public function messages()
    {
        return $this->hasMany(Message::class, 'sender_id')->orWhere('receiver_id', $this->id);
    }

}
