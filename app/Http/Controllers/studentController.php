<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\student;


class studentController extends Controller
{

    public function create()
    {
        return view('user.add-student');
    }


    function show()
    {
        $students =  Student::orderBy('id', 'desc')->paginate(5);
        return view('user.student-list', ['students' => $students]);
    }

    function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|regex:/^[A-Za-z\s]+$/|max:255|min:3',
            'email' => 'required|email|unique:students',
            'gender' => 'required',
            'dob' => 'required',
            'country' => 'not_in:0',
            'skills' => 'required|array|min:1',
            'skills.*' => 'string',
            'image' => 'required'
        ], [
            'name.required' => 'Student name is required!',
            'name.string' => 'Student name should be a valid string!',
            'name.regex' => 'Student name should contain only letters and spaces!',
            'name.max' => 'Student name should have less than 255 character!',
            'name.min' => 'Student name should have atleast 3 character!',
            'skills.required' => 'Please select your department!',

        ]);

        $student = new student();
        $student->name = $request->name;
        $student->email = $request->email;
        $student->gender = $request->gender;
        $student->dob = $request->dob;
        $student->country = $request->country;
        $student->skills = implode(',', $request->skills);

        $image = $request->file('image');
        $imagePath = $image->store('images', 'public');
        $student->image = $imagePath;

        $student->save();
        return redirect()->route('students-list');
    }


    function edit($id)
    {
        $student = student::find($id);
        $countries = ['India', 'Berlin', 'Boston', 'Chicago', 'London', 'Los Angeles', 'New York', 'Paris', 'San Francisco'];
        return view('user.edit-student', ['students' => $student, 'countries' =>  $countries]);
    }

    function update(Request $request, $id)
    {
        $student = student::find($id);
        $student->name = $request->name;
        $student->email = $request->email;
        $student->gender = $request->gender;
        $student->dob = $request->birthday;
        $student->country = $request->country;
        $skills = $request->has('skills') ? implode(',', $request->skills) : '';
        $student->skills = $skills;

        $image = $request->file('image');
        $imagePath = $image->store('images', 'public');
        $student->image = $imagePath;

        $student->save();
        return redirect()->route('students-list');
    }

    public function delete($id)
    {
        $isDeleted = Student::destroy($id);

        if ($isDeleted) {
            return redirect('list');
        } else {
            echo "Delete failed or student not found.";
        }
    }

    function deleteMultiple(Request $request)
    {
        $result = student::destroy($request->ids);
        if ($result) {
            return redirect()->route('students-list');
        } else {
            echo "selected student not deleted";
        }
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');

        $studentDetail = Student::where('name', 'like', "%{$searchTerm}%")->paginate(5);

        return view('user.student-list', ['students' => $studentDetail]);
    }

    function uploadImg()
    {
        return "Image uploading";
    }
}
