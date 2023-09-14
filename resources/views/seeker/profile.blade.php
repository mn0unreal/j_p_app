@extends('layouts.app')

@section('content')

    <div class="container mt-5">

        <div class="row justify-content-center">
            @if(Session::has('success'))
                <div class="alert alert-success">{{Session::get('success')}}</div>
            @endif
            @if(Session::has('error'))
                <div class="alert alert-danger">{{Session::get('error')}}</div>
            @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <ol>{{ $error }}</ol>
                            @endforeach
                        </ul>
                    </div>
                @endif

            <h4>{{ucfirst(auth()->user()->user_type)}}</h4>

            <h4>Update your profile</h4>
            <form action="{{route('user.update.profile')}}" method="post" enctype="multipart/form-data"> @csrf
                <div class="col-md-8">

                    <div class="form-group">
                        <label for="image">Profile image</label>
                        <input type="file" class="form-control" id="image" name="profile_pic">
                        @if(auth()->user()->profile_pic)
                            <img src="{{Storage::url(auth()->user()->profile_pic)}}" width="150" class="mt-3">
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="name">Your name</label>
                        <input type="text" class="form-control"  name="name" value="{{auth()->user()->name}}">
                    </div>
                    <div class="form-group mt-4">
                        <button class="btn btn-primary">update</button>
                    </div>
                </div>
            </form>

        </div>
        <div class="row mt-4">
            <div class="col-md-8">
                <hr>
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            <h4>Change your password</h4>

            <form action="{{route('user.password')}}" method="post" > @csrf
                <div class="col-md-8">

                    <div class="form-group">
                        <label for="current_password">Your current password</label>
                        <input type="password" name="current_password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">Your new password</label>
                        <input type="password" class="form-control"  name="password">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirm password</label>
                        <input type="password" class="form-control"  name="password_confirmation">
                    </div>
                    <div class="form-group mt-4">
                        <button class="btn btn-primary">update</button>
                    </div>
                </div>
            </form>

        </div>
        <div class="row mt-4">
            <div class="col-md-8">
                <hr>
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            <h4>Update  your resume</h4>

            <form action="{{route('upload.resume')}}" method="post" enctype="multipart/form-data" > @csrf
                <div class="col-md-8">

                    <div class="form-group">
                        <label for="resume">Upload a resume</label>
                        <input type="file" name="resume" id="resume" class="form-control">
                    </div>

                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </div>
            </form>

        </div>

    </div>

@endsection
