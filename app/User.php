<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * URL accessor
     * return a url for the current selected comment
     */
    public function getUrlAttribute()
    {
        //return route("comments.show", $this->id);
        return '#';
    }

    /**
     * return avatar for each user
     */
    public function getAvatarAttribute()
    {
        $email = $this->email;        
        $size = 40;
        return "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?s=" . $size;
    }
}
