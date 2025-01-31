<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        'user_image_url',
        'gender',
        'address',
        'user_phone',
        'birth_date',
    ];

    // Optionally, you can define hidden attributes like password and remember_token

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

    public function shops() : HasMany
    {
        return $this->hasMany(Shop::class);
    }

    public function queues(): BelongsToMany
    {
        return $this->belongsToMany(Queue::class, 'users_queues')->withPivot('queue_number');
    }

    public function isAdmin(): bool
    {
        return $this->role === 'ADMIN';
    }

    public function isUser(): bool
    {
        return $this->role === 'USER';
    }

    public function isMerchant(): bool
    {
        return $this->role === 'MERCHANT';
    }
}
