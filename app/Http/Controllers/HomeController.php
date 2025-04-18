<?php

namespace App\Http\Controllers;
use App\Models\Item;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $items = Item::all();
        $events = Event::all();
    
        return view('home', compact('items', 'events'));
    }

    /**
     * Switch the application theme.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $theme
     * @return \Illuminate\Http\RedirectResponse
     */
    public function switchTheme(Request $request, $theme)
    {
        // Validate theme
        if (!in_array($theme, ['light', 'dark'])) {
            $theme = 'light';
        }
        
        // Set cookie - expires in 30 days (43200 minutes)
        Cookie::queue('theme', $theme, 43200);
        
        // Redirect back to previous page
        return redirect()->back()->with('status', 'Theme switched to ' . $theme . '.');
    }
}
