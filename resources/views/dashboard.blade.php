@extends('layouts.admin.main')

@section('content')

    <div class="container mt-5">

        <div class="row justify-content-center">
            @if(Session::has('success'))
                <div class="alert alert-success">{{Session::get('success')}} </div>
            @endif

            @if(Session::has('error'))
                <div class="alert alert-danger">{{Session::get('error')}}  </div>
            @endif
{{--            --}}
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                         <p>Hello ,  {{ auth()->user()->name }} . </p>
                        @if(auth()->user()->billing_ends)
                            @if(auth()->check() && auth()->user()->user_type == 'employer')
                                <p>
                                    Your subscription  {{now()->format('Y-m-d') >  auth()->user()->billing_ends ? ' was expire ' : ' will expire '}} on  {{ auth()->user()->billing_ends }}
                                </p>
                            @endif
                        @elseif(auth()->check() && auth()->user()->user_type == 'employer')
                            <p> , Your trial {{now()->format('Y-m-d') >  auth()->user()->user_trial ? ' was expire ' : ' will expire '}} on  {{ auth()->user()->user_trial }}</p>
                        @endif
                    </ol>
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body">Total jobs ({{ \App\Models\Listing::where('user_id', auth()->id())->count() }})
                                </div>

                                <div class="card-footer d-flex align-items-center justify-content-between">

                                    <a class="small text-white stretched-link" href="{{route('job.index')}}">View</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body">Profile</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="/user/profile">View</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body">Plan  ({{ \App\Models\User::where('id', auth()->id())->first()->plan }})</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="#">View</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>

{{--                        <div class="col-xl-3 col-md-6">--}}
{{--                            <div class="card bg-danger text-white mb-4">--}}
{{--                                <div class="card-body">Danger Card</div>--}}
{{--                                <div class="card-footer d-flex align-items-center justify-content-between">--}}
{{--                                    <a class="small text-white stretched-link" href="#">View Details</a>--}}
{{--                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>

                </div>
{{--            --}}

        </div>
    </div>

@endsection

