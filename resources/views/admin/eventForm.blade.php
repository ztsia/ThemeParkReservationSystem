@extends('layouts.app')

@section('title')
    HyperHeaven - {{ isset($event) ? 'Edit' : 'Create' }} Event
@endsection

@section('content')
<form method="POST" action="{{ isset($event) ? route('eventForm.editEvent', $event) : route('eventForm.createEvent') }}" enctype="multipart/form-data">
    @csrf

    @if (isset($event))
        @method('PATCH')
    @endif

    <div class="mb-3">
        <label for="name" class="form-label">Event Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $event->name ?? '') }}">
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description">{{ old('description', $event->description ?? '') }}</textarea>
        @error('description')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" class="form-control" id="image" name="image" accept="image/*">
        @if (isset($event) && $event->image)
            <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->name }}" class="img-thumbnail mt-2" width="100">
        @endif
        @error('image')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="date" class="form-label">Date</label>
        <input type="date" class="form-control" id="date" name="date" value="{{ old('date', $event->date ?? '') }}">
        @error('date')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">{{ isset($event) ? 'Update Event' : 'Create New Event'}}</button>
</form>
@endsection