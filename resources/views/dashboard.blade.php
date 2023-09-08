@extends('layouts.app')

@section('content')

    <div class="container mt-5">

        <b>Hello,</b> {{ auth()->user()->name }}

        @if(!auth()->user()->billing_ends)
            @if(auth()->check() && auth()->user()->user_type == 'employer')
                <p>Your trial {{now()->format('Y-m-d') >  auth()->user()->user_trial ? ' was expire ' : ' will expire '}} on  {{ auth()->user()->user_trial }}</p>
            @endif
        @elseif(auth()->check() && auth()->user()->user_type == 'employer')
            <p>Your trial {{now()->format('Y-m-d') >  auth()->user()->user_trial ? ' was expire ' : ' will expire '}} on  {{ auth()->user()->user_trial }}</p>
        @endif

        <div class="row justify-content-center">
            @if(Session::has('success'))
                <div class="alert alert-success">{{Session::get('success')}} </div>
            @endif

            @if(Session::has('error'))
                <div class="alert alert-danger">{{Session::get('error')}}  </div>
            @endif

            <div class="col-md-3">
                <div class="card-counter primary">
                <p class="text-center mt-3 lead">User Profile</p>
                <button class="btn btn-primary float-end">view</button>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-counter danger">
                    <p class="text-center mt-3 lead">Post Job</p>
                    <button class="btn btn-primary float-end">view</button>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-counter success">
                    <p class="text-center mt-3 lead">Al Jobs</p>
                    <button class="btn btn-primary float-end">view</button>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-counter info">
                    <p class="text-center mt-3 lead">Item 4</p>
                    <button class="btn btn-primary float-end">view</button>
                </div>
            </div>

        </div>
    </div>

@endsection
<style>
    .card-counter{
        box-shadow: 2px 2px 10px #DADADA;
        margin: 5px;
        padding: 20px 10px;
        background-color: #fff;
        height:130px;
        border-radius: 5px;
        transition: .3s linear all;
    }

    .card-counter.primary{
        background-color: #007bff;
        color: #FFF;
    }
    .card-counter.danger{
        background-color: #ef5350;
        color: #FFF;
    }
    .card-counter.success{
        background-color: #66bb6a;
        color: #FFF;
    }
    .card-counter.info{
        background-color: #26c6da;
        color: #FFF;
    }
</style>
