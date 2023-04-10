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


    public function ads()  //relacija gde jedan user ima mnogo oglasa
    {
        return $this->hasMany('App\Models\Ad'); 
    }

    public function messages() //relacija za messages
    {
        return $this->hasMany('App\Models\Message','receiver_id'); //receiver_id je kljuc relacije odnosno onaj user iz tabele messages koji dobija poruke
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

}
