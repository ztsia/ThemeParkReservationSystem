@extends('layouts.app')

@section('title')
    HyperHeaven - {{ isset($event) ? 'Edit' : 'Create' }} Event
@endsection

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">{{ isset($event) ? 'Edit Event' : 'Create New Event' }}</h4>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ isset($event) ? route('event.edit', $event) : route('event.create') }}" enctype="multipart/form-data">
                        @csrf

                        @if (isset($event))
                            @method('PATCH')
                        @endif

                        <div class="mb-4">
                            <label for="name" class="form-label fw-bold">Event Name</label>
                            <input type="text" class="form-control form-control-lg" id="name" name="name" value="{{ old('name', $event->name ?? '') }}">
                            @error('name')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label fw-bold">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="4">{{ old('description', $event->description ?? '') }}</textarea>
                            @error('description')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="image" class="form-label fw-bold">Image</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            @if (isset($event) && $event->image)
                                <div class="mt-2">
                                    <p class="text-muted">Current image:</p>
                                    <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->name }}" class="img-thumbnail" width="150">
                                </div>
                            @endif
                            @error('image')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="date" class="form-label fw-bold">Event Date</label>
                            <input type="date" class="form-control" id="date" name="date" value="{{ old('date', $event->date ?? '') }}">
                            @error('date')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('home') }}" class="btn btn-secondary me-md-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">
                                {{ isset($event) ? 'Update Event' : 'Create New Event'}}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection