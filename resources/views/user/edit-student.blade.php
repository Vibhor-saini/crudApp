<h1>Update student</h1>
<div>
    <form action="{{ route('students.update', $students->id) }}" enctype="multipart/form-data" method="post">
        @csrf
        <img src="{{ asset('storage/' . $students->image) }}" width="100" height="100px" style="border-radius: 100%;"  alt="Student Image"><br><br>
        <input type="file" name="image" id="image">
        <br>
        <br>
        <label for="name">Enter Name</label>
        <input type="name" name="name" value="{{$students->name}}">
        <br>
        <br>
        <label for="email">Enter Email</label>
        <input type="email" name="email" value="{{$students->email}}">
        <br>
        <br>
        Select Gender
        <br>
        <label for="male">Male</label>
        <input type="radio" name="gender" value="male" {{ $students->gender == 'male' ? 'checked' : '' }}>
        <label for="female">Female</label>
        <input type="radio" name="gender" value="female" {{ $students->gender == 'female' ? 'checked' : '' }}>
        <br>
        <br>
        <label for="dob">DOB</label>
        <input name="birthday" name="dob" type="date" value="{{$students->dob}}">
        <br>
        <br>
        <label>
            Select country
        </label>
        <select name="country">
            <option hidden>Select</option>
            @foreach($countries as $country)
            <option value="{{ $country }}" {{ $students->country == $country ? 'selected' : '' }}>{{ $country }}</option>
            @endforeach
        </select>
        <br>
        <br>
        @php
        $allSkills = ['programming', 'web_design', 'database_management', 'project_management'];
        $selectedSkills = explode(',', $students->skills);
        @endphp

        <label for="skills">Select Department</label><br>
        @foreach($allSkills as $skill)
        <label>
            <input type="checkbox" name="skills[]" value="{{ $skill }}"
                {{ in_array($skill, $selectedSkills) ? 'checked' : '' }}>
            {{ ucwords(str_replace('_', ' ', $skill)) }}
        </label><br>
        @endforeach
        <br>
        <input type="submit" value="Update">
    </form>
    <a href="{{ route('students-list') }}">
        <button>Back</button>
    </a>
</div>