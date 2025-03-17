<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\User;
use App\Models\Item;

class CartController extends Controller
{
  public function addItemForm($cartId)
  {
    $item = Item::find($cartId);
    $user = User::find(1); // to be replaced
    return view("itemDetails", ["item" => $item, "user" => $user]);
  }

  public function addItem(Request $request)
  {
    // dd($request->all());

    // Ensure user_id is set
    $data = $request->all();
    $data['user_id'] = $request->userId; // Explicitly set user_id
    $data['item_id'] = $request->itemId; // Explicitly set item_id
    $data['ticket_date'] = $request->ticketDate; // Explicitly set item_id
    $data['user_category'] = $request->userCategory; // 
    $data['payment_type'] = null;
    $data['payment_date'] = null;

    // Check if the cart has an existing record with the same user_id, item_id, and payment_status IS NULL
    $cart = Cart::where('user_id', $data['user_id'])
      ->where('item_id', $data['itemId'])
      ->where('ticket_date', $data['ticketDate'])
      ->where('user_category', $data['userCategory'])
      ->whereNull('payment_date')
      ->first();

    if ($cart) {
      // If cart exists, update quantity
      $cart->update([
        'quantity' => $cart->quantity + $data['quantity'], // Increase quantity
      ]);
    } else {
      // If no matching cart record, create a new one
      Cart::create($data);
    }

    return redirect()->back()->with('success', 'Item added to cart successfully!');
  }

  // display cart page
  public function showCartList($userId)
  {
    $data = $this->getUnpaidCartItems($userId); // find unpaid cart items
    return view("cart", ["items" => $data]);
  }

  // get unpaid cart items with item details
  public function getUnpaidCartItems($userId)
  {
    $unpaidCartItems = Cart::where('user_id', $userId)
      ->whereNull('payment_date')
      ->with('item')
      ->get();
    return $unpaidCartItems;
  }

  // update cart item quantity
  public function updateCart(Request $request)
  {
    $cartItem = Cart::findOrFail($request->cartId);

    // if quantity is less than 1, delete the item
    if ($request->quantity < 1) {
      $cartItem->delete();
      return redirect()->back()->with('success', 'Item removed from cart.');
    }

    // otherwise, update quantity
    $cartItem->update($request->all());
    return redirect()->back()->with('success', 'Cart updated successfully!');
  }

  // delete cart item
  public function deleteCart($cartId)
  {
    $cart = cart::findOrFail($cartId);
    $cart->delete();
    return redirect()->back()->with('success', 'Item removed from cart.');
  }


}
