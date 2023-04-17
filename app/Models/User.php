<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function ads()
    {
        return $this->hasMany(Ad::class); 
    }

    public function views()
    {
        return $this->belongsToMany(Ad::class)->withTimestamps();
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // public function likedAds()
    // {
    //     return $this->belongsToMany(Ad::class, 'likes')->withTimestamps();
    // }

    public function sentMessages()
    {
        return $this->hasMany(Message::class,'sender_id'); 
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class,'receiver_id'); 
    }

}
