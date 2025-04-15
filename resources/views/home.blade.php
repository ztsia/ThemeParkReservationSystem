@extends('layouts.app')

@section('title', 'HyperHeaven - Home')

@section('content')
<div class="container">
<h2>Upcoming Events</h2>
<div class="row">
    @foreach($events as $event)
    <div class="col-md-4">
        <div class="card mb-3">
            <img src="{{ asset('storage/' . $event->image) }}" class="card-img-top" alt="{{ $event->name }}" style="height:200px; object-fit:cover;">
            <div class="card-body">
                <h5 class="card-title">{{ $event->name }}</h5>
                <p class="card-text">{{ $event->description }}</p>
                <p class="text-muted">Date: {{ $event->date }}</p>
                <a href="#" class="btn btn-primary">Find Out More</a>
            </div>
        </div>
    </div>
    @endforeach
</div>

</div>
@endsection
