@extends('layouts.admin.main')

@section('content')

    <div class="container mt-5">

        <div class="row justify-content-center">
            <div class="col-md-8 mt-5">
                <h1>Update a job</h1>
{{--                {{$listing}}--}}
                @if(Session::has('success'))
                    <div class="alert alert-success" >{{Session::get('success')}}</div>
                @endif
                <form action="{{route('job.update',[$listing->id])}}" method="post" enctype="multipart/form-data">@csrf @method('PUT')
                    <div class="form-group">
                        <label for="feature_image" >Feature image</label>
                        <input type="file" id="feature_image" name="feature_image" class="form-control" >
                        @if($errors->has('feature_image'))
                            <div class="alert alert-danger">{{$errors->first('feature_image')}}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="title" >Title</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{$listing->title}}">
                        @if($errors->has('title'))
                            <div class="alert alert-danger">{{$errors->first('title')}}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="description" >Description</label>
                        <textarea id="description" name="description" class="form-control summernote">{{$listing->description}}</textarea>
                        @if($errors->has('description'))
                            <div class="alert alert-danger">{{$errors->first('description')}}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="roles" >Roles and Responsibility</label>
                        <textarea id="roles" name="roles" class="form-control summernote" >{{$listing->roles}}</textarea>
                        @if($errors->has('roles'))
                            <div class="alert alert-danger">{{$errors->first('roles')}}</div>
                        @endif
                    </div>
                    <div class="form-group" >
                        <label>Jobs types</label>

                        <div class="form-check">
                            <input type="radio" class="form-check-input"  id="fulltime" name="job_type" value="fulltime"
                                {{ $listing->job_type === 'fulltime' ? 'checked':'' }}>
                            <label for="fulltime" class="form-check-label" >Fulltime</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input"  id="parttime" name="job_type" value="parttime"
                                {{ $listing->job_type === 'parttime' ? 'checked':'' }}>
                            <label for="parttime" class="form-check-label" >Part time</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input"  id="casual" name="job_type" value="casual"
                                {{ $listing->job_type === 'casual' ? 'checked':'' }}>
                            <label for="casual" class="form-check-label" >Fulltime</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input"   id="contract" name="job_type" value="contract"
                                {{ $listing->job_type === 'contract' ? 'checked':'' }}>
                            <label for="contract" class="form-check-label" >Contract</label>
                        </div>
                        @if($errors->has('job_type'))
                            <div class="alert alert-danger">{{$errors->first('job_type')}}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="address" >Address</label>
                        <input type="text" name="address" id="address" class="form-control" value="{{$listing->address}}">
                        @if($errors->has('address'))
                            <div class="alert alert-danger">{{$errors->first('address')}}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="salary" >Salary</label>
                        <input type="number" name="salary" id="salary" class="form-control" value="{{$listing->salary}}">
                        @if($errors->has('salary'))
                            <div class="alert alert-danger">{{$errors->first('salary')}}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="application_close_date" >Application closing date</label>
                        <input type="text" id="datepicker" name="application_close_date" class="form-control" value="{{$listing->application_close_date}}">
                        @if($errors->has('application_close_date'))
                            <div class="alert alert-danger">{{$errors->first('application_close_date')}}</div>
                        @endif
                    </div>
                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-success" >Update a job</button>
                    </div>

                </form>
            </div>
        </div>

    </div>
    <style>
        .note-insert{
            display: none !important;
        }
    </style>
@endsection
