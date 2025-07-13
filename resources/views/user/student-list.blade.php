<h1>List of students</h1>
<a href="{{ route('students.create') }}">
    <button>Add Student</button>
</a>
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
                <th style="border:1px solid black; padding: 8px;">Country</th>
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
                <td style="border:1px solid black; padding: 8px;">{{ $student->country }}</td>
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
    document.getElementById('select-all').addEventListener('click', function(event) {
        const checked = event.target.checked;
        document.querySelectorAll('.student-checkbox').forEach(function(checkbox) {
            checkbox.checked = checked;
        });
    });
</script>