<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Cache;
class ProfilesController extends Controller
{

    public function index(User $user){
      //follows keyword is used for the actually following 
      $follows = (auth()->user()) ? auth()->user()->following->contains($user->id):false;

      //caching is generally used here for more enhacement of website and not to everytime hit the database everytime
      $postsCount = Cache::remember('count.posts'.$user->id,
        now()->addSeconds(30), function ()
        use($user) {
          return $user->posts->count();
      });
      $followerCount = Cache::remember('count.followers'.$user->id,
      now()->addSeconds(30), function ()
      use($user) {
        return $user->profile->followers->count();
      });
      $followingCount = Cache::remember('count.following'.$user->id,
      now()->addSeconds(30), function ()
      use($user) {
        return $user->following->count(); 
      });
        return view('profiles.index',compact('user','follows','postsCount','followerCount','followingCount'));
      }
    public function edit(User $user){
      $this->authorize('update',$user->profile);
      return view('profiles.edit',compact('user'));
    }
    public function update(User $user){
      $this->authorize('update',$user->profile);
      $data = request()->validate([
        'title' => 'required',
        'description' => 'required',
        'url' => 'required',
        'image' => '',
      ]);
    
     if(request('image')){
      $imagePath = request('image')->store('profile','public') ;
      $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000,1000);
      $image->save();
      //we are using this because this need to be set first if there is image.
      $imageArray =  [ 'image'=> $imagePath ];
     }
    //  dd(array_merge(
    //   $data,
    //   [ 'image'=> $imagePath ]
    // ));
      //Auth is using bcz through user any one can edit ur profile
      auth()->user()->profile->update(array_merge(
        $data,
        $imageArray ?? []
      ));
     return redirect("/profile/{$user->id}");
    }
} 
