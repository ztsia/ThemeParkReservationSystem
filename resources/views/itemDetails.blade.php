@extends('layouts.app')

@section('title', "HyperHeaven - {$item->name}")

@section('content')
<div class="container py-4">
    <div class="row">
        <!-- Item Image Column -->
        <div class="col-md-5">
            <div class="card shadow-sm">
                <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top img-fluid" alt="{{ $item->name }}" style="height: 400px; object-fit: cover;">
            </div>
        </div>

        <!-- Item Details Column -->
        <div class="col-md-7">
            <h1 class="mb-4">{{ $item->name }}</h1>

            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title">Description</h5>
                    <p class="card-text">{{ $item->description }}</p>

                    <div class="row mt-4">
                        <div class="col-md-4">
                            <div class="pricing-box text-center p-3 border rounded">
                                <h6>Normal Price</h6>
                                <p class="fs-4 fw-bold text-primary mb-0">RM {{ number_format($item->normalPrice, 2) }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="pricing-box text-center p-3 border rounded">
                                <h6>Children & Senior</h6>
                                <p class="fs-4 fw-bold text-primary mb-0">RM {{ number_format($item->childrenSeniorPrice, 2) }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="pricing-box text-center p-3 border rounded">
                                <h6>Student</h6>
                                <p class="fs-4 fw-bold text-primary mb-0">RM {{ number_format($item->studentPrice, 2) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @cannot('isAdmin')
            <!-- Booking Form -->
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Book Your Tickets</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('cartController.addItem') }}" method="POST">
                        @csrf
                        <input type="hidden" name="itemId" value="{{ $item->id }}">

                        <div class="mb-3">
                            <label for="ticketDate" class="form-label fw-bold">Ticket Date:</label>
                            <input type="date" class="form-control" id="ticketDate" name="ticketDate" value="{{ date('Y-m-d') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="userCategory" class="form-label fw-bold">User Category:</label>
                            <select class="form-select" id="userCategory" name="userCategory" required>
                                <option value="normalPrice">Normal</option>
                                <option value="childrenSeniorPrice">Children & Senior</option>
                                <option value="studentPrice">Student</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="quantity" class="form-label fw-bold">Quantity:</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" value="1" min="1" required>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('home') }}" class="btn btn-secondary btn-lg">Cancel</a>
                            <button type="submit" class="btn btn-primary btn-lg">Add to Cart</button>
                        </div>
                    </form>
                </div>
            </div>
            @endcan

            @can('isAdmin')
            <!-- Admin Statistics Dashboard -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Booking Statistics Dashboard</h5>
                </div>
                <div class="card-body">
                    <h6 class="border-bottom pb-2 mb-3">Future Bookings</h6>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="stats-box text-center p-3 border rounded">
                                <h6>Paid Orders</h6>
                                <p class="fs-4 fw-bold text-success mb-0">{{ $paidCart }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="stats-box text-center p-3 border rounded">
                                <h6>Pending Orders</h6>
                                <p class="fs-4 fw-bold text-warning mb-0">{{ $unpaidCart }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <h6 class="border-bottom pb-2 mb-3">Today's Bookings</h6>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="stats-box text-center p-3 border rounded">
                                <h6>Paid Orders</h6>
                                <p class="fs-4 fw-bold text-success mb-0">{{ $todayPaidCart }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="stats-box text-center p-3 border rounded">
                                <h6>Pending Orders</h6>
                                <p class="fs-4 fw-bold text-warning mb-0">{{ $todayUnpaidCart }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <h6 class="border-bottom pb-2 mb-3">This Week's Bookings</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="stats-box text-center p-3 border rounded">
                                <h6>Paid Orders</h6>
                                <p class="fs-4 fw-bold text-success mb-0">{{ $weeklyPaidCart }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="stats-box text-center p-3 border rounded">
                                <h6>Pending Orders</h6>
                                <p class="fs-4 fw-bold text-warning mb-0">{{ $weeklyUnpaidCart }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <a href="{{ route('home') }}" class="btn btn-secondary btn-lg">Back to Home</a>
            </div>
            @endcan
        </div>
    </div>
</div>
@endsection
