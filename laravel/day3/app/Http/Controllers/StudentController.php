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

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'user_id' => 'nullable|exists:users,id',
        ]);

        Student::create($data);
        return redirect('/students')->with('success', 'Student created.');
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'user_id' => 'nullable|exists:users,id',
        ]);

        $student->update($data);
        return redirect('/students')->with('success', 'Student updated.');
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return redirect('/students')->with('success', 'Student deleted.');
    }
}
