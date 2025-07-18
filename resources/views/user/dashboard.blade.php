@extends('layouts.layout')

@section('content')
<h2 class="text-2xl font-bold mb-4">Welcome, {{ $student->name }}</h2>


<!-- Profile Modal -->
<div id="profileModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div id="profileModalContent" class="bg-white w-full max-w-md md:max-w-sm p-6 rounded-lg shadow-lg relative">

        <!-- Flash Success Message -->
        @if(session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-3 text-sm success-message">
            {{ session('success') }}
        </div>
        @endif

        <!-- Validation Errors -->
        @if($errors->any())
        <div class="bg-red-100 text-red-700 p-2 rounded mb-3 text-sm error-message">
            <ul class="list-disc pl-5 space-y-1">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif


        <!-- Close button -->
        <button onclick="closeProfileModal()" class="absolute top-2 right-3 text-gray-500 hover:text-gray-800 text-xl">&times;</button>


        <!-- Update Profile -->
        <h3 class="text-lg font-semibold mb-3">Update Profile</h3>

        <form action="{{ route('student.updateProfile') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3 text-center">
                @if($student->image)
                <img src="{{ asset('storage/'.$student->image) }}" alt="Profile" class="mx-auto w-20 h-20 rounded-full object-cover mb-2">
                @endif
                <input type="file" name="image" class="w-full border px-3 py-2 rounded">
            </div>

            <hr class="my-4">

            <!-- Change Password -->
            <h3 class="text-lg font-semibold mb-3">Change Password</h3>
            <div class="mb-3">
                <label class="block font-medium">Current Password</label>
                <input type="password" name="current_password" class="w-full border px-3 py-2 rounded">
            </div>

            <div class="mb-3">
                <label class="block font-medium">New Password</label>
                <input type="password" name="new_password" class="w-full border px-3 py-2 rounded">
            </div>

            <div class="mb-3">
                <label class="block font-medium">Confirm Password</label>
                <input type="password" name="new_password_confirmation" class="w-full border px-3 py-2 rounded">
            </div>

            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 w-full">Update</button>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
    const modal = document.getElementById('profileModal');
    const modalContent = document.getElementById('profileModalContent');

    document.getElementById('profileButton').addEventListener('click', () => {
        modal.classList.remove('hidden');
    });

    function closeProfileModal() {
        modal.classList.add('hidden');
    }

    // Close when clicking outside modal
    window.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeProfileModal();
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        @if(session('success') || $errors->any())
        const modal = document.getElementById('profileModal');
        modal.classList.remove('hidden');

        // Auto-close after 2.5 seconds
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 2500);
        @endif
    });

    function closeProfileModal() {
        document.getElementById('profileModal').classList.add('hidden');
    }
</script>
@endpush