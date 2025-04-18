<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class cart
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // If user is not logged in (guest)
        if (!Auth::check()) {
            return redirect('/login')->with('status', 'Please login to access the cart.');
        }
        
        // If user is an admin
        if (Auth::user()->is_admin) {
            return redirect('/')->with('status', 'Admins cannot access user carts.');
        }

        // Check if user is trying to access another user's cart
        if ($request->route('userId') && $request->route('userId') != Auth::id()) {
            return redirect()->route('cartController.showCartList', ['userId' => Auth::id()])
                            ->with('status', 'You cannot access another user\'s cart.');
        }
        
        // User is logged in and not an admin, allow access
        return $next($request);
    }
}
