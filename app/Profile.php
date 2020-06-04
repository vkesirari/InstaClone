<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];
    public function profileImage(){
        $imagePath = ($this->image ? $this->image : 'profile/Vha2Y3a8TsGFu0tmPGsZ3mdk75ASZgVgqISxf3Or.png');
        return '/storage/' . $imagePath;
    }
    public function followers(){
        return $this->belongsToMany(User :: class);
}
    //you need to create a same function like a user model user 
    public function user(){
        return $this->belongsTo(User::class);
    }

}
