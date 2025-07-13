<div>
    <form action="{{route('students-add')}}" method="post">
        @csrf
        <label for="name">Enter Name</label>
        <input type="name" name="name">
        <br>
        <br>
        <label for="email">Enter Email</label>
        <input type="email" name="email">
        <br>
        <br>
        Select Gender
        <br>
        <label for="male">Male</label>
        <input type="radio" name="gender" value="male">
        <label for="female">Female</label>
        <input type="radio" name="gender" value="female">

        <br>
        <br>
        <label for="dob">DOB</label>
        <input name="birthday" name="dob" type="date">
        <br>
        <br>
        <label>
            Select country
        </label>
        <select name="country">
            <option selected hidden>Select</option>
            <option value="India">India</option>
            <option value="Berlin">Berlin</option>
            <option value="Boston">Boston</option>
            <option value="Chicago">Chicago</option>
            <option value="London">London</option>
            <option value="Los Angeles">Los Angeles</option>
            <option value="New York">New York</option>
            <option value="Paris">Paris</option>
            <option value="San Francisco">San Francisco</option>
        </select>
        <br>
        <br>
        <input type="submit" value="Register">
    </form>
        <a href="{{ route('students-list') }}">
        <button>View Student</button>
    </a>
</div>