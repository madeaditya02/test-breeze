<?php

namespace App\Models;

use App\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_picture'
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

    public function plans()
    {
        return $this->belongsToMany(Plan::class);
    }
    
    public function stories()
    {
        return $this->hasMany(Story::class);
    }

    public function following() {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'following_id');
    }
    
    // users that follow this user
    public function followers() {
        return $this->belongsToMany(User::class, 'followers', 'following_id', 'follower_id');
    }
    
    public function followed() {
        // return auth()->check() ? $this->followers : false;
        return auth()->check() ? $this->followers->contains(function($user) {
            return $user->id == auth()->id();
        }) : false;
    }
}
