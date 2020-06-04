@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
    <div class="col-3 p-5">
    <img src="{{ $user->profile->profileImage() }}" class="rounded-circle w-100">
    </div>
    <div class="col-9 pt-5">
        <!--$user will show all records in objct but we only need a user name-->
    <div class="d-flex justify-content-between align-items-baseline">
        <div class="d-flex align-items-center">
            <div class="h4">{{$user->username}}</div>
          <!--You are using this button form resources/component/followbutton.vue-->
        <follow-button user-id="{{ $user->id }}" follows="{{$follows}}">
          </follow-button>
        </div>
        @can('update',$user->profile)
        <a href="/p/create">Add New Post</a>
        @endcan  
    </div>
    @can('update',$user->profile)
        <a href="/profile/{{$user->id}}/edit">Edit Profile</a>
    @endcan
        <div class="d-flex">
            <div class="pr-5"><strong>{{ $postsCount }} </strong>Posts</div>
            <div class="pr-5"><strong>{{ $followerCount }} </strong>Followers</div>
            <div class="pr-5"><strong>{{ $followingCount }} </strong>Following</div>
        </div>
        <div class="pt-4 font-weight-bold">{{$user->profile->title}}</div>
        <div>{{$user->profile->description}}</div>
        <div><a href="{{ $user->profile->url }}" >{{ $user->profile->url }}</div>
  
    </div>
</div>
<hr>
<div class="row pt-5">
    @foreach ($user->posts as $post)
    <div class="col-4 pt-4">
        <a href="/p/{{$post->id}}">
            <img src="/storage/{{ $post->image }}" class="w-100">
        </a>
   
    </div>
    @endforeach
</div>
</div>
@endsection
