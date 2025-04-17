@extends('layouts.app')

@section('title', 'HyperHeaven - Cart')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0">Your Cart</h2>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Item</th>
                            <th>Date</th>
                            <th>User Category</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Subtotal</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                        <tr>
                            <td class="align-middle">{{ $item->item->name }}</td>
                            <td class="align-middle">{{ $item->ticket_date }}</td>
                            <td class="align-middle">{{ $item->user_category }}</td>
                            <td class="align-middle">
                                <div class="d-flex align-items-center justify-content-center gap-2">
                                    <form action="{{ route('cartController.updateCart') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="cartId" value="{{ $item->id }}">
                                        <input type="hidden" name="quantity" value="{{ $item->quantity - 1 }}">
                                        <button type="submit" class="btn btn-sm btn-outline-secondary">-</button>
                                    </form>

                                    <span class="fw-bold">{{ $item->quantity }}</span>

                                    <form action="{{ route('cartController.updateCart') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="cartId" value="{{ $item->id }}">
                                        <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                                        <button type="submit" class="btn btn-sm btn-outline-secondary">+</button>
                                    </form>
                                </div>
                            </td>
                            <td class="align-middle">
                                @php
                                // Retrieve the item's price based on user category
                                $itemPrice = $item->item->getPriceByCategory($item->user_category);
                                @endphp
                                <span class="text-secondary">RM{{ number_format($itemPrice, 2) }}</span>
                            </td>
                            <td class="align-middle fw-bold">
                                @php
                                // Retrieve the item's price based on user category
                                $itemPrice = $item->item->getPriceByCategory($item->user_category);
                                $subtotal = $itemPrice * $item->quantity;
                                @endphp
                                RM{{ number_format($subtotal, 2) }}
                            </td>
                            <td class="align-middle">
                                <a href="{{ route('cartController.deleteCart', $item->id) }}" class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i> Delete
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 offset-md-6">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h4 class="mb-0">Order Summary</h4>
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

                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal:</span>
                        <span class="fw-bold">RM{{ number_format($total, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Tax (6%):</span>
                        <span class="fw-bold">RM{{ number_format($total * 0.06, 2) }}</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-3">
                        <span class="fs-5">Total Price:</span>
                        <span class="fs-5 fw-bold text-primary">RM{{ number_format($total * 1.06, 2) }}</span>
                    </div>

                    <form action="{{ route('cartController.showCheckoutForm', ['userId' => auth()->id()]) }}" method="GET">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">Proceed to Checkout</button>
                            <a href="{{ route('home') }}" class="btn btn-outline-secondary">Continue Shopping</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @elseif(session('error'))
    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
</div>
@endsection