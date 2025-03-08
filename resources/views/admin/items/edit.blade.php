@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold text-white mb-6">Edit Item</h1>

    <div class="bg-gray-900 p-6 rounded-lg shadow-lg max-w-2xl mx-auto">
        <form action="{{ route('admin.items.update', $item->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Category Selection -->
            <div class="mb-4">
                <label for="category_id" class="block text-gray-300 font-medium mb-2">Category</label>
                <select name="category_id" id="category_id" class="w-full p-3 bg-gray-800 text-white rounded-lg border border-gray-600 focus:ring focus:ring-blue-500">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $item->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Name Input -->
            <div class="mb-4">
                <label for="name" class="block text-gray-300 font-medium mb-2">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $item->name) }}" 
                    class="w-full p-3 bg-gray-800 text-white rounded-lg border border-gray-600 focus:ring focus:ring-blue-500" required>
            </div>

            <!-- Price Input -->
            <div class="mb-4">
                <label for="price" class="block text-gray-300 font-medium mb-2">Price (Rp)</label>
                <input type="number" name="price" id="price" value="{{ old('price', $item->price) }}" 
                    class="w-full p-3 bg-gray-800 text-white rounded-lg border border-gray-600 focus:ring focus:ring-blue-500" required>
            </div>

            <!-- Quantity Input -->
            <div class="mb-4">
                <label for="quantity" class="block text-gray-300 font-medium mb-2">Quantity</label>
                <input type="number" name="quantity" id="quantity" value="{{ old('quantity', $item->quantity) }}" 
                    class="w-full p-3 bg-gray-800 text-white rounded-lg border border-gray-600 focus:ring focus:ring-blue-500" required>
            </div>

            <!-- Image Upload -->
            <div class="mb-4">
                <label for="image" class="block text-gray-300 font-medium mb-2">Image</label>
                <input type="file" name="image" id="image" class="w-full p-3 bg-gray-800 text-white rounded-lg border border-gray-600">
                @if($item->image)
                    <div class="mt-3">
                        <p class="text-gray-400 text-sm mb-1">Current Image:</p>
                        <img src="{{ asset('storage/' . $item->image) }}" width="100" class="rounded-lg shadow-md">
                    </div>
                @endif
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-between mt-6">
                <button type="submit" class="bg-yellow-500 text-white px-6 py-2 rounded-lg hover:bg-yellow-600 transition font-semibold shadow-md">
                    Update Item
                </button>
                <a href="{{ route('admin.items.index') }}" class="text-gray-400 hover:text-gray-200 underline text-sm">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
