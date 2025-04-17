<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Item;

class CartController extends Controller
{
  public function addItemForm($cartId)
  {
    $item = Item::find($cartId);
    return view("itemDetails", ["item" => $item]);
  }

  public function addItem(Request $request)
  {
    $data = $request->all();
    $data['user_id'] = Auth::id();
    $data['item_id'] = $request->itemId;
    $data['ticket_date'] = $request->ticketDate;
    $data['user_category'] = $request->userCategory;
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

  public function checkout(Request $request)
  {
    $request->validate([
      'addressLine1' => 'required | max: 255 | string',
      'addressLine2' => 'required | max: 255 | string',
      'postalCode' => 'required | digits:5',
      'city' => 'required | max: 255 | string',
      'country' => 'required | max: 255 | string',
      'paymentMethod' => 'required | in:onlineBanking,credit/debitCard,cashPaymentAtPhysicalStores',
    ]);

    switch ($request->paymentMethod) {
      case "onlineBanking":
        return redirect()->route('paymentController.showOnlineBankingForm');
        break;
      case "credit/debitCard":
        return redirect()->route('paymentController.showCreditCardForm');
        break;
      case "cashPaymentAtPhysicalStores":
        return redirect()->route('paymentController.cash');
        break;
      default:
        return redirect()->back()->withErrors([
          'paymentMethod' => 'Invalid payment method selected.'
        ]);
    }
  }

  public function showCheckoutForm()
  {
    $user = Auth::user();
    $data = $this->getUnpaidCartItems(Auth::id()); // find unpaid cart items
    if ($data->isEmpty()) {
      return redirect()->back()->with('error', 'Your cart is empty. Add items before checkout.');
    }
    return view("checkout", ["items" => $data, "user" => $user]);
  }

  // get unpaid cart items with item details
  public static function getUnpaidCartItems($userId)
  {
    $unpaidCartItems = Cart::where('user_id', $userId)
      ->whereNull('payment_date')
      ->with('item')
      ->get();
    return $unpaidCartItems;
  }
}
