<h1>List of students</h1>

<table style="border:1px solid black; border-collapse: collapse; width: 50%;">
    <thead>
        <tr>
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
                <td style="border:1px solid black; padding: 8px;">{{ $student->name }}</td>
                <td style="border:1px solid black; padding: 8px;">{{ $student->email }}</td>
                <td style="border:1px solid black; padding: 8px;">{{ $student->dob }}</td>
                <td style="border:1px solid black; padding: 8px;">{{ $student->gender }}</td>
                <td style="border:1px solid black; padding: 8px;">{{ $student->country }}</td>
                <td style="border:1px solid black;"><a href="{{ route('students.delete', $student->id) }}">Delete</a></td>
                <td style="border:1px solid black;"><a href="#">Edit</a></td>
                </tr>
        @endforeach
      
    </tbody>

</table>
{{ $students->links() }}

<style>
    .w-5.h-5{
        width: 20px;
    }
</style>