<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Http\Request;

class JoblistingController extends Controller
{

    public function index(Request $request){
        $salary = $request->query('sort');
        $date = $request->query('date');
        $jobType = $request->query('job_type');
        $listing = Listing::query();

        if($salary ==='salary_high_to_low'){
//            $listing->orderBy('salary','desc');
            $listing->orderByRaw('CAST(salary AS UNSIGNED) DESC');
        }elseif ($salary ==='salary_low_to_high'){
//            $listing->orderBy('salary','asc');
            $listing->orderByRaw('CAST(salary AS UNSIGNED) ASC');
        }

        if($date ==='latest'){
            $listing->orderBy('created_at','desc');
        }elseif ($date ==='oldest'){
            $listing->orderBy('created_at','asc');
        }

        if($jobType ==='Fulltime'){
            $listing->where('job_type','Fulltime');
        }elseif ($jobType ==='Parttime'){
            $listing->where('job_type','Parttime');
        }elseif ($jobType ==='Casual'){
            $listing->where('job_type','Casual');
        }elseif ($jobType ==='Contract'){
            $listing->where('job_type','Contract');
        }


        $jobs = $listing->with('profile')->get();

        return view('home',compact('jobs'));
    }

    public function show(Listing $listing){
    return view('show',compact('listing'));
    }

    public function company( $id){
       $company = User::with('jobs')->where('id',$id)->where('user_type','employer')->first();
       return view('company',compact('company'));
    }

}
