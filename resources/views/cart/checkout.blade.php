@extends('layouts.app')

@section('title', 'HyperHeaven - Checkout')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <!-- Customer Information Section -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Checkout</h4>
                </div>

                <div class="card-body">

                    <form id="checkoutForm" action="{{ route('cartController.checkout') }}" method="POST">
                        @csrf
                        
                        <!-- Customer Info -->
                        <div class="mb-4">
                            <h5 class="card-title border-bottom pb-2">Customer Information</h5>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="form-label fw-bold">Name</label>
                                    <p class="form-control-plaintext">{{ $user->name }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Shipping Address -->
                        <div class="mb-4">
                            <h5 class="card-title border-bottom pb-2">Shipping Address</h5>
                            
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label for="addressLine1" class="form-label">Address Line 1</label>
                                    <input type="text" class="form-control @error('addressLine1') is-invalid @enderror" 
                                           id="addressLine1" name="addressLine1" value="{{ old('addressLine1') }}" placeholder="Street address">
                                    @error('addressLine1')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-12">
                                    <label for="addressLine2" class="form-label">Address Line 2 <span class="text-muted">(Optional)</span></label>
                                    <input type="text" class="form-control @error('addressLine2') is-invalid @enderror" 
                                           id="addressLine2" name="addressLine2" value="{{ old('addressLine2') }}" placeholder="Apartment, suite, unit, building, floor, etc.">
                                    @error('addressLine2')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-4">
                                    <label for="postalCode" class="form-label">Postal Code</label>
                                    <input type="text" class="form-control @error('postalCode') is-invalid @enderror" 
                                           id="postalCode" name="postalCode" value="{{ old('postalCode') }}" placeholder="Postal Code">
                                    @error('postalCode')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-4">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" class="form-control @error('city') is-invalid @enderror" 
                                           id="city" name="city" value="{{ old('city') }}" placeholder="City">
                                    @error('city')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-4">
                                    <label for="country" class="form-label">Country</label>
                                    <input type="text" class="form-control @error('country') is-invalid @enderror" 
                                           id="country" name="country" value="{{ old('country') }}" placeholder="Country">
                                    @error('country')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <!-- Payment Section -->
                        <div class="mb-4">
                            <h5 class="card-title border-bottom pb-2">Payment Method</h5>
                            
                            <div class="my-3">
                                <div class="form-check mb-3">
                                    <input id="onlineBanking" name="paymentMethod" type="radio" class="form-check-input @error('paymentMethod') is-invalid @enderror" value="onlineBanking" {{ old('paymentMethod') == 'onlineBanking' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="onlineBanking">Online Banking</label>
                                </div>
                                
                                <div class="form-check mb-3">
                                    <input id="creditDebitCard" name="paymentMethod" type="radio" 
                                           class="form-check-input @error('paymentMethod') is-invalid @enderror" 
                                           value="credit/debitCard" {{ old('paymentMethod') == 'credit/debitCard' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="creditDebitCard">Credit / Debit Card</label>
                                </div>
                                
                                <div class="form-check mb-3">
                                    <input id="cashPayment" name="paymentMethod" type="radio" class="form-check-input @error('paymentMethod') is-invalid @enderror" value="cashPaymentAtPhysicalStores" {{ old('paymentMethod') == 'cashPaymentAtPhysicalStores' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="cashPayment">Cash Payment at Physical Stores</label>
                                </div>
                                
                                @error('paymentMethod')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Order Items -->
                        <div class="mb-4">
                            <h5 class="card-title border-bottom pb-2">Order Items</h5>
                            
                            @foreach($items as $item)
                            <div class="row mb-3 p-2 border-bottom">
                                <div class="col-md-2">
                                    <img src="{{ asset('storage/' . $item->item->image) }}" class="img-thumbnail" alt="{{ $item->item->name }}">
                                </div>
                                <div class="col-md-10">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h6 class="mb-1">{{ $item->item->name }}</h6>
                                            <p class="mb-1 text-muted small">Date: {{ $item->ticket_date }}</p>
                                            <p class="mb-1 text-muted small">Category: {{ $item->user_category }}</p>
                                            
                                            @php
                                            // Retrieve the item's price based on user category
                                            $itemPrice = $item->item->getPriceByCategory($item->user_category);
                                            @endphp
                                            <p class="mb-0">Price: <span class="text-primary">RM{{ number_format($itemPrice, 2) }}</span></p>
                                        </div>
                                        <div class="col-md-2 text-center">
                                            <p class="mb-0">Qty: {{ $item->quantity }}</p>
                                        </div>
                                        <div class="col-md-2 text-end">
                                            @php
                                            // Calculate subtotal
                                            $subtotal = $itemPrice * $item->quantity;
                                            @endphp
                                            <p class="mb-0 fw-bold">RM{{ number_format($subtotal, 2) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="d-grid mt-4 mb-3">
                            <button type="submit" class="btn btn-primary btn-lg">Place Order</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <!-- Order Summary -->
            <div class="card shadow-sm mb-4 position-sticky" style="top: 2rem;">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Order Summary</h5>
                </div>
                <div class="card-body">
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

                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                            Merchandise Subtotal
                            <span>RM{{ number_format($total, 2) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                            Tax (6%)
                            <span>RM{{ number_format($total * 0.06, 2) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                            <div>
                                <strong>Total Amount</strong>
                                <small class="d-block text-muted">including VAT</small>
                            </div>
                            <span class="fw-bold fs-5 text-primary">RM{{ number_format(($total * 1.06), 2) }}</span>
                        </li>
                    </ul>

                    <div class="d-grid gap-2">
                        <button type="submit" form="checkoutForm" class="btn btn-primary btn-lg">Place Order</button>
                        <a href="{{ route('cartController.showCartList', ['userId' => auth()->id()]) }}" class="btn btn-outline-secondary">Back to Cart</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection