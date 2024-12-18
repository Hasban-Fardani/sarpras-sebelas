<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, HasFactory;

    /**
     * The attributes that are *not* mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

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

    public function getRouteKeyName()
    {
        return 'username';
    }

    public function employee()
    {
        return $this->hasOne(Employee::class, 'nip', 'nip');
    }

    public function getNameAttribute()
    {
        return $this->employee->name;
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            if (!isset($user->username))
            {
                $user->username = trim($user->name);
            }

            if ($user->role == 'admin' && env('APP_ENV') === 'production')
            {
                // decline when creating admin
                abort(403);
            }
        });
    }
}
