@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        <div class="row justify-content-center">

            <div class="col-md-6">
            @include('message')
                <div class="card shadow-lg">
                    <div class="card-header">login</div>
                    <form action="{{route('login.post')}}" method="post"> @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="text" name="email" class="form-control">
                                @if($errors->has('email'))
                                    <span class="text-danger">{{$errors->first('email')}}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control">
                                @if($errors->has('password'))
                                    <span class="text-danger">{{$errors->first('password')}}</span>
                                @endif
                            </div>
                            <br>
                            <div class="form-group text-center">
                                <button class="btn btn-primary" type="submit">login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


        </div>
        <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header">For <b>Seeker</b> testing login</div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Email</label>
                        <span class="text-danger">mahmoud@m.com</span>
                        <label for="">Password</label>
                        <span class="text-danger">12345678</span>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <span class="text-danger">ahmed@a.com</span>
                        <label for="">Password</label>
                        <span class="text-danger">12345678</span>
                    </div>
                    <hr>
                    For <b>employer</b> testing login
                    <hr>

                    <div class="form-group">
                        <label for="">Email</label>
                        <span class="text-danger">faisal@mailinator.com</span>
                        <label for="">Password</label>
                        <span class="text-danger">12345678</span>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <span class="text-danger">khaled@mailinator.com</span>
                        <label for="">Password</label>
                        <span class="text-danger">12345678</span>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <span class="text-danger">yousef@mailinator.com</span>
                        <label for="">Password</label>
                        <span class="text-danger">12345678</span>
                    </div>
            </div>
        </div>
        </div>

    </div>

@endsection
