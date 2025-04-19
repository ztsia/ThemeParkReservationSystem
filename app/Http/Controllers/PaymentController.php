<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function cash()
    {
        $unpaidCartItems = CartController::getUnpaidCartItems(Auth::id());

        // update payment type and date
        foreach ($unpaidCartItems as $item) {
            $item->payment_type = 'Cash Payment at Physical Stores';
            $item->payment_date = now();
            $item->save();
        }

        return redirect()->route('home')->with('status', 'Payment successful with cash!');
    }

    public function onlineBanking(Request $request)
    {
        $request->validate([
            'bank' => 'required | string',
            'accountNumber' => 'required | digits:12',
            'password' => 'required | string',
        ]);

        $unpaidCartItems = CartController::getUnpaidCartItems($request->userId);

        // update payment type and date
        foreach ($unpaidCartItems as $item) {
            $item->payment_type = 'Online Banking';
            $item->payment_date = now();
            $item->save();
        }

        return redirect()->route('home')->with('status', 'Payment successful with online banking!');
    }

    public function showOnlineBankingForm()
    {
        $data = CartController::getUnpaidCartItems(Auth::id()); // find unpaid cart items
        return view('cart.onlineBanking', ["items" => $data]);
    }

    public function creditCard(Request $request)
    {
        $request->validate([
            'cardholderName' => 'required | max:255 | regex:/^[A-Z][a-zA-Z\s]*$/',
            'cardNumber' => 'required | digits:16',
            'expiryDate' => 'required',
            'cvv' => 'required | digits_between:3,4',
        ]);


        $unpaidCartItems = CartController::getUnpaidCartItems($request->userId);

        // update payment type and date
        foreach ($unpaidCartItems as $item) {
            $item->payment_type = 'Credit/Debit Card';
            $item->payment_date = now();
            $item->save();
        }

        return redirect()->route('home')->with('status', 'Payment successful with debit/credit card!');
    }

    public function showCreditCardForm()
    {
        return view('cart.creditCard');
    }
}
