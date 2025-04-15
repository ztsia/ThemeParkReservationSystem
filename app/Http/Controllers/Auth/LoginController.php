<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
    }

    public function showUserLoginForm()
{
    return view('auth.login'); // you can pass 'url' if you use conditional logic in the blade
}

public function showAdminLoginForm()
{
    return view('auth.login', ['url' => 'admin']);
}


    public function userLogin(Request $request)
    {
    // validate and authenticate user
    // use the 'web' guard
    if (Auth::attempt($request->only('email', 'password'))) {
        return redirect()->intended('/dashboard'); // or wherever
    }
    return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function adminLogin(Request $request)
    {
    // validate and authenticate admin
    // optionally use 'admin' guard if set up
    if (Auth::attempt($request->only('email', 'password'))) {
        return redirect()->intended('/admin/dashboard');
    }
    return back()->withErrors(['email' => 'Invalid credentials']);
    }
}