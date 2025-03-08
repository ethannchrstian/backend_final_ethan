@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold text-white mb-4">Items List</h1>
    <a href="{{ route('admin.items.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
        Add New Item
    </a>

    <table class="w-full mt-4 bg-gray-800 text-white rounded-lg overflow-hidden">
        <thead>
            <tr class="bg-gray-700">
                <th class="p-3">#</th>
                <th class="p-3">Category</th>
                <th class="p-3">Name</th>
                <th class="p-3">Price</th>
                <th class="p-3">Quantity</th>
                <th class="p-3">Image</th>
                <th class="p-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
                <tr class="border-b border-gray-600">
                    <td class="p-3">{{ $loop->iteration }}</td>
                    <td class="p-3">{{ $item->category->name }}</td>
                    <td class="p-3">{{ $item->name }}</td>
                    <td class="p-3">{{ $item->price }}</td>
                    <td class="p-3">{{ $item->quantity }}</td>
                    <td class="p-3">
                        <img src="{{ asset('storage/' . $item->image) }}" width="50" class="rounded-lg">
                    </td>
                    <td class="p-3">
                        <a href="{{ route('admin.items.edit', $item->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                            Edit
                        </a>
                        <form action="{{ route('admin.items.destroy', $item->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
