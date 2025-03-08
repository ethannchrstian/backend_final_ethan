@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold text-white mb-4">Your Cart 🛒</h1>

    @if(session('success'))
        <div id="flash-message" class="bg-green-500 text-white p-3 rounded-lg mb-4">
            {{ session('success') }}
        </div>

        <script>
            setTimeout(() => {
                document.getElementById('flash-message')?.remove();
            }, 3000);
        </script>
    @endif

    @if(empty($cart))
        <p class="text-gray-300">Your cart is empty.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($cart as $id => $item)
                <div class="bg-gray-800 p-4 rounded-lg shadow-lg">
                    <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="w-full h-40 object-cover rounded-lg">
                    <h2 class="text-xl font-semibold text-white mt-2">{{ $item['name'] }}</h2>
                    <p class="text-yellow-400 text-lg font-bold">Rp. {{ number_format($item['price'], 0, ',', '.') }}</p>

                    <form action="{{ route('user.cart.update', $id) }}" method="POST" class="flex items-center gap-2 mt-2">
                        @csrf
                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="w-16 p-1 rounded-lg text-black">
                        <button type="submit" class="bg-yellow-500 text-white px-3 py-1 rounded-lg hover:bg-yellow-700">
                            Update
                        </button>
                    </form>

                    <form action="{{ route('user.cart.remove', $id) }}" method="POST" class="mt-2">
                        @csrf
                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-700">
                            Remove
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    @endif

    <div class="mt-6 flex gap-4">
        <a href="{{ route('dashboard') }}" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
            Continue Shopping
        </a>

        @if(!empty($cart))
            <a href="{{ route('user.cart.checkout') }}" class="bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-700">
                Proceed to Checkout
            </a>
        @endif
    </div>
</div>
@endsection
