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
        $items = Item::paginate(10);
        return view("itemList", ['items' => $items]);
    }
    public function addItemForm(Request $request)
    {
        $item = Item::find($request->id);
        $user = User::find(1); // need to add user id
        return view("itemDetails", ["item" => $item, "user" => $user]);
    }

    // public function addItem(Request $request)
    // {
    //     dd($request->all());
    // }
    public function addItem(Request $request)
    {
        // check if cart table has record with user id and item id and payment is null
        //    yes - update that cart record
        //    no - create new cart record with the mentioned column


        // $userId = auth()->id(); // Get the logged-in user ID

        // Check if the cart has an existing record with the same user_id, item_id, and payment_status IS NULL
        $cart = Cart::where('user_id', $request->userId)
            ->where('item_id', $request->itemId)
            ->where('ticket_date', $request->ticketDate)
            ->where('user_category', $request->userCategory)
            ->whereNull('payment_date')
            ->first();

        if ($cart) {
            // If cart exists, update quantity
            $cart->update([
                'quantity' => $cart->quantity + $request->quantity, // Increase quantity
            ]);
        } else {
            // If no matching cart record, create a new one
            // $data = $request->all();
            // $data['user_id'] = 1;
            // $data['payment_type'] = null;
            // $data['payment_date'] = null;


            // Cart::create($data);

            Cart::create([
                'user_id' => $request->userId,
                'item_id' => $request->itemId,
                'ticket_date' => $request->ticketDate,
                'user_category' => $request->userCategory,
                'quantity' => $request->itemQty,
                'payment_type' => null,
                'payment_date' => null,
            ]);
        }

        return redirect()->back()->with('success', 'Item added to cart successfully!');
    }

}
