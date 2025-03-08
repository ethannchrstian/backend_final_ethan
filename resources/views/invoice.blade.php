@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold text-white mb-4">Invoice</h1>

    <div class="bg-gray-800 p-4 rounded-lg shadow-lg">
        <p class="text-white">Invoice Number: {{ $invoice->invoice_number }}</p>
        <p class="text-white">Alamat Pengiriman: {{ $invoice->address }}</p>
        <p class="text-white">Kode Pos: {{ $invoice->postal_code }}</p>

        <h2 class="text-xl font-bold text-white mt-4">Items</h2>
        @php $items = json_decode($invoice->items, true); @endphp
        @foreach($items as $item)
        <p class="text-white">
        {{ $item['name'] }} (Category: {{ $item['category'] ?? 'N/A' }}) 
        x{{ $item['quantity'] }} - Rp. {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
    </p>
            {{-- <p class="text-white">{{ $item['name'] }} x{{ $item['quantity'] }} - Rp. {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</p> --}}
        @endforeach

        <p class="text-yellow-400 text-lg font-bold mt-4">Total Harga: Rp. {{ number_format($invoice->total_price, 0, ',', '.') }}</p>
    </div>

    <div class="mt-4">
        <button onclick="window.print()" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            Print Invoice
        </button>
    </div>
</div>
@endsection
