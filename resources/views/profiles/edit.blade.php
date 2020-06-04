@extends('layouts.app')
@section('content')
    <div class="container">
    <form action="/profile/{{$user->id}}" enctype="multipart/form-data" method="POST">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-8 offset-2">
                <div class="row">
                        <h1>
                            Edit Profile
                        </h1>
                </div>
                <div class="form-group row">
                    <label for="title" class="col-md-4 col-form-label">Title</label>
                <input id="title" type="title" class="form-control" name="title" required autocomplete="new-title" value="{{ old('title') ?? $user->profile->title}}">
                        @error('title')
                                <strong>{{ $message }}</strong>
                        @enderror
                </div>
                <div class="form-group row">
                    <label for="description" class="col-md-4 col-form-label">Description</label>
                        <input id="description" type="description" class="form-control" name="description" required autocomplete="new-description" value="{{ old('description') ?? $user->profile->description}}">
                        @error('description')
                                <strong>{{ $message }}</strong>
                        @enderror
                </div>
                <div class="form-group row">
                    <label for="url" class="col-md-4 col-form-label">Url</label>
                        <input id="url" type="url" class="form-control" name="url" required autocomplete="new-url" value="{{ old('url') ?? $user->profile->url}}">
                        @error('url')
                                <strong>{{ $message }}</strong>
                        @enderror
                </div>
                <div class="row">
                    <label for="image" class="col-md-4 col-form-label"> Profile Image</label>
                    <input type="file" class="form-control-file" id="image" name="image">
                    @error('image')
            
                        <strong>{{ $message }}</strong>
              
                    @enderror
                </div> 
                <div class="row pt-4">
                    <button class="btn btn-primary">Save Profile</button>
                </div>

            </div>
        </div>
       </form>
    </div>
@endsection