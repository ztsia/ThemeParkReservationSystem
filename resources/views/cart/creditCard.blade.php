@extends('layouts.app')

@section('title', 'HyperHeaven - Credit Card Payment')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Credit Card Payment</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('paymentController.creditCard') }}" method="POST">
                        @csrf
                        <input type="hidden" name="userId" value="{{ auth()->user()->id }}">
                        
                        <div class="mb-3">
                            <label for="cardholderName" class="form-label fw-bold">Cardholder Name</label>
                            <input type="text" class="form-control @error('cardholderName') is-invalid @enderror" 
                                id="cardholderName" name="cardholderName" placeholder="Name as shown on card"
                                value="{{ old('cardholderName') }}">
                            @error('cardholderName')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="cardNumber" class="form-label fw-bold">Card Number</label>
                            <div class="input-group">
                                <input type="text" class="form-control @error('cardNumber') is-invalid @enderror" 
                                    id="cardNumber" name="cardNumber" placeholder="XXXX XXXX XXXX XXXX"
                                    value="{{ old('cardNumber') }}">
                                <span class="input-group-text bg-white">
                                    <i class="bi bi-credit-card"></i>
                                </span>
                                @error('cardNumber')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label for="expiryDate" class="form-label fw-bold">Expiry Date</label>
                                <input type="text" class="form-control @error('expiryDate') is-invalid @enderror" 
                                    id="expiryDate" name="expiryDate" placeholder="MM/YY"
                                    value="{{ old('expiryDate') }}">
                                @error('expiryDate')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="cvv" class="form-label fw-bold">CVV</label>
                                <input type="text" class="form-control @error('cvv') is-invalid @enderror" 
                                    id="cvv" name="cvv" placeholder="3-4 digits"
                                    value="{{ old('cvv') }}">
                                @error('cvv')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('cartController.showCheckoutForm', ['userId' => auth()->id()]) }}" 
                               class="btn btn-outline-secondary">Back to Checkout</a>
                            <button type="submit" class="btn btn-primary">Complete Payment</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer bg-light">
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">Secure Payment</small>
                        <div>
                            <i class="bi bi-lock-fill me-1"></i>
                            <span class="small text-muted">Your payment info is secure</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Cards accepted info -->
            <div class="text-center mt-3">
                <p class="text-muted">We accept the following credit cards</p>
                <div class="d-flex justify-content-center gap-3">
                    <i class="bi bi-credit-card fs-4"></i>
                    <i class="bi bi-credit-card-2-front fs-4"></i>
                    <i class="bi bi-credit-card-2-back fs-4"></i>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection