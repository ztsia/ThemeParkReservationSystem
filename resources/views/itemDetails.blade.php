<x-header />

<h1>Item Details for {{ $item['id'] }}</h1>

<form action="{{ route('cartController.addItem') }}" method="POST">
  @csrf

  <p>{{ $item['id'] }}</p>
  <p>{{ $item['name'] }}</p>

  <br><br>
  <!-- if authenticated, pass back user id info -->
  @auth
  <input type="hidden" name="userId" value="{{ auth()->user()->id }}">
  @endauth
  <input type="hidden" name="itemId" value="{{ $item['id'] }}">
  <p>What is the date of the ticket?</p>
  <input type="date" name="ticketDate" value="{{ date('Y-m-d') }}">
  <p>What user category?</p>
  <input type="text" name="userCategory" value="normalPrice">
  <p>How many items u want to add?</p>
  <input type="text" name="quantity" value="1">

  <button type="submit">Add to Cart</button>

  <br><br>
  @if(session('success'))
  <div style="color:green">
    {{ session('success') }}
  </div>
  @endif