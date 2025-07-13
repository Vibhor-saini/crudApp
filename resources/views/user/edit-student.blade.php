<h1>Update student</h1>
<div>
    <form action="{{ route('students.update', $students->id) }}" method="post">
        @csrf
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
        <input type="submit" value="Update">
    </form>
</div>