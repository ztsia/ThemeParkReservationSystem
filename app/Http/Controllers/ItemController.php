<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use App\Models\Cart;
use Facade\FlareClient\Glows\Recorder;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function showItemList()
    {
        $user = User::find(1); // to be replaced
        $items = Item::paginate(10);
        return view("itemList", ['items' => $items, 'user' => $user]);
    }


}
