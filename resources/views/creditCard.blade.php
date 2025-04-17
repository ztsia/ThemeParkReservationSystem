@extends('layouts.app')

@section('title', 'HyperHeaven - Credit Card Payment')

@section('content')
<h1>Credit Card Payment</h1>
<form action="{{ route('paymentController.creditCard') }}" method="POST">
    @csrf
    <input type="hidden" name="userId" value="{{ auth()->user()->id }}">
    Cardholder Name:
    <input type="text" placeholder="Cardholder Name" name="cardholderName"><br>
    <span style="color: red">@error('cardholderName') {{ $message }} @endError</span><br>
    Card Number:
    <input type="text" placeholder="Card Number" name="cardNumber"><br>
    <span style="color: red">@error('cardNumber') {{ $message }} @endError</span><br>
    Expiry Date:
    <input type="text" placeholder="MM/YY" name="expiryDate"><br>
    <span style="color: red">@error('expiryDate') {{ $message }} @endError</span><br>
    CVV:
    <input type="text" placeholder="CVV" name="cvv"><br>
    <span style="color: red">@error('cvv') {{ $message }} @endError</span><br>

    <input type="submit" value="Submit">
</form>

@endsection