<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
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

    public function roles()
    {
        return $this->belongsToMany(role::class, 'role_users');
    }

    public function hasRoles($role)
    {
        return $this->roles()->whereIn('en_title', $role)->exists();
    }

    public function carts(){
        return $this->hasMany(carts::class);
    }

    public function contactUs()
    {
        return $this->hasMany(contactUs::class);
    }

    public function orders()
    {
        return $this->hasMany(orders::class);
    }

    public function addresses()
    {
        return $this->hasMany(address::class);
    }
}
