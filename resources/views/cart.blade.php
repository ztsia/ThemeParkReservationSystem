<style>
  .container {
    /* text-align: center; */
  }

  table {
    border: 2px solid black;
    border-collapse: collapse;
    width: 100%;
    text-align: center;
  }

  th,
  td {
    border: 1px solid black;
    /* vertical-align: middle;  */
    text-align: center;
  }

  .quantity-container {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
  }

  .quantity-container form {
    display: inline-block;
    /* Ensures the forms stay inline */
  }

  .quantity-container button {
    width: 30px;
    height: 30px;
    text-align: center;
    border: 1px solid black;
    background-color: white;
    cursor: pointer;
  }

  .quantity-container p {
    margin: 0;
    font-weight: bold;
    min-width: 20px;
    text-align: center;
  }
</style>

<h1>Your Cart</h1>

<div class="container">
  <table>
    <tr>
      <th>Item</th>
      <th>Date</th>
      <th>UserCategory</th>
      <th>Quantity</th>
      <th>Price</th>
      <th>Subtotal</th>
      <th>Delete</th>
    </tr>

    @foreach($items as $item)
    <tr>
      <td>{{ $item->item->name }}</td>
      <td>{{ $item->ticket_date }}</td>
      <td>{{ $item->user_category }}</td>
      <td>
        <div class="quantity-container">

          {{-- Decrease cart item quantity --}}
          <form action="{{ route('cartController.updateCart') }}" method="POST">
            @csrf

            <input type="hidden" name="cartId" value="{{ $item->id }}">
            <input type="hidden" name="quantity" value="{{ $item->quantity - 1 }}">
            <button type="submit">-</button>
          </form>

          {{-- Display specific cart item quantity --}}
          <p>{{ $item->quantity }}</p>

          {{-- Increase cart item quantity --}}
          <form action="{{ route('cartController.updateCart') }}" method="POST">
            @csrf

            <input type="hidden" name="cartId" value="{{ $item->id }}">
            <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
            <button type="submit">+</button>
          </form>

        </div>
      </td>
      <td>
        @php
        // Retrieve the item's price based on user category
        $itemPrice = $item->item->getPriceByCategory($item->user_category);
        @endphp
        RM{{ number_format($itemPrice, 2) }}
      </td>
      <td>
        @php
        // Retrieve the item's price based on user category
        $itemPrice = $item->item->getPriceByCategory($item->user_category);
        $subtotal = $itemPrice * $item->quantity;
        @endphp
        RM{{ number_format($subtotal, 2) }}
      </td>
      <td>
        <a href="{{ route('cartController.deleteCart', $item->id) }}">Delete</a>
      </td>
    </tr>
    @endforeach
  </table>

  {{-- Display total price --}}
  <div>
    <h2>Summary</h2>
    @php
    $total = 0; // Initialize total
    @endphp

    @foreach ($items as $item)
    @php
    // Retrieve the item's price based on user category
    $itemPrice = $item->item->getPriceByCategory($item->user_category);
    $subtotal = $itemPrice * $item->quantity;
    $total += $subtotal;
    @endphp
    @endforeach

    <p>Subtotal: RM{{ number_format($total, 2) }}</p>
    <p>Tax (6%): RM{{ number_format($total * 0.06, 2) }}</p>
    <p>Total Price: RM{{ number_format($total * 1.06, 2) }}</p>
  </div>
  <div>
    <div>
      <form action="{{ route('cartController.showCheckoutForm', ['userId' => $items->first()->user_id]) }}" method="GET">
        <input type="submit" value="Checkout">
      </form>
    </div>
  </div>
</div>

<br>
@if(session('success'))
<div style="color:green">
  {{ session('success') }}
</div>
@endif