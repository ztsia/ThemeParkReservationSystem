@extends('layouts.app')

@section('title', 'HyperHeaven - Online Banking')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Online Banking Payment</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('paymentController.onlineBanking') }}" method="POST">
                        @csrf
                        <input type="hidden" name="userId" value="{{ auth()->user()->id }}">
                        <input type="hidden" name="paymentType" value="Online Banking">

                        <div class="mb-3">
                            <label for="bank" class="form-label fw-bold">Select Bank</label>
                            <select name="bank" id="bank" class="form-select @error('bank') is-invalid @enderror">
                                <option value="" disabled selected>-- Choose Your Bank --</option>
                                <option value="Maybank" {{ old('bank') == 'Maybank' ? 'selected' : '' }}>Maybank</option>
                                <option value="CIMB" {{ old('bank') == 'CIMB' ? 'selected' : '' }}>CIMB</option>
                                <option value="RHB" {{ old('bank') == 'RHB' ? 'selected' : '' }}>RHB</option>
                                <option value="Public Bank" {{ old('bank') == 'Public Bank' ? 'selected' : '' }}>Public Bank</option>
                                <option value="Bank Islam" {{ old('bank') == 'Bank Islam' ? 'selected' : '' }}>Bank Islam</option>
                            </select>
                            @error('bank')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="accountNumber" class="form-label fw-bold">Account Number</label>
                            <input type="text" class="form-control @error('accountNumber') is-invalid @enderror"
                                id="accountNumber" name="accountNumber" value="{{ old('accountNumber') }}">
                            @error('accountNumber')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password">
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        @php
                        $total = 0; // Initialize total
                        @endphp

                        @foreach ($items as $item)
                        @php
                        // Retrieve the item's price based on user category
                        $itemPrice = $item->item->getPriceByCategory($item->user_category);
                        $subtotal = $itemPrice * $item->quantity;
                        $total += $subtotal;
                        @endphp
                        @endforeach
                        <div class="mb-4">
                            <label for="amount" class="form-label fw-bold">Amount (RM)</label>
                            <p class="form-control-plaintext">RM{{ number_format(($total * 1.06), 2) }}</p>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('cartController.showCheckoutForm', ['userId' => auth()->id()]) }}"
                                class="btn btn-outline-secondary">Back to Checkout</a>
                            <button type="submit" class="btn btn-primary">Complete Payment</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="text-center mt-3">
                <p class="text-muted small">Using online banking is a secure way to pay for your tickets</p>
                <p class="text-muted small">Your banking credentials are encrypted and never stored on our servers.</p>
            </div>
        </div>
    </div>
</div>
@endsection