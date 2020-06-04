<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class FollowsController extends Controller
{
    public function __construct(){
      $this->middleware('auth');
    }
    public function store(User $user){
        //here user is a model where all the records are of user table
    //    return $user->username;
       //now we will create many to many relationship bcz user can follow many and user can follow mamny user
       //now we need to create pivot table which will hold the user id and profile id on it.
        return auth()->user()->following()->toggle($user->profile);
    }
}
