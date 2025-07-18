<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard | Student System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-100 text-gray-800 min-h-screen flex flex-col">

    <!-- Header -->
    <header class="bg-blue-600 text-white shadow-md">
        <div class="container mx-auto flex justify-between items-center px-4 py-3">

            <!-- Logo / Title -->
            <h1 class="text-2xl font-semibold text-white">Student Management System</h1>

            <!-- Right Side: Profile + Logout -->
            @auth
            <div class="flex items-center gap-4">

                <!-- Profile Avatar -->
                @php
                $student = Auth::user()->student;
                $avatar = $student && $student->image
                ? asset('storage/' . $student->image)
                : asset('images/lxB1LTI7rnGgficKNPuS7CgKBicdl5IohGVAj8O2.png'); // Fallback image
                @endphp

                <div class="relative group">
                    <button id="profileButton" class="w-10 h-10 rounded-full overflow-hidden border-2 border-white hover:ring-2 hover:ring-offset-2 hover:ring-blue-300 transition">
                        <img src="{{ $avatar }}" alt="Avatar" class="w-full h-full object-cover">
                    </button>
                    <form action="{{route('logout')}}" method="post">
                        @csrf
                        <button type="submit" style="border:1px solid white; margin-bottom:5px;" class="w-20 h-8">
                           Logout
                        </button>
                    </form>
                </div>
            </div>
            @endauth

        </div>
    </header>


    <!-- Main Body -->
    <div class="flex flex-1">
        <!-- Sidebar (only show if logged in) -->
        @auth
        <aside class="w-64 bg-white shadow-md p-6 hidden md:block">
            <nav class="space-y-4">
                @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="block text-blue-700 font-semibold hover:underline">Dashboard</a>
                <a href="{{ route('students.create') }}" class="block hover:underline">Add Student</a>
                <a href="{{ route('students-list') }}" class="block hover:underline">Student List</a>
                @elseif(auth()->user()->role === 'user')
                <a href="{{ route('student.dashboard') }}" class="block text-blue-700 font-semibold hover:underline">My Dashboard</a>
                @endif
            </nav>
        </aside>
        @endauth




        <!-- Page Content -->
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-3 mt-auto">
        &copy; {{ date('Y') }} Student System
    </footer>

    @stack('scripts')
</body>

</html>