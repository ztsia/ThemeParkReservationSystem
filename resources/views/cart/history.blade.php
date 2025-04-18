@extends('layouts.app')

@section('title', 'HyperHeaven - Order History')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0">Order History</h2>
        </div>
        <div class="card-body">
            @if($items->isEmpty())
                <p class="text-center">No orders found.</p>
            @else
                <table class="table table-striped table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Order ID</th>
                            <th>Item</th>
                            <th>Date Purchased</th>
                            <th>Visit Date</th>
                            <th>Category</th>
                            <th>Quantity</th>
                            <th>Amount</th>
                            <th>Payment Method</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('storage/' . $order->item->image) }}" 
                                             class="me-2" alt="{{ $order->item->name }}" 
                                             style="width: 50px; height: 50px; object-fit: cover;">
                                        <div>
                                            <strong>{{ $order->item->name }}</strong>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($order->payment_date)->format('M d, Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($order->ticket_date)->format('M d, Y') }}</td>
                                <td>{{ $order->user_category }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>
                                    @php
                                    $itemPrice = $order->item->getPriceByCategory($order->user_category);
                                    $subtotal = $itemPrice * $order->quantity;
                                    @endphp
                                    RM{{ number_format($subtotal, 2) }}
                                </td>
                                <td>{{ $order->payment_type }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection
