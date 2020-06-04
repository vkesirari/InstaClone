@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8">
                <img src="/storage/{{$post->image}}" alt="" class="w-100"> 
            </div>
            <div class="col-4">
                <div>
                    <div class="d-flex align-items-center">
                        <div  class="pr-3">
                            <!--Here profile image is a function for when you don't upload image it display a default image-->
                            <img src="{{ $post->user->profile->profileImage() }}" class="rounded-circle w-100" style="max-width:50px">
                        </div>
                        <div>
                        <a href="{{$post->user->id}}">
                                <span class="font-weight-bold">
                                    {{ $post->user->username }}
                                </span>
                            </a>
                            <a href="http://" class="pl-3">Follow</a>
                        </div>
                    </div>
                    <hr>
                    <p>
                    <a href="{{$post->user->id}}">
                        <span class="font-weight-bold">
                            <span class="text-dark">
                                {{ $post->user->username }}
                            </span>
                        </span>
                    </a>
                    {{$post->caption}}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection