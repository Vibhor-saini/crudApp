<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\ClassModel;
use Illuminate\Http\Request;
use App\Models\student;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;




class studentController extends Controller
{

    public function create()
    {
        $classes = ClassModel::all(); // Fetch from classes table
        // dd($classes);
        return view('user.add-student', compact('classes'));
    }


    function show()
    {
        $students =  Student::with('class')->orderBy('id', 'desc')->paginate(5);
        return view('user.student-list', ['students' => $students]);
    }


    function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|regex:/^[A-Za-z\s]+$/|max:255|min:3',
            'email' => 'required|email|unique:students|unique:users',
            'gender' => 'required',
            'dob' => 'required',
            'country' => 'not_in:0',
            'skills' => 'required|array|min:1',
            'skills.*' => 'string',
            'image' => 'required',
            'class_id' => 'required|exists:classes,id', // class from dropdown
            'password' => 'required|min:6',
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
        $student->class_id = $request->class_id;


        $image = $request->file('image');
        $imagePath = $image->store('images', 'public');
        $student->image = $imagePath;
        $student->password = Hash::make($request->password);
        $student->save();

        // Create entry in users table for authentication
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user'  // or null if 'user' is the default
        ]);

        Mail::to($student->email)->send(new WelcomeMail($student));

        // set flash messageśś
        session()->flash('success', 'Student added successfully!');
        // send redirect URL in JSON
        return response()->json([
            'redirect' => route('login')
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

    public function studentInfo()
    {
        $student = Student::where('email', Auth::user()->email)->first();

        return view('user.dashboard', compact('student'));
    }

    public function adminDashboard()
    {
        return view('admin.dashboard');
    }

    //=====for update profile------------

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $student = Student::where('email', $user->email)->first();

        $request->validate([
            'current_password' => 'required_with:new_password|nullable|string',
            'new_password' => 'nullable|string|min:6|same:new_password_confirmation',
            'new_password_confirmation' => 'nullable|string|min:6',
        ]);

        // Update only image if present
        if ($student && $request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $student->image = $imagePath;
            $student->save();
        }

        // Password update
        if ($request->filled('new_password')) {
            // Check if current password is correct
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect.']);
            }

            // Update user password
            $user->password = Hash::make($request->new_password);
            $user->save();

            // Update student password too if user is a regular user
            if ($user->role === 'user' && $student) {
                $student->password = Hash::make($request->new_password);
                $student->save();
            }
        }

        return back()->with('success', 'Profile updated successfully.');
    }
}
