@extends('layouts.layout')

@section('title', 'Students List')

@section('content')

<h1 class="mb-8 m-5">Update Student</h1>

<div class="p-4 border rounded bg-light shadow-sm m-5">

    <form action="{{ route('students.update', $students->id) }}" enctype="multipart/form-data" method="post">
        @csrf

        <div class="mb-3">
            <img src="{{ $students->image ? asset('storage/' . $students->image) : asset('storage/images/default.png') }}" width="100" height="100" class="rounded-circle mb-2" alt="Student Image"><br>
            <label for="image" class="form-label">Update Image</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Enter Name</label>
            <input type="text" name="name" class="form-control" value="{{ $students->name }}">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Enter Email</label>
            <input type="email" name="email" class="form-control" value="{{ $students->email }}">
        </div>

        <div class="mb-3">
            <label class="form-label d-block">Select Gender</label>
            <div class="form-check form-check-inline">
                <input type="radio" name="gender" value="male" class="form-check-input" {{ $students->gender == 'male' ? 'checked' : '' }}>
                <label class="form-check-label">Male</label>
            </div>
            <div class="form-check form-check-inline">
                <input type="radio" name="gender" value="female" class="form-check-input" {{ $students->gender == 'female' ? 'checked' : '' }}>
                <label class="form-check-label">Female</label>
            </div>
        </div>

        <div class="mb-3">
            <label for="dob" class="form-label">DOB</label>
            <input type="date" name="birthday" class="form-control" value="{{ $students->dob }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Select Country</label>
            <select name="country" class="form-select">
                <option hidden>Select</option>
                @foreach($countries as $country)
                <option value="{{ $country }}" {{ $students->country == $country ? 'selected' : '' }}>
                    {{ $country }}
                </option>
                @endforeach
            </select>
        </div>

        @php
        $allSkills = ['programming', 'design', 'marketing'];
        $selectedSkills = explode(',', $students->skills);
        @endphp

        <div class="mb-3">
            <label class="form-label">Select Department</label><br>
            @foreach($allSkills as $skill)
            <div class="form-check">
                <input type="checkbox" name="skills[]" value="{{ $skill }}" class="form-check-input" {{ in_array($skill, $selectedSkills) ? 'checked' : '' }}>
                <label class="form-check-label">
                    {{ ucwords(str_replace(' ', ',', $skill)) }}
                </label>
            </div>
            @endforeach

        </div>

        <div class="mb-3">
            <input type="submit" class="btn btn-success" value="Update">
            <a href="{{ route('students-list') }}" class="btn btn-secondary">Back</a>
        </div>
    </form>

</div>