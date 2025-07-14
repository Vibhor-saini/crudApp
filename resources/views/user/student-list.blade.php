<h1>List of students</h1>
<a href="{{ route('students.create') }}">
    <button>Add Student</button>
</a>

<form action="{{route('students-search')}}" method="get">
    <input type="text" name="search" placeholder="Sarch Here" value="{{ request('search') }}">
    <button>Search</button>
</form>

<form action="{{route('students.deleteMulti')}}" method="post">
    @csrf
    <button>Delete</button>


    <table style="border:1px solid black; border-collapse: collapse; width: 50%;">
        <thead>
            <tr>
                <th style="border:1px solid black; padding: 8px;"><input type="checkbox" id="select-all"> Select All</th>
                <th style="border:1px solid black; padding: 8px;">Name</th>
                <th style="border:1px solid black; padding: 8px;">Email</th>
                <th style="border:1px solid black; padding: 8px;">DOB</th>
                <th style="border:1px solid black; padding: 8px;">Gender</th>
                <th style="border:1px solid black; padding: 8px;">Department</th>
                <th style="border:1px solid black; padding: 8px;">Country</th>
                <th style="border:1px solid black; padding: 8px;">Profile</th>
                <th>Operations</th>
            </tr>
        </thead>

        <tbody>

            @foreach ($students as $student)
            <tr>
                <td style="border:1px solid black; padding: 8px;"><input class="student-checkbox" type="checkbox" name="ids[]" value="{{$student->id}}"></td>
                <td style="border:1px solid black; padding: 8px;">{{ $student->name }}</td>
                <td style="border:1px solid black; padding: 8px;">{{ $student->email }}</td>
                <td style="border:1px solid black; padding: 8px;">{{ $student->dob }}</td>
                <td style="border:1px solid black; padding: 8px;">{{ $student->gender }}</td>
                <td style="border:1px solid black; padding: 8px;">
                    @foreach (explode(',', $student->skills) as $skill)
                    {{ ucwords(str_replace('_', ' ', $skill)) }}
                    @if (!$loop->last),
                    @endif
                    @endforeach
                </td>
                <td style="border:1px solid black; padding: 8px;">{{ $student->country }}</td>
                <td style="border:1px solid black; padding: 8px;">@if ($student->image)
                    <img src="{{ asset('storage/' . $student->image) }}" width="100" height="100px" style="border-radius: 100%;" alt="Student Image">
                    @else
                    <p></p>
                    @endif
                </td>

                <td style="border:1px solid black;"><a href="{{ route('students.delete', $student->id) }}">Delete</a></td>
                <td style="border:1px solid black;"><a href="{{ route('students.edit', $student->id) }}">Edit</a></td>
            </tr>
            @endforeach

        </tbody>

    </table>
</form>
{{ $students->links() }}

<style>
    .w-5.h-5 {
        width: 20px;
    }
</style>

<script>
    document.getElementById('select-all').onclick = function() {
        let checkboxes = document.querySelectorAll('.student-checkbox');
        for (let checkbox of checkboxes) {
            checkbox.checked = this.checked;
        }
    };
</script>