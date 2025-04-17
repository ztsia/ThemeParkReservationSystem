@extends('layouts.app')

@section('title')
    HyperHeaven - {{ isset($item) ? 'Edit' : 'Create' }} Item
@endsection

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">{{ isset($item) ? 'Edit Item' : 'Create New Item' }}</h4>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ isset($item) ? route('item.edit', $item) : route('item.create') }}" enctype="multipart/form-data">
                        @csrf

                        @if (isset($item))
                            @method('PATCH')
                        @endif

                        <div class="mb-4">
                            <label for="name" class="form-label fw-bold">Item Name</label>
                            <input type="text" class="form-control form-control-lg" id="name" name="name" value="{{ old('name', $item->name ?? '') }}">
                            @error('name')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label fw-bold">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="4">{{ old('description', $item->description ?? '') }}</textarea>
                            @error('description')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="image" class="form-label fw-bold">Image</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            @if (isset($item) && $item->image)
                                <div class="mt-2">
                                    <p class="text-muted">Current image:</p>
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="img-thumbnail" width="150">
                                </div>
                            @endif
                            @error('image')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-4">
                                <label for="normalPrice" class="form-label fw-bold">Normal Price</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" step="0.01" class="form-control" id="normalPrice" name="normalPrice" value="{{ old('normalPrice', $item->normalPrice ?? '') }}">
                                </div>
                                @error('normalPrice')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-4">
                                <label for="childrenSeniorPrice" class="form-label fw-bold">Children/Senior Price</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" step="0.01" class="form-control" id="childrenSeniorPrice" name="childrenSeniorPrice" value="{{ old('childrenSeniorPrice', $item->childrenSeniorPrice ?? '') }}">
                                </div>
                                @error('childrenSeniorPrice')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-4">
                                <label for="studentPrice" class="form-label fw-bold">Student Price</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" step="0.01" class="form-control" id="studentPrice" name="studentPrice" value="{{ old('studentPrice', $item->studentPrice ?? '') }}">
                                </div>
                                @error('studentPrice')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('home') }}" class="btn btn-secondary me-md-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">
                                {{ isset($item) ? 'Update Item' : 'Create New Item'}}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
