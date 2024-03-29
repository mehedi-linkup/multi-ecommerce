<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    
    protected function redirectTo(){
        if (Auth()->user()->role_id !=2 ) {
            return route('admin.dashboard');

        }elseif (Auth()->user()->role_id == 2 ) {
        return route('user.dashboard');
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    /*
     * laravel Socialite
     */
    
    //Google login
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    
    //google Callback
    public function handleGoogleCallback() 
    {
         $user = Socialite::driver('google')->user();
         $this->registerOrLoginUser($user);
         return redirect()->route('user.dashboard');
    }
    
    //Facebook login
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
    
    //facebook Callback
    public function handleFacebookCallback() 
    {
        $user = Socialite::driver('facebook')->user();
        $this->registerOrLoginUser($user);
         return redirect()->route('user.dashboard');
    }
    
    //Socialite Login
    protected function registerOrLoginUser($data) {
        //dd($data);
        $user = User::where('email','=',$data->email)->first();
        if(!$user){
            $user = new User();
            $user->name = $data->name;
            $user->email = $data->email;
            $user->provider_id = $data->id;
            $user->image = $data->avatar;
            $user->save();
        }
        Auth::login($user);
    }
}
