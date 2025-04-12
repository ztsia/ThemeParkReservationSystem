<div>
    @auth
    <a href="{{ route('cartController.showCartList', ['userId' => auth()->user()->id]) }}">
        <button>Cart</button>
    </a>
    @else
    <a href="{{ route('login') }}">
        <button>Cart</button>
    </a>
    @endauth
</div>