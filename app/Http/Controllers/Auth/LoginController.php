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
        return view('auth.login', ['isAdmin' => false]); 
    }

    public function showAdminLoginForm()
    {
        return view('auth.login', ['isAdmin' => true]);
    }


    public function userLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        $credentials['is_admin'] = 0; // user only

        if (Auth::attempt($credentials)) {
            return redirect()->route('home')->with('status', 'Login successful!');
        }

        return back()->withErrors(['email' => 'Invalid credentials or not a user.']);
    }


    public function adminLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        $credentials['is_admin'] = 1; // admin only

        if (Auth::attempt($credentials)) {
            return redirect()->route('home')->with('status', 'Admin login successful!');
        }

        return back()->withErrors(['email' => 'Invalid credentials or not an admin.']);
    }
}
