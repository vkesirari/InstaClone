@extends('layouts.app')
@section('content')
    <div class="container">
       <form action="/p" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="row">
            <div class="col-8 offset-2">
                <div class="form-group row">
                    <label for="caption" class="col-md-4 col-form-label">Post Caption</label>
                        <input id="caption" type="caption" class="form-control @error('caption') is-invalid @enderror" name="caption" required autocomplete="new-caption">
                        @error('caption')
                           
                                <strong>{{ $message }}</strong>
                         
                        @enderror
                </div>
                <div class="row">
                    <label for="image" class="col-md-4 col-form-label">Post Image</label>
                    <input type="file" class="form-control-file" id="image" name="image">
                    @error('image')
            
                        <strong>{{ $message }}</strong>
              
                    @enderror
                </div> 
                <div class="row pt-4">
                    <button class="btn btn-primary">Add New Post</button>
                </div>

            </div>
        </div>
       </form>
    </div>
@endsection