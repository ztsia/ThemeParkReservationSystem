<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Display all items.
     */
    public function showItemList()
    {
        $items = Item::paginate(10);
        return view("itemList", ['items' => $items]);
    }

    public function addItemForm($cartId)
    {
        $item = Item::find($cartId);
        return view("itemDetails", ["item" => $item]);
    }
}
