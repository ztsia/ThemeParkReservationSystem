@extends('layouts.app')

@section('title', 'HyperHeaven - Online Banking')

@section('content')
<div class="container">
    <h2>Online Banking Payment</h2>

    <form action="{{ route('paymentController.onlineBanking') }}" method="POST">
        @csrf
        <input type="hidden" name="userId" value="{{ auth()->user()->id }}">
        <input type="hidden" name="paymentType" value="Online Banking">
        Select Bank:
        <select name="bank">
            <option value="" disabled selected hidden>-- Choose Your Bank --</option>
            <option value="Maybank">Maybank</option>
            <option value="CIMB">CIMB</option>
            <option value="RHB">RHB</option>
            <option value="Public Bank">Public Bank</option>
            <option value="Bank Islam">Bank Islam</option>
        </select><br>
        <span style="color:red">@error('bank') {{ $message }} @enderror</span><br>
        Account Number:
        <input type="text" name="accountNumber"><br>
        <span style="color:red">@error('accountNumber') {{ $message }} @enderror</span><br>
        Password:
        <input type="text" name="password"><br>
        <span style="color:red">@error('password') {{ $message }} @enderror</span><br>
        Amount (RM):
        <input type="number" name="amount">
        <span style="color:red">@error('amount') {{ $message }} @enderror</span><br><br>

        <input type="submit" value="Pay Now">
    </form>
</div>

@endsection