<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Socialite;


class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except(['logout' ,'reset' ]);

    }


    public function login(Request $request)
    {

        $remember = $request->has('remember') ? true:false;

        $validator = Validator::make($request->all(), [
        'email' => 'required',
        'password' => 'required',
        ]);

        if ($validator->fails()) {
            $error = implode(' , ' , $validator->errors()->all());
            session()->flash('error' ,$error);
            return  redirect()->back();
        }

        $credentials = $validator->validated();


        if (Auth::guard()->attempt($credentials , $remember)){
            return redirect()->back();
        }else{
            session()->flash('error' ,'username or password error');
            return  redirect()->back();
        }



    }

    public function logout(){

        Auth::guard('web')->logout();
        return redirect()->route('web.home');
    }

    public function register(Request $request){

        $validator =  Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);


        if ($validator->fails()) {
            $error = implode(' , ' , $validator->errors()->all());
            session()->flash('error' ,$error);
            return  redirect()->back();
        }

        $credentials = $validator->validated();
        $user = User::create([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'password' => Hash::make($credentials['password']),
        ]);
        if ($user){
            Auth::guard()->attempt($credentials , true);
            return redirect()->back();
        }else{
            session()->flash('error' ,'username or password error');
            return  redirect()->back();

        }

    }

    public function reset(Request $request){
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'name' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.auth()->user()->id],
        ]);

        if ($validator->fails()) {
            $error = implode(' , ' , $validator->errors()->all());
            session()->flash('error' ,$error);
            return  redirect()->back();
        }

        $credentials = $validator->validated();
        $user = Auth::guard()->attempt(['email' => \auth()->user()->email , 'password' => $credentials['old_password']] , true);

        if ($user){
            \auth()->user()->update([
                'password' => Hash::make($credentials['password']),
                'name' => $credentials['name'],
                'email' => $credentials['email'],

            ]);
            $success = "your password changed";
            session()->flash('success' ,$success);
            return  redirect()->back();
        }
        $error = "wrong password";
        session()->flash('error' ,$error);
        return  redirect()->back();
    }

    public function ForgetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('email.forgetPassword', ['token' => $token , 'email'=>$request->email], function($message) use($request){
            $message->to($request->email , "Mohamed");
            $message->from(env('MAIL_USERNAME' , 'learnweb2021@gmail.com') , env('APP_NAME' , 'SozlerEgypt'));
            $message->subject('Reset Password');
        });

        session()->flash('success' ,'تم ارسال الرابط');
        return  redirect()->back();
    }

    public function showResetPasswordForm($token) {

        return view('web.pages.resetpassword', ['token' => $token ]);
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless(true)->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        try {


            $user = Socialite::driver('google')->stateless(true)->user();

            $finduser = User::where('google_id', $user->id)->first();
            if($finduser){
                //if the user exists, login and show dashboard
                Auth::login($finduser);
                return redirect('/');
            }else{
                //user is not yet created, so create first
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'password' => encrypt('')
                ]);
                //every user needs a team for dashboard/jetstream to work.
                //login as the new user
                Auth::login($newUser);
                // go to the dashboard
                return redirect('/');
            }
            //catch exceptions
        } catch (Exception $e) {
            session()->flash('error' ,$e->getMessage());
            return redirect('/');
        }
    }

    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_resets')
                            ->where([
                              'email' => $request->email,
                              'token' => $request->token
                            ])
                            ->first();

        if(!$updatePassword){
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $user = User::where('email', $request->email)
                    ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email'=> $request->email])->delete();
        session()->flash('success' ,'Your password has been changed!');
        return redirect('/');
    }


}
