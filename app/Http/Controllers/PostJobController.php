<?php

namespace App\Http\Controllers;

use App\Http\Middleware\isPremiumUser;
use App\Http\Requests\JobPostEditRequest;
use App\Http\Requests\JobPostFormRequest;
use App\Models\Listing;
use App\Post\JobPost;


class PostJobController extends Controller
{
    protected $job;
    public function __construct(JobPost $job){
        $this->job = $job;
        $this->middleware('auth');
        $this->middleware(isPremiumUser::class)->only(['create','store']);
//        ->middleware()
    }
    public function index(){
        $jobs = Listing::where('user_id',auth()->user()->id)->get();
        return view('job.index',compact('jobs'));
    }
    public function create(){

        return view('job.create');
    }
    public function store(JobPostFormRequest $request){
//
//        $this->validate($request,[
//            'feature_image'=>'required|mimes:png,jpeg,jpg|max:2048',
//            'title'=>'required|min:5',
//            'description'=>'required|min:10',
//            'roles'=>'required|min:10',
//            'job_type'=>'required',
//            'address'=>'required',
//            'salary'=>'required',
//            'application_close_date'=>'required'
//        ]);

//        $imagePath = $request->file('feature_image')->store('images','public');
//        $post = new Listing();
//        $post->feature_image = $imagePath;
//        $post->user_id = auth()->user()->id;
//        $post->title = $request->title;
//        $post->description = $request->description;
//        $post->roles = $request->roles;
//        $post->job_type = $request->job_type;
//        $post->address = $request->address;
//        $post->application_close_date = \Carbon\Carbon::createFromFormat('d/m/Y',$request->application_close_date)->format('Y-m-d');;
//        $post->salary = $request->salary;
//        $post->slug = Str::slug($request->title).'.'.Str::uuid();
//        $post->save();
        $this->job->store($request);
        return back();
    }
    public function edit(Listing $listing){
        return view('job.edit',compact('listing'));
    }
    public function update($id, JobPostEditRequest $request)
    {
        $this->job->updatePost($id, $request);
        return back()->with('success', 'Your job post has been successfully uploaded');
    }
    public function destroy($id){
        Listing::find($id)->delete();
        return back()->with('success','Your job post has been successfully Deleted');
    }

}
