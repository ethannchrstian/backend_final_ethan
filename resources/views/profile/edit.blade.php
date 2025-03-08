@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6 bg-gray-900 text-white rounded-lg">
        <h1 class="text-2xl font-bold mb-4">Profile Information</h1>

        <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
            <p><strong>Name:</strong> {{ auth()->user()->name }}</p>
            <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
            <p><strong>Phone Number:</strong> {{ auth()->user()->phone_number ?? 'Not Provided' }}</p>

            @if(auth()->user()->role === 'admin')
                <p><strong>Admin ID:</strong> {{ auth()->user()->idadmin ?? 'N/A' }}</p>
            @endif
        </div>

        <a href="{{ route('dashboard') }}" class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-800">
            Back to Dashboard
        </a>
    </div>
@endsection
