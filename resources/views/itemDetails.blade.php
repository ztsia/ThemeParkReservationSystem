<h1>Item Details for {{ $item['id']}}</h1>
<a href="cart.blade.php"><button>Cart</button></a>

<div>
  <p>Home Page Items...</p>
</div>
<form action="{{ route('itemcontroller.addItem') }}" method="POST">
  @csrf

  <p>{{ $item['id'] }}</p>
  <p>{{ $item['name'] }}</p>
  <p>{{ $item['normalPrice'] }}</p>
  <p>{{ $item['childrenSeniorPrice'] }}</p>
  <p>{{ $item['studentPrice'] }}</p>

  <br><br>
  <input type="hidden" name="userId" value="{{ $user['id'] }}">
  <input type="hidden" name="itemId" value="{{ $item['id'] }}">
  <p>What is the date of the ticket?</p>
  <input type="date" name="ticketDate" value="{{ date('Y-m-d') }}">
  <p>What user category?</p>
  <input type="text" name="userCategory" value="normalPrice">
  <p>How many items u want to add?</p>
  <input type="text" name="itemQty" value="1">
  
  <button type="submit">Add to Cart</button>
  
  {{-- <button onclick="decreaseItemQty()">-</button>
  <input type="text" id="quantityInput" value="1" readonly>
  <button onclick="increaseItemQty()">+</button>
</form>

<script>
  function increaseItemQty () {
    let qtyInput = document.getElementById(quantityInput);
    input.value = parseInt(input.value) + 1;
  }

  function decreaseItemQty() {
      let input = document.getElementById("quantityInput");
      let newValue = parseInt(input.value) - 1;
      if (newValue >= 1) { // Ensure quantity doesn't go below 1
          input.value = newValue;
      }
  }
</script> --}}