<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('user')->get();
        return view('allStudents', compact('students'));
    }

    public function show($id)
    {
        $student = Student::with('user')->find($id);

        if (! $student) {
            $error = "Student with ID {$id} was not found.";
            return view('student', compact('error'))->with('student', null);
        }

        return view('student', compact('student'))->with('error', null);
    }
}
