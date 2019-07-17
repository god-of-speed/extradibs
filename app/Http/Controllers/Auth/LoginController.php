<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }




    /**
     * logout function
     */
    public function logout(Request $request) {
        Auth::logout();
        return redirect('/login');
    }



    /**
     * login
     */
    public function login(Request $request) {
        //get data
        $data = $request->only('username','password');
        $credentials = ['username'=>$data['username'],'password'=>$data['password']];
        if(Auth::attempt($credentials)) {
            return redirect('/dashboard');
        }
        return redirect('/login');
    }

}
