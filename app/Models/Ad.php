<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo( Category::class );
    }

    public function user()
    {
        return $this->belongsTo( User::class );
    }

    public function adViews()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'ad_user_likes');
    }

    // public function likers()
    // {
    //     return $this->belongsToMany(User::class, 'likes')->withTimestamps();
    // }

    // public function isLikedBy($userId)
    // {
    //     return $this->likers->contains('id', $userId);
    // }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

}



