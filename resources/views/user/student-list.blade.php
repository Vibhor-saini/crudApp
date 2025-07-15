@extends('layouts.layout')

@section('title', 'Students List')

@section('content')
<h1 class="mb-4">Students List</h1>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif


<a href="{{ route('students.create') }}" class="btn btn-primary mb-3" id="addStudentBtn">Add Student</a>

<form action="{{route('students-search')}}">
    <input type="text" name="search" placeholder="Search..." value="{{ request('search')}}">
    <button class="btn btn-success btn-sm mb-1">Search</button>
    @if(request('search'))
    <a href="{{ route('students-search') }}" class="btn btn-secondary btn-sm">Clear</a>
    @endif
</form>

<form action="{{route('students.deleteMulti')}}" method="POST" id="multi-delete-form">
    @csrf

    <button type="button" class="btn btn-sm btn-danger" id="delete-btn">Delete</button>

    <table class="table table-bordered table-striped table-responsive">
        <thead class="table-dark">
            <tr>
                <th><input type="checkbox" id="select-all"> Select</th>
                <th>Name</th>
                <th>Email</th>
                <th>DOB</th>
                <th>Gender</th>
                <th>Country</th>
                <th>Department</th>
                <th>Profile</th>
                <th colspan="2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($students as $student)
            <tr>
                <td><input type="checkbox" name="ids[]" class="student-checkbox" value="{{ $student->id }}"></td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ $student->dob }}</td>
                <td>{{ $student->gender }}</td>
                <td>{{ $student->country }}</td>
                <td>
                    @foreach(explode(',', $student->skills) as $skill)
                    <span>{{ ucwords(str_replace('_', '', $skill)) }}</span>
                    @endforeach
                </td>
                <td>
                    <img src="{{ $student->image ? asset('storage/' . $student->image) : asset('storage/images/default.png') }}"
                        width="100"
                        height="100"
                        class="rounded-circle mb-2"
                        alt="Student Image">
                </td>
                <td>
                    <a href="{{ route('students.edit', $student->id) }}" class="btn btn-sm btn-warning">Edit</a>
                </td>
                <td>
                    <button type="button"
                        class="btn btn-sm btn-danger delete-btn"
                        data-id="{{ $student->id }}">
                        Delete
                    </button>

                </td>
            </tr>
            @empty
            <tr>
                <td colspan="10" class="text-center text-muted">No students found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</form>

{{ $students->links() }}
@endsection

@push('style')
<style>
    .w-5.h-5 {
        width: 20px;
    }
</style>
@endpush

@push('scripts')
<script>
    document.getElementById('select-all').onclick = function() {
        let checkboxes = document.querySelectorAll('.student-checkbox');
        for (let checkbox of checkboxes) {
            checkbox.checked = this.checked;
        }
    };


    setTimeout(function() {
        let alert = document.getElementById('success-alert');
        if (alert) {
            alert.classList.remove('show');
            alert.classList.add('fade');
            setTimeout(() => alert.remove(), 500); // remove from DOM
        }
    }, 1000);

    $(document).ready(function() {
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                const studentId = this.getAttribute('data-id');

                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Create and submit a form dynamically
                        const form = document.createElement('form');
                        form.action = `/students/${studentId}`;
                        form.method = 'POST';

                        form.innerHTML = `
                    @csrf
                    @method('DELETE')
                `;
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            });
        });


        //===============

        document.querySelector('#delete-btn').addEventListener('click', function() {
            const selected = document.querySelectorAll('.student-checkbox:checked');

            if (selected.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'No students selected!',
                    text: 'Please select at least one student to delete.'
                });
                return;
            }

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.querySelector('#multi-delete-form').submit();
                }
            });
        });

        //=====================
        $('.student-checkbox').on('change', function() {
            const total = $('.student-checkbox').length;
            console.log(total);

            const checked = $('.student-checkbox:checked').length;
            console.log(checked);

            $('#select-all').prop('checked', total === checked);
        });
    });
</script>
@endpush