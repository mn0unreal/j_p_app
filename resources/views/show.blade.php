@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-3">
                <div class="card">
                    <img src="{{Storage::url($listing->feature_image)}}" class="card-img-top" alt="Cover Image"
                         style="height: 500px; object-fit: cover;">
                    <div class="card-body">

                        <a style="text-decoration: none;" href="{{route('company',[$listing->profile->id])}}">
                            <img src="{{Storage::url($listing->profile->profile_pic)}}" width="60" class="rounded-circle"  alt=""/>
                        </a>
                        <b class="card-title">{{$listing->profile->name}}</b>

                        <h2 class="card-title">{{$listing->title}}</h2>
                        @if(Session::has('success'))
                        <div class="alert alert-success">
                            {{Session::get('success')}}
                        </div>
                        @endif
                        @if(Session::has('error'))
                            <div class="alert alert-danger">
                                {{Session::get('error')}}
                            </div>
                        @endif

                        <span class="badge bg-primary">{{$listing->job_type}}</span>
                        <p>Salary: ${{number_format($listing->salary,2)}} </p>
                        <p>Address: {{$listing->address}} </p>
                        <h4 class="mt-4">Description</h4>
                        <p class="card-text">
                            {!! $listing->title !!}
                        </p>

                        <h4>Roles and Responsibilities</h4>
                        {!! $listing->title !!}

                        <p class="card-text mt-4">Application closing date: {{$listing->application_close_date}}</p>


                        @if(Auth::check())
                            @if(auth()->user()->resume)
                                @php
                                    $userSubmitted = auth()->user()->listings->contains($listing->id);
                                @endphp

                                @if(!$userSubmitted)
                                    <form action="{{route('application.submit',[$listing->id])}}" method="post" enctype="multipart/form-data">@csrf
                                        <button href="#" class="btn btn-primary mt-3 ">Apply Now</button>
                                    </form>
                                @else
                                    <form action="{{route('application.unsubmit',[$listing->id])}}" method="post" enctype="multipart/form-data">@csrf
                                        <button href="#" class="btn btn-danger mt-3">Unsubmit</button>
                                    </form>
                                @endif
                            @else
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-dark " data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    Apply
                                </button>
                            @endif
                        @else
                            <p>Please login to apply </p>
                        @endif
                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <form action="{{route('application.submit',[$listing->id])}}" method="post" enctype="multipart/form-data">@csrf

                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Upload resume</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="file"/>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" id="btnApply" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <!--/ Modal -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Get a reference to the file input element
        const inputElement = document.querySelector('input[type="file"]');

        // Create a FilePond instance
        const pond = FilePond.create(inputElement);

        // pond setOptions
        pond.setOptions({
            server: {
                url: '/resume/upload',
                process: {
                    method: 'POST',
                    withCredentials: false,
                    headers: { 'X-CSRF-TOKEN': '{{csrf_token()}}' },
                    ondata: (formData) => {
                        formData.append('file', pond.getFiles()[0].file, pond.getFiles()[0].file.name)

                        return formData
                    },
                    // onload: (response) => {
                    //     document.getElementById('btnApply').removeAttribute('disabled')
                    // },
                    onerror: (response) => {
                        console.log('error while uploading....', response)
                    },

                },
            },
        });

    </script>
@endsection
