<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CartController;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function cash($userId)
    {
        $unpaidCartItems = CartController::getUnpaidCartItems($userId);

        // update payment type and date
        foreach ($unpaidCartItems as $item) {
            $item->payment_type = 'Cash Payment at Physical Stores';
            $item->payment_date = now();
            $item->save();
        }

        return redirect()->route('itemController.showItemList')->with('success', 'Payment successful!');
    }

    public function onlineBanking(Request $request)
    {
        $request->validate([
            'bank' => 'required | string',
            'accountNumber' => 'required | digits:12',
            'password' => 'required | string',
            'amount' => 'required | numeric | min:1 | max:5000',
        ]);

        $unpaidCartItems = CartController::getUnpaidCartItems($request->userId);

        // update payment type and date
        foreach ($unpaidCartItems as $item) {
            $item->payment_type = 'Online Banking';
            $item->payment_date = now();
            $item->save();
        }

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


        $unpaidCartItems = CartController::getUnpaidCartItems($request->userId);

        // update payment type and date
        foreach ($unpaidCartItems as $item) {
            $item->payment_type = 'Credit/Debit Card';
            $item->payment_date = now();
            $item->save();
        }

        return redirect()->route('itemController.showItemList')->with('success', 'Payment successful!');
    }

    public function showCreditCardForm()
    {
        return view('creditCard');
    }
}
