@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold text-white mb-4">Add New Item</h1>

    <form action="{{ route('admin.items.store') }}" method="POST" enctype="multipart/form-data" class="bg-gray-800 p-6 rounded-lg shadow-lg">
        @csrf

        <div class="mb-4">
            <label for="category_id" class="block text-white font-medium">Category</label>
            <select name="category_id" id="category_id" class="w-full p-2 bg-gray-700 text-white rounded-lg">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="name" class="block text-white font-medium">Name</label>
            <input type="text" name="name" id="name" class="w-full p-2 bg-gray-700 text-white rounded-lg" required>
        </div>

        <div class="mb-4">
            <label for="price" class="block text-white font-medium">Harga Barang</label>
            <div class="relative">
                <span class="absolute left-3 top-2 text-gray-400">Rp.</span>
                <input type="text" id="price" name="formatted_price" class="pl-10 p-2 rounded-lg bg-gray-700 text-white border border-gray-500 w-full" required>
                <input type="hidden" id="price_raw" name="price">
            </div>
        </div>

        <script>
            document.getElementById('price').addEventListener('input', function (e) {
                let value = e.target.value.replace(/\D/g, ""); // Remove everything except numbers

                if (value) {
                    e.target.value = `Rp. ${new Intl.NumberFormat('id-ID').format(value)}`;
                } else {
                    e.target.value = "";
                }

                // Set hidden input for backend
                document.getElementById('price_raw').value = value;
            });

            document.getElementById('price').addEventListener('blur', function (e) {
                if (e.target.value === "Rp. ") {
                    e.target.value = "";
                }
            });
        </script>

        <div class="mb-4">
            <label for="quantity" class="block text-white font-medium">Quantity</label>
            <input type="number" name="quantity" id="quantity" class="w-full p-2 bg-gray-700 text-white rounded-lg" required>
        </div>

        <div class="mb-4">
            <label for="image" class="block text-white font-medium">Image</label>
            <input type="file" name="image" id="image" class="w-full p-2 bg-gray-700 text-white rounded-lg">
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            Save Item
        </button>
        <a href="{{ route('admin.items.index') }}" class="ml-3 text-gray-300 hover:underline">Cancel</a>
    </form>
</div>
@endsection
