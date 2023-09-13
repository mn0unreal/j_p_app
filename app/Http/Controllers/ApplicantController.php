<?php

namespace App\Http\Controllers;

use App\Mail\ShortlistMail;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;

class ApplicantController extends Controller
{
    public function index()
    {
        $listings = Listing::latest()->withCount('users')->where('user_id',auth()->user()->id)->get();
        return view('applicants.index',compact('listings'));
    }

    public function show(Listing  $listing)
    {
        $this->authorize('view',$listing);
//        if($listing->user_id != auth()->id()){
//            abort(403);
//        }

         $listing = Listing::with('users')->where('slug',$listing->slug)->first();
        return view('applicants.show',compact('listing'));
    }

    public function shortlist($listingId,$userId)
    {
        $listing = Listing::find($listingId);
        $user = User::find($userId);
        if ($listing){
            $listing->users()->updateExistingPivot($userId,['shortlisted'=>true]);
            Mail::to($user->email)->queue(new ShortlistMail($user->name,$listing->title));

            return back()->with('success','User is shortlisted successfully');
        }
        return back();
    }

    public function apply($listingId){
        $user = auth()->user();
        $user->listings()->syncWithoutDetaching($listingId);

        $listing = Listing::findOrFail($listingId);
        // Check if the user has already submitted an application for this listing
        if (!$user->listings->contains($listing->id)) {
            $user->listings()->attach($listing->id);
            return back()->with('success', 'Your application was successfully submitted');
        } else {
            // User has already submitted an application for this listing
            // Handle the error or display a message to the user
            return back()->with('success','Your application was successfully submitted');
//            return back()->with('error', 'You have already submitted an application for this job listing');
        }
//        return back()->with('success','Your application was successfully submitted');
    }

    public function unsubmitApplication(Request $request, $listingId){

        $user = Auth::user();
        $listing = Listing::findOrFail($listingId);

        // Check if the user has submitted an application for this listing
        if ($user->listings->contains($listing->id)) {
            $user->listings()->detach($listing->id);
            return back()->with('success', 'Your application has been retracted.');
        } else {
            // User has not submitted an application for this listing
            // Handle the error or display a message to the user
            return back()->with('error', 'You have not submitted an application for this job listing.');
        }
    }

}
