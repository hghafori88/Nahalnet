<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\Models\User;
use Auth;

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
    protected $redirectTo = 'course.index';
   // public $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'email';
    }

    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback()
    {

            $user = Socialite::driver('google')->stateless()->user();



        $authUser= $this->findOrCreteUser($user);
        //var_dump($authUser);
        //dd($authUser);
        Auth::login($authUser,true);
        //var_dump($authUser->id);
        //dd($authUser);
        return redirect()->to('/course');
    }

    public function findOrCreteUser($user)
    {

        $authUser=User::where('email',$user->email)->first();

        if($authUser){
            return $authUser;
        }
        else {
            return User::create([
                'name' => $user->name,
                'email' => $user->email,
                'google_id' => $user->id,
                'avatar' => $user->avatar
            ]);
        }
    }
}
