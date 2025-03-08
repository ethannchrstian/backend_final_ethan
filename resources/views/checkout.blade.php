@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold text-white mb-4">Checkout</h1>

    <form action="{{ route('user.cart.processCheckout') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-300">Invoice Number:</label>
            <input type="text" value="{{ $invoiceNumber }}" readonly class="w-full p-2 rounded-lg bg-gray-700 text-white">
        </div>

        <div class="mb-4">
            <label class="block text-gray-300">Alamat Pengiriman:</label>
            <input type="text" name="address" required minlength="10" maxlength="100" class="w-full p-2 rounded-lg bg-gray-700 text-white">
        </div>

        <div class="mb-4">
            <label class="block text-gray-300">Kode Pos:</label>
            <input type="text" name="postal_code" required pattern="\d{5}" class="w-full p-2 rounded-lg bg-gray-700 text-white">
        </div>

        <h2 class="text-xl font-bold text-white mb-4">Items in Cart</h2>
        <div class="bg-gray-800 p-4 rounded-lg shadow-lg">
            @foreach($cart as $id => $item)
                <p class="text-white">
                    {{ $item['name'] }} x{{ $item['quantity'] }} 
                    - Rp. {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                    
                    @if(isset($availableStock[$id]) && $item['quantity'] > $availableStock[$id])
                        <span class="text-red-500 font-bold">Stok tidak mencukupi!</span>
                    @endif
                </p>
            @endforeach
        </div>

        <div class="mt-4">
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                Confirm & Generate Invoice
            </button>
        </div>
    </form>
</div>
@endsection
