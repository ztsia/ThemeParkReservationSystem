<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function onlineBanking(Request $request)
    {
        $request->validate([
            'bank' => 'required | string',
            'accountNumber' => 'required | digits:12',
            'password' => 'required | string',
            'amount' => 'required | numeric | min:1 | max:5000',
        ]);

        return redirect()->route('itemController.showItemList')->with('success', 'Payment successful!');
    }

    public function showOnlineBankingForm()
    {
        return view('onlineBanking');
    }

    public function creditCard(Request $request)
    {
        $request->validate([
            'cardholderName' => 'required | max:255 | regex:/^[A-Z][a-zA-Z\s]*$/',
            'cardNumber' => 'required | digits:16',
            'expiryDate' => 'required',
            'cvv' => 'required | digits:3',
        ]);

        return redirect()->route('itemController.showItemList')->with('success', 'Payment successful!');
    }

    public function showCreditCardForm()
    {
        return view('creditCard');
    }
}
