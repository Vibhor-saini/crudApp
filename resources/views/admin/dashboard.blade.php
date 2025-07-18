@extends('layouts.layout')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Welcome, Admin {{ auth()->user()->name }}</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <a href="{{ route('students.create') }}" class="bg-green-500 text-white p-6 rounded shadow hover:bg-green-600 transition">
            ➕ Register New Student
        </a>
        <a href="{{ route('students-list') }}" class="bg-blue-500 text-white p-6 rounded shadow hover:bg-blue-600 transition">
            📋 View Student List
        </a>
        <!-- Add more admin cards here if needed -->
    </div>
@endsection
