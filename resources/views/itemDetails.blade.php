
@extends('layouts.app')

@section('title', 'HyperHeaven - Home')

@section('content')
<h1>Item Details for {{ $item->name }}</h1>

<img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" style="max-height:300px; object-fit:cover;">

<p><strong>Description:</strong> {{ $item->description }}</p>
<p><strong>Normal Price:</strong> RM {{ number_format($item->normalPrice, 2) }}</p>
<p><strong>Children & Senior Price:</strong> RM {{ number_format($item->childrenSeniorPrice, 2) }}</p>
<p><strong>Student Price:</strong> RM {{ number_format($item->studentPrice, 2) }}</p>

<hr>

<form action="{{ route('cartController.addItem') }}" method="POST">
  @csrf

  @auth
    <input type="hidden" name="userId" value="{{ auth()->user()->id }}">
  @endauth

  <input type="hidden" name="itemId" value="{{ $item->id }}">

  <p><strong>Ticket Date:</strong></p>
  <input type="date" name="ticketDate" value="{{ date('Y-m-d') }}" required>

  <p><strong>User Category:</strong></p>
  <select name="userCategory" required>
    <option value="normalPrice">Normal</option>
    <option value="childrenSeniorPrice">Children & Senior</option>
    <option value="studentPrice">Student</option>
  </select>

  <p><strong>Quantity:</strong></p>
  <input type="number" name="quantity" value="1" min="1" required>

  <br><br>
  <button type="submit">Add to Cart</button>
</form>

@if(session('success'))
  <div style="color:green; margin-top: 10px;">
    {{ session('success') }}
  </div>
@endif

@endsection

