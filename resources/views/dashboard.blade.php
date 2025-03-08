@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">

    @if(session('success'))
        <div class="bg-green-500 text-white p-3 rounded-lg mb-4">
            {{ session('success') }}
        </div>
    @endif

    <h1 class="text-2xl font-bold text-white mb-4">Katalog Barang</h1>

    <a href="{{ route('user.cart.view') }}" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-700">
        View Cart 🛒
    </a>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
        @foreach($items as $item)
            <div class="bg-gray-800 p-4 rounded-lg shadow-lg">
                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="w-full h-40 object-cover rounded-lg">
                <h2 class="text-xl font-semibold text-white mt-2">{{ $item->name }}</h2>
                <p class="text-gray-400">{{ $item->category->name }}</p>
                <p class="text-yellow-400 text-lg font-bold">Rp. {{ number_format($item->price, 0, ',', '.') }}</p>
                <p class="text-gray-300">Jumlah: {{ $item->quantity }}</p>
                
                <form action="{{ route('user.cart.add', $item->id) }}" method="POST">
                    @csrf
                    <div class="flex items-center gap-2 mt-2">
                        <input type="number" name="quantity" value="1" min="1" class="w-16 p-1 rounded-lg text-black">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                            Tambah ke Faktur
                        </button>
                    </div>
                </form>
                
            </div>
        @endforeach
    </div>
</div>
@endsection
