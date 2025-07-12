<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\student;


class studentController extends Controller
{

    function show()
    {
        // $student = new student();
        // $students = $student::all();
        // echo "<pre>";
        // print_r($students);
        $students =  Student::paginate(5);
        return view('user.student-list', ['students' => $students]);
    }

    function store(Request $request)
    {
        // dd($request);
        $student = new student();
        $student->name = $request->name;
        $student->email = $request->email;
        $student->gender = $request->gender;
        $student->dob = $request->birthday;
        $student->country = $request->country;
        $student->save();
        return redirect()->route('student-list');
    }


    public function delete($id)
    {
        $isDeleted = Student::destroy($id);

        if ($isDeleted) {
            echo "Deleted successfully";
        } else {
            echo "Delete failed or student not found.";
        }
    }
}
