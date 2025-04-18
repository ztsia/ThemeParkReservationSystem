@extends('layouts.app')

@section('title', 'HyperHeaven - Home')

@section('content')

@if (session('status'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('status') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="container text-center mt-5">
    <h2>Upcoming Events</h2>
    <div class="row">
        @foreach($events as $event)
        <div class="col-md-4">
            <div class="card mb-3">
                <img src="{{ asset('storage/' . $event->image) }}" class="card-img-top" alt="{{ $event->name }}" style="height:200px; object-fit:cover;">
                <div class="card-body">
                    <h5 class="card-title">{{ $event->name }}</h5>
                    <p class="card-text">{{ $event->description }}</p>
                    <p class="text-muted">Date: {{ \Carbon\Carbon::parse($event->date)->format('F j, Y') }}</p>
                </div>
                {{-- admin only --}}
                @can('isAdmin')
                <div class="card-footer text-muted">
                    <h6 class="mb-2 text-uppercase fw-bold">Admin Actions</h6>
                    <a href="{{ route('event.editForm', ['event' => $event->id]) }}" class="btn btn-info">Edit Event</a>
                    
                    <form method="POST" action="{{ route('event.delete', ['event' => $event->id]) }}" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" 
                                onclick="return confirm('Are you sure you want to delete this event?')">
                            Delete Event
                        </button>
                    </form>
                </div>
                @endcan

            </div>
        </div>
        @endforeach

        @can('isAdmin')
        <div class="col-md-4">
            <div class="card mb-3">
                <a href="{{ route('event.createForm') }}" class="stretched-link text-decoration-none">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center" style="height:200px; background-color: #f8f9fa;">
                        <div class="mb-3 text-primary">
                            <i class="fas fa-plus-circle" style="font-size: 3rem;"></i>
                        </div>
                        <h5 class="card-title text-primary">Add New Event</h5>
                    </div>
                </a>
            </div>
        </div>
        @endcan
        
    </div>
    <h2 class="mt-5">Explore Our Attractions</h2>
    <div class="row">
        @foreach($items as $item)
        <div class="col-md-4">
            <div class="card mb-3">
                <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top" alt="{{ $item->name }}" style="height:200px; object-fit:cover;">
                <div class="card-body">
                    <h5 class="card-title">{{ $item->name }}</h5>
                    <p class="card-text">{{ $item->description }}</p>
                    <a href="{{ route('showItems', ['item' => $item->id]) }}" class="btn btn-primary">See Details</a>
                </div>
                @can('isAdmin')
                <div class="card-footer text-muted">
                    <h6 class="mb-2 text-uppercase fw-bold">Admin Actions</h6>
                    <a href="{{ route('item.editForm', ['item' => $item->id]) }}" class="btn btn-info">Edit Item</a>
                    
                    <form method="POST" action="{{ route('item.delete', ['item' => $item->id]) }}" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" 
                                onclick="return confirm('Are you sure you want to delete this item?')">
                            Delete Item
                        </button>
                    </form>
                </div>
                @endcan
            </div>
        </div>
        @endforeach

        @can('isAdmin')
        <div class="col-md-4">
            <div class="card mb-3">
                <a href="{{ route('item.createForm') }}" class="stretched-link text-decoration-none">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center" style="height:200px; background-color: #f8f9fa;">
                        <div class="mb-3 text-primary">
                            <i class="fas fa-plus-circle" style="font-size: 3rem;"></i>
                        </div>
                        <h5 class="card-title text-primary">Add New Attraction</h5>
                    </div>
                </a>
            </div>
        </div>
        @endcan
    </div>
</div>
@endsection
