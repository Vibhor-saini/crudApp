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
        // session()->flash('success', 'Student registered successfully!');
        // return redirect()->route('students-list');

        // set flash message
        session()->flash('success', 'Student added successfully!');

        // send redirect URL in JSON
        return response()->json([
            'redirect' => route('students-list')
        ]);
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

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('images', 'public');
            $student->image = $imagePath;
        }

        $student->save();
        session()->flash('success', 'Student updated successfully!');
        // return redirect()->route('students-list');

        // send redirect URL in JSON
        return response()->json([
            'redirect' => route('students-list')
        ]);
    }

    public function delete($id)
    {
        $isDeleted = Student::destroy($id);

        if ($isDeleted) {
            session()->flash('success', 'Student delete successfully!');
            return redirect('list');
        } else {
            echo "Delete failed or student not found.";
        }
    }

    public function destroy($id)
    {
        $isDeleted = Student::destroy($id);

        if ($isDeleted) {
            session()->flash('success', 'Student delete successfully!');
            return redirect()->route('students-list')->with('success', 'Student deleted successfully!');
        } else {
            echo "Delete failed or student not found.";
        }
    }

    function deleteMultiple(Request $request)
    {
        // dd($request);
        $result = student::destroy($request->ids);
        if ($result) {
            session()->flash('success', 'Students deleted successfully!');
            return redirect('list');
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
