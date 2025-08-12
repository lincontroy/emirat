<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function lockedPlans()
    {
        return $this->hasMany(UserLockedPlan::class);
    }

    /**
     * Get only active locked plans
     */
    public function activeLockedPlans()
    {
        return $this->lockedPlans()->where('status', 'active');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    // app/Models/User.php

public function getAvailableBalanceAttribute()
{
    return $this->balance_usd - $this->lockedPlans()->sum('amount');
}

public function getLockedBalanceAttribute()
{
    return $this->lockedPlans()->sum('amount');
}

public function getActivePlansCountAttribute()
{
    return $this->lockedPlans()->where('status', 'active')->count();
}
}
