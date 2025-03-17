<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
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
