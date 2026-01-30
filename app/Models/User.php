<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements \Illuminate\Contracts\Auth\MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    // Relasi ke OTP
    public function otps()
    {
        return $this->hasMany(Otp::class);
    }
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'status',
        'role',
    ];
    // Relasi ke invoice
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    // Relasi ke payment
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    // Relasi ke subscription
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    // Relasi ke notification
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    // Relasi ke roles
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    // Tambahkan accessor agar path photo selalu absolute (support Laravel <10)
    public function getPhotoAttribute($value)
    {
        if ($value && !preg_match('/^https?:\/\//', $value)) {
            return url($value);
        }
        return $value;
    }
}
