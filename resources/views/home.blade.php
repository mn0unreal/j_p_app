@extends('layouts.app')

@section('content')

    <div class="container mt-5">

        <div class="row justify-content-center">

            @if(Session::has('success'))
                <div class="alert alert-success">{{Session::get('success')}} </div>
            @endif

            @if(Session::has('error'))
                <div class="alert alert-danger">{{Session::get('error')}}  </div>
            @endif

            {{--list_of_jobs--}}
                List of jobs
            {{--list_of_jobs--}}

        </div>
    </div>

@endsection

