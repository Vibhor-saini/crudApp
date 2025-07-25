@extends('layouts.layout')

@section('title', 'Students List')

@section('content')
<h1 class="mb-4">Add Student</h1>

<form id="studentForm" enctype="multipart/form-data" method="post" class="p-4 border rounded bg-light shadow-sm">
    @csrf

    <div class="mb-3">
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control" value="{{old('name')}}">
        @error('name')
        <div class="alert alert-danger mt-1 p-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="{{old('email')}}">
        @error('email')
        <div class="alert alert-danger mt-1 p-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label d-block">Select Gender</label>
        <div class="form-check form-check-inline">
            <input type="radio" name="gender" value="male" class="form-check-input" {{ old('gender') == 'male' ? 'checked' : '' }}>
            <label for="male" class="form-check-label">Male</label>
        </div>
        <div class="form-check form-check-inline">
            <input type="radio" name="gender" value="female" class="form-check-input" {{ old('gender') == 'female' ? 'checked' : '' }}>
            <label for="female" class="form-check-label">Female</label>
        </div>
        @error('gender')
        <div class="alert alert-danger mt-1 p-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="dob" class="form-label">DOB</label>
        <input type="date" name="dob" id="dob" class="form-control" value="{{ old('dob') }}">
        @error('dob')
        <div class="alert alert-danger mt-1 p-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Select country</label>
        <select name="country" class="form-select">
            <option selected hidden value="0">Select</option>
            <option value="India" {{ old('country') == 'India' ? 'selected' : '' }}>India</option>
            <option value="Berlin" {{ old('country') == 'Berlin' ? 'selected' : '' }}>Berlin</option>
            <option value="Boston" {{ old('country') == 'Boston' ? 'selected' : '' }}>Boston</option>
            <option value="Chicago" {{ old('country') == 'Chicago' ? 'selected' : '' }}>Chicago</option>
            <option value="London" {{ old('country') == 'London' ? 'selected' : '' }}>London</option>
            <option value="Los Angeles" {{ old('country') == 'Los Angeles' ? 'selected' : '' }}>Los Angeles</option>
            <option value="New York" {{ old('country') == 'New York' ? 'selected' : '' }}>New York</option>
            <option value="Paris" {{ old('country') == 'Paris' ? 'selected' : '' }}>Paris</option>
            <option value="San Francisco" {{ old('country') == 'San Francisco' ? 'selected' : '' }}>San Francisco</option>
        </select>
        @error('country')
        <div class="alert alert-danger mt-1 p-1">{{ $message }}</div>
        @enderror
    </div>


    <div class="mb-3">
        <label class="form-label">Select Class</label>
        <select name="class_id" class="form-select">
            <option hidden value="">Select</option>
            @foreach($classes as $class)
            <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>
                {{ $class->class }}
            </option>
            @endforeach
        </select>

        @error('class_id')
        <div class="alert alert-danger mt-1 p-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Select Section</label>
        <select name="section" class="form-select">
            <option selected hidden value="0">Select</option>
            <option value="A" {{ old('class') == 'A' ? 'selected' : '' }}>A</option>
            <option value="B" {{ old('class') == 'B' ? 'selected' : '' }}>B</option>
            <option value="C" {{ old('class') == 'C' ? 'selected' : '' }}>C</option>
        </select>
        @error('section')
        <div class="alert alert-danger mt-1 p-1">{{ $message }}</div>
        @enderror
    </div>


    <div class="mb-3">
        <label class="form-label">Select Skills:</label><br>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="skills[]" value="programming" id="programming">
            <label class="form-check-label" for="programming">Programming</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="skills[]" value="design" id="design">
            <label class="form-check-label" for="design">Design</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="skills[]" value="marketing" id="marketing">
            <label class="form-check-label" for="marketing">Marketing</label>
        </div>
        @error('skills')
        <div class="alert alert-danger mt-1 p-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="file" class="form-label">Choose an Image:</label>
        <input class="form-control" type="file" id="file" name="image">
        @error('image')
        <div class="alert alert-danger mt-1 p-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password:</label>
        <input class="form-control" type="password" id="password" name="password" required>
        @error('password')
        <div class="alert alert-danger mt-1 p-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Register</button>
        <a href="{{ route('login') }}" class="btn btn-secondary">Login</a>
    </div>
</form>

<div id="message"></div>
@endsection

@push('scripts')
<script>
    setTimeout(function() {
        let alert = document.getElementById('success-alert');
        if (alert) {
            alert.classList.remove('show');
            alert.classList.add('fade');
            setTimeout(() => alert.remove(), 500); // remove from DOM
        }
    }, 10000);

    $('#studentForm').on('submit', function(e) {
        e.preventDefault();
        let formData = new FormData(this); //use only when you have images

        $.ajax({
            url: "{{ route('students-add') }}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log("Redirecting to:", response.redirect);
                window.location.href = response.redirect;

                // $('#message').html('<span style="color:green;">AJAX call successful!</span>');
                // console.log("AJAX Success:", response); //confirm it worked
            },
            error: function(xhr) {
                console.error("AJAX Error:", xhr.responseText);
                // $('#message').html('<span style="color:red;">Error: ' + xhr.responseText + '</span>');
            }
        });
    });
</script>
@endpush