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
        'name', 'email','username', 'password',
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
    //we are using this function bcz when we migrate fresh all records are deleted and title error shows first
    //and so we aare creating a blank table for this.
    protected static function boot(){
        parent::boot();
        static::created(function($user){
            $user->profile()->create([
                'title'=>$user->username,
                ]);
        });

    }
    //user can have many posts so we need to make fun plural
     public function posts(){
         //order by created file in desc order and then our post will display in projects
        return $this->hasMany(Post::class)->orderBy('created_at','DESC');
    }
    //now we are creating follow for profile and user table to follow
    public function following(){
            return $this->belongsToMany(Profile :: class);
    }
    //here we needd to create a function same as profile model to create a relationship to that..
    public function profile(){
        return $this->hasOne(Profile::class); 
    }
}
