<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CartController;

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

        $unpaidCartItems = CartController::getUnpaidCartItems($request->userId);
        dd($request->userId);

        dd($unpaidCartItems);

        foreach ($unpaidCartItems as $item) {
            $item->payment_status = 'PAID';
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
        dd([
            'request data' => $request->all(),
            'user id' => $request->userId,
            'cart items' => CartController::getUnpaidCartItems($request->userId),
        ]);


        $unpaidCartItems = CartController::getUnpaidCartItems($request->userId);
        dd($unpaidCartItems);


        // foreach ($unpaidCartItems as $item) {
        //     $item->payment_type = $request->paymentType;
        //     $item->payment_date = now();
        //     $item->save();
        // }



        // return redirect()->route('itemController.showItemList')->with('success', 'Payment successful!');
    }

    public function showCreditCardForm()
    {
        return view('creditCard');
    }
}
