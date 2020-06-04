<?php

namespace App\Http\Controllers;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
class PostsController extends Controller
{ 
    //this is used for the authorization for all the actions
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $users = auth()->user()->following()->pluck('profiles.user_id');
        $posts = Post::whereIn('user_id',$users)->with('user')->latest()->paginate(5);
       return view('posts.index',compact('posts'));
    }
    //there is a general covention for this controller name action name and then view name but naming should be same
    public function create(){
       //you can use  . or / its ur choice but i suggest you always need to use /
        return view('posts.create');
    }
    
    public function store(){
        //419 error are of cr
       // validating data
        $data = request()->validate([
            'caption' => 'required',
            'image' => 'required|image',
        ]);
       $imagePath = request('image')->store('uploads','public') ;
       $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200,1200);
       $image->save();
       auth()->user()->posts()->create([
           'caption' => $data['caption'],
           'image' => $imagePath,
       ]);
       return redirect('/profile/'.auth()->user()->id);
        //dd(request('image')->store('uploads','public'));
            //it will store the data in upload but we need to give specific file address so we need to use a cmd
            //php artisan storage:link 
            //127.0.0.1:8000/storage/uploads/D6MlpauGN1fBm7LTgAscnSlUL2MJSOqU4E4iXNim.jpeg

        // auth()->user()->posts()->create($data);
        //getting auth user with post  records
        //auth()->user()->posts()->create($data);
       // dd(request()->all()); 

    } 
    public function show(Post $post){
        // return view('posts.show',[
        //     'post' => $post
        // ]);

        return view('posts.show',compact('post'));
    }
}
