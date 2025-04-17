@extends('layouts.app')

@section('title', 'HyperHeaven - Home')

@section('content')

@if (session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('status') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

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
        </div>
    </div>
    @endforeach
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
        </div>
    </div>
    @endforeach
</div>

@endsection