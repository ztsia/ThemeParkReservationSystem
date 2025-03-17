<style>
  .container{
    /* text-align: center; */
  }
  table{
    border: 2px solid black;
    border-collapse: collapse;
    width: 100%;
    text-align: center;
  }

  th, td {
    border: 1px solid black;
    /* vertical-align: middle;  */
    text-align: center;
}

.quantity-container {
  display: flex;
  align-items: center;
  justify-content: center; /* Center content inside the container */
  gap: 10px;
}

.quantity-container form {
  display: inline-block; /* Ensures the forms stay inline */
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

@if(session('success'))
  <div>
    {{ session('success') }}
  </div>
@endif
<h1>Your Cart</h1>

<div class="container">
  <table>
    <tr>
      <th>Item</th>
      <th>Date</th>
      <th>UserCategory</th>
      <th>Quantity</th>
      <th>Delete</th>
    </tr>
  
    @foreach($items as $item)
    <tr>
      <td>{{ $item->item->name }}</td>
      <td>{{ $item['ticket_date'] }}</td>
      <td>{{ $item['user_category'] }}</td>
      <td>
        <div class="quantity-container">
  
          {{-- Decrease cart item quantity --}}
          <form action="{{ route('cartcontroller.updateCart') }}" method="POST">
            @csrf
  
            <input type="hidden" name="cartId" value="{{ $item['id'] }}">
            <input type="hidden" name="quantity" value="{{ $item['quantity'] - 1 }}">
            <button type="submit">-</button>
          </form>
          
          {{-- Display specific cart item quantity --}}
          <p>{{ $item['quantity'] }}</p>
  
          {{-- Increase cart item quantity --}}
          <form action="{{ route('cartcontroller.updateCart') }}" method="POST">
            @csrf
  
            <input type="hidden" name="cartId" value="{{ $item['id'] }}">
            <input type="hidden" name="quantity" value="{{ $item['quantity'] + 1 }}">
            <button type="submit">+</button>
          </form>
          
        </div>
      </td>
      <td><a href="{{ route('cartcontroller.deleteCart', $item->id) }}">Delete</a></td>
    </tr>
    @endforeach
  </table>
</div>
