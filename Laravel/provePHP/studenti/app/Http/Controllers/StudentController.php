<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function list(){
        $students = Student::all();

        return view('student.welcome', compact("students"));
    }

    public function addStudent(Request $request){
        
        $data = $request->all();

        Student::create($data);

        return redirect("/");
    }

    public function about($id){
        
        $student = Student::find($id);

        return view("student.about", compact('student'));
    }

    public function editStudent(Request $request){

        Student::find($request->input('id'))->update($request->all());
        
        return redirect("/about/" . $request->input('id'));
    }

    public function deleteStudent($id){
        $student = Student::find($id);
        $student->delete();
        return redirect("/");
    }
    
}
