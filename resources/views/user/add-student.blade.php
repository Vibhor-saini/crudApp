<div>
    <h1>Add Student</h1>


    <form action="{{route('students-add')}}" enctype="multipart/form-data" method="post">
        @csrf
        <label for="name">Enter Name</label>
        <input type="name" name="name" value="{{old('name')}}">
        @error('name')
        <div style="color: red;" class="alert alert-danger">{{ $message }}</div>
        @enderror
        <br>
        <br>
        <label for="email">Enter Email</label>
        <input type="email" name="email" value="{{old('email')}}">
        @error('email')
        <div style="color: red;" class="alert alert-danger">{{ $message }}</div>
        @enderror
        <br>
        <br>
        Select Gender
        <br>
        <label for="male">Male</label>
        <input type="radio" name="gender" value="male" {{ old('gender') == 'male' ? 'checked' : '' }}>
        <label for="female">Female</label>
        <input type="radio" name="gender" value="female" {{ old('gender') == 'female' ? 'checked' : '' }}>
        @error('gender')
        <div style="color: red;" class="alert alert-danger">{{ $message }}</div>
        @enderror
        <br>
        <br>
        <label for="dob">DOB</label>
        <input type="date" name="dob" id="dob" value="{{ old('dob') }}">

        @error('dob')
        <div style="color: red;" class="alert alert-danger">{{ $message }}</div>
        @enderror
        <br>
        <br>
        <label>
            Select country
        </label>
        <select name="country">
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
        <div style="color: red;" class="alert alert-danger">{{ $message }}</div>
        @enderror
        <br>
        <br>

        <label for="skills">Select Department</label><br>
        <label><input type="checkbox" name="skills[]" value="programming"> Programming</label><br>
        <label><input type="checkbox" name="skills[]" value="web_design"> Web Design</label><br>
        <label><input type="checkbox" name="skills[]" value="database_management"> Database Management</label><br>
        <label><input type="checkbox" name="skills[]" value="project_management"> Project Management</label><br>
        @error('skills')
        <div style="color: red;" class="alert alert-danger">{{ $message }}</div>
        @enderror
        <br>
        <br>
        <label for="file">Choose an Image:</label><br>
        <input type="file" name="image" id="file" class="hidden"><br>
                @error('image')
        <div style="color: red;" class="alert alert-danger">{{ $message }}</div>
        @enderror
        <br>
        <br>
        <input type="submit" value="Register">
    </form>

    <a href="{{ route('students-list') }}">
        <button>View Student</button>
    </a>
</div>