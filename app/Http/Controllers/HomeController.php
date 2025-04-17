<?php

namespace App\Http\Controllers;
use App\Models\Item;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\Cart;

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
    
}
