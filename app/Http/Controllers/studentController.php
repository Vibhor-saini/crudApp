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
}
