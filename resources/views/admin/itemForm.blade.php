@extends('layouts.app')

@section('title')
    HyperHeaven - {{ isset($item) ? 'Edit' : 'Create' }} Item
@endsection

@section('content')
<form method="POST" action="{{ isset($item) ? route('item.edit', $item) : route('item.create') }}" enctype="multipart/form-data">
    @csrf

    @if (isset($item))
        @method('PATCH')
    @endif

    <div class="mb-3">
        <label for="name" class="form-label">Item Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $item->name ?? '') }}">
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description">{{ old('description', $item->description ?? '') }}</textarea>
        @error('description')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" class="form-control" id="image" name="image" accept="image/*">
        @if (isset($item) && $item->image)
            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="img-thumbnail mt-2" width="100">
        @endif
        @error('image')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="normalPrice" class="form-label">Normal Price</label>
        <input type="number" step="0.01" class="form-control" id="normalPrice" name="normalPrice" value="{{ old('normalPrice', $item->normalPrice ?? '') }}">
        @error('normalPrice')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="childrenSeniorPrice" class="form-label">Children and Senior Citizen Price</label>
        <input type="number" step="0.01" class="form-control" id="childrenSeniorPrice" name="childrenSeniorPrice" value="{{ old('childrenSeniorPrice', $item->childrenSeniorPrice ?? '') }}">
        @error('childrenSeniorPrice')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="studentPrice" class="form-label">Student Price</label>
        <input type="number" step="0.01" class="form-control" id="studentPrice" name="studentPrice" value="{{ old('studentPrice', $item->studentPrice ?? '') }}">
        @error('studentPrice')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">{{ isset($item) ? 'Update Item' : 'Create New Item'}}</button>
</form>
@endsection
