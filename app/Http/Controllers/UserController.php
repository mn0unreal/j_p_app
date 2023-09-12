<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationFormRequest;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    const JOB_SEEKER = 'seeker';
    const JOB_POSTER = 'employer';

    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function createSeeker(){
        return view('user.seeker-register');
    }

    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function createEmployer(){
        return view('user.employer-register');
    }

    /**
     * @param RegistrationFormRequest $request
     * @return JsonResponse
     */
    public function storeSeeker(RegistrationFormRequest $request){
        $user = User::create([
            'name'=> request('name'),
            'email'=> request('email'),
            'password'=>bcrypt (request('password')),
            'user_type'=> self::JOB_SEEKER
        ]);
        Auth::login($user);
        $user->sendEmailVerificationNotification();
        return response()->json('success');
        //return redirect()->route('verification.notice')->with('successMessage','Your account was created');
    }

    /**
     * @param RegistrationFormRequest $request
     * @return JsonResponse
     */
    public function storeEmployer(RegistrationFormRequest $request){
        $user = User::create([
            'name'=> request('name'),
            'email'=> request('email'),
            'password'=>bcrypt (request('password')),
            'user_type'=> self::JOB_POSTER,
            'user_trial'=>now()->addWeek()
        ]);
        Auth::login($user);
        $user->sendEmailVerificationNotification();
        return response()->json('success');
//        return redirect()->route('verification.notice')->with('successMessage','Your account was created');
    }

    public function login(){
        return view('user.login');
    }

//    public function postLogin(Request $request){
//        $request->validate([
//            'email'=>'required',
//            'password'=>'required'
//        ]);
//        $credentials = $request->only('email','password');
//
//        if (Auth::attempt($credentials)){
//            if (auth()->user()->user_type == 'employer'){
//                return redirect()->to('dashboard');
//            }else{
//                return redirect()->to('/');
//            }
//        }
//        return 'email & password is required';
//    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function postLogin(Request $request): RedirectResponse
    {
        // Validate the incoming request data
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        // Get the email and password from the request
        $credentials = $request->only('email', 'password');

        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
            // Check the user's type and redirect accordingly
            if (auth()->user()->user_type == 'employer') {
                // Redirect to the employer dashboard
                return redirect()->route('dashboard');
            } else {
                // Redirect to the back page for non-employers
                return redirect()->back();
            }
        }

        // Authentication failed; redirect back with an error message
        return redirect()->back()->withErrors(['email' => 'Invalid email or password']);
    }

    /**
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        auth()->logout();
        return redirect()->route('login');
    }

    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function profile(){
    return view('profile.index');
    }

    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function seekerProfile(){
    return view('seeker.profile');
    }
//    public function changePassword(Request $request){
//        $request->validate([
//            'current_password'=>'required',
//            'password'=>'required|min:6|confirmed',
//        ]);
//        $user = auth()->user();
//        if(Hash::check($request->current_password,$user->password)){
//            return back()->with('error','Current password is incorrect');
//        }
//        $user->password = Hash::make($request->password);
//
//        $user->save();
//        return back()->with('success','Your password has been update successfully');
//    }
    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function changePassword(Request $request) {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = auth()->user();
        // Verify current password matches the stored password in the db.
        /** @noinspection PhpUndefinedFieldInspection */
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Current password is incorrect');
        }

        // Update the user's password in the database
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Your password has been updated successfully');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function uploadResume(Request $request){

        $this->validate($request,[
            'resume'=>'required|mimes:pdf,doc,docx',
        ]);
        if($request->hasFile('resume')){
            $resume_path = $request->file('resume')->store('resume','public');
            User::find(auth()->user()->id)->update(['resume'=>$resume_path]);
        }
        return back()->with('success',' Your resume has been updated successfully ');
    }

//    public function update(Request $request){
//
//        if($request->hasFile('profile_pic')){
//            $image_path = $request->file('profile_pic')->store('profile','public');
//            User::find(auth()->user()->id)->update(['profile_pic'=>$image_path]);
//            return back()->with('success','Your profile has been updated successfully');
//        }
//
//    }
    public function update(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'profile_pic' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust to your requirements
        ]);

        if ($request->hasFile('profile_pic')) {
            $image = $request->file('profile_pic');

            // Generate a unique filename for the image
            $imagePath = 'profile/' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Store the image in the public disk
            $image->storeAs('public', $imagePath);

            // Update the user's profile_pic field
            $user = Auth::user();
            $user->profile_pic = $imagePath;
            $user->save();

            return back()->with('success', 'Your profile picture has been updated successfully');
        }

        return back()->with('error', 'No profile picture uploaded');
    }
    public function jobApplied(){
         $users = User::with('listings')->where('id',auth()->user()->id)->get();
        return view('seeker.job-applied',compact('users'));
    }

}
