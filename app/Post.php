<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //overriding the fillable property so that it not show any errors
   // protected $fillable = ['caption', 'image'];
 protected $guarded = [];
        //you need to create a same function like profile
        public function user(){
            return $this->belongsTo(User::class);
        } 
}
