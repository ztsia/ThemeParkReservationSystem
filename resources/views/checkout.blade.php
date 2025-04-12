<h1>Checkout</h1>

<form action="{{ route('cartController.checkout') }}" method="POST">
    @csrf
    <h2>Address</h2>
    <!-- show name -->
    <p>Name: {{ $user->name }}</p>

    <!-- show address -->
    <div>
        Address Line 1:
        <input type="text" placeholder="Address line 1" name="addressLine1"><br>
        <span style="color: red">@error('addressLine1') {{ $message }} @endError</span><br>
        Address Line 2:
        <input type="text" placeholder="Address line 2" name="addressLine2"><br>
        <span style="color: red">@error('addressLine2') {{ $message }} @endError</span><br>
        Postal Code:
        <input type="text" placeholder="Postal Code" name="postalCode"><br>
        <span style="color: red">@error('postalCode') {{ $message }} @endError</span><br>
        City:
        <input type="text" placeholder="City" name="city"><br>
        <span style="color: red">@error('city') {{ $message }} @endError</span><br>
        Country:
        <input type="text" placeholder="Country" name="country"><br>
        <span style="color: red">@error('country') {{ $message }} @endError</span><br>
    </div>
    <hr>

    <!-- show items -->
    <h2>Items</h2>
    <div>
        @foreach($items as $item)
        <div>
            <div>Themepark: {{ $item->item->name }}</div>
            <div>Ticket Date: {{ $item->ticket_date }}</div>
            <div>Category: {{ $item->user_category }}</div>
            <div>
                @php
                // Retrieve the item's price based on user category
                $itemPrice = $item->item->getPriceByCategory($item->user_category);
                @endphp
                Price: RM{{ number_format($itemPrice, 2) }}
            </div>
            <div>Qty: {{ $item->quantity }}</div>
            <br>
            <div>
                @php
                // Retrieve the item's price based on user category
                $itemPrice = $item->item->getPriceByCategory($item->user_category);
                $subtotal = $itemPrice * $item->quantity;
                @endphp
                Subtotal: RM{{ number_format($subtotal, 2) }}
            </div>
            <hr>
        </div>
        @endforeach
    </div>

    <!-- show payment method, lead to new page to choose: online banking, credit / debit card, cash -->

    <h2>Payment Method</h2>
    <input type="radio" name="paymentMethod" value="onlineBanking"> Online Banking
    <input type="radio" name="paymentMethod" value="credit/debitCard"> Credit/Debit Card
    <input type="radio" name="paymentMethod" value="cashOnDelivery"> Cash on Delivery
    <br><span style="color: red">@error('paymentMethod') {{ $message }} @endError</span><br>
    <hr>


    <!-- show payment details: merchandise subtotal, shipping subtotal, shipping fee sst, total payment -->
    <h2>Payment Details</h2>
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

    <p>Merchandise Subtotal: RM{{ number_format($total, 2) }}</p>
    <p>Tax (6%): RM{{ number_format($total * 0.06, 2) }}</p>
    <p>Total Price: RM{{ number_format(($total * 1.06), 2) }}</p>

    <!-- place holder button, lead to payment page -->
    <input type="submit" value="Place Order">
</form>