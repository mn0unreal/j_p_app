@extends('layouts.app')

@section('content')

    <div class="container mt-5">

        <div class="d-flex justify-content-between">
            <h4>Recommended jobs</h4>

            <div class="dropdown">
                <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    salary
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{route('listing.index',['sort'=>'salary_high_to_low'])}}">High to low</a></li>
                    <li><a class="dropdown-item" href="{{route('listing.index',['sort'=>'salary_low_to_high'])}}">Low to High</a></li>
                </ul>

                <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    date
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{route('listing.index',['date'=>'latest'])}}">latest</a></li>
                    <li><a class="dropdown-item" href="{{route('listing.index',['date'=>'oldest'])}}">oldest</a></li>
                </ul>

                <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Job type
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{route('listing.index',['job_type'=>'Fulltime'])}}">Fulltime</a></li>
                    <li><a class="dropdown-item" href="{{route('listing.index',['job_type'=>'Parttime'])}}">Parttime</a></li>
                    <li><a class="dropdown-item" href="{{route('listing.index',['job_type'=>'Casual'])}}">Casual</a></li>
                    <li><a class="dropdown-item" href="{{route('listing.index',['job_type'=>'Contract'])}}">Contract</a></li>
                </ul>
            </div>

        </div>
        <div class="row mt-2 g-1">
            @foreach($jobs as $job)
{{--                {{$job->job_type}}--}}
            <div class="col-md-3">
                <div class="card p-2 {{$job->job_type}}" >
                    <div class="text-right"><small class="badge text-bg-secondary">{{$job->job_type}}</small></div>
                    <div class="text-center mt-2 p-3">

                        <img src="{{Storage::url($job->profile->profile_pic)}}" width="100" class="rounded-circle" alt="">

                        <span class="d-block font-weight-bold">{{$job->title}} </span>
                        <hr>
                        <span>{{$job->profile->name}}</span>

                    <div class="d-flex flex-row align-items-center justify-content-center">
                         <small class="ml-1">{{$job->address}}</small>
                    </div>

                        <div class="d-flex justify-content-between mt-3">
                            <span>${{number_format($job->salary,2)}}</span>
                            <a href="{{route('job.show',[$job->slug])}}">
                                <button class="btn btn-sm btn-outline-dark">Apply Now</button>
                            </a>
                        </div>

                    </div>

                </div>
            </div>

            @endforeach
        </div>
    </div>
<style>
    /*.card:hover{*/
    /* background-color: #e1e1e1;*/
    /*}*/

    .Fulltime{
        background-color: green;
        color: #fff;
        opacity: 55%;
    }
    .Parttime{
        background-color: blue;
        color: #fff;
        opacity: 55%;
    }
    .Casual{
        background-color: red;
        color: #fff;
        opacity: 55%;
    }
    .Contract{
        background-color: purple;
        color: #fff;
        opacity: 55%;
    }
</style>
@endsection

