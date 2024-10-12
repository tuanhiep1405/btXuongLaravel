<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Passport;
use App\Models\Classroom;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{

    const PATH_VIEW = 'students.';

    public function index(Request $request)
    {
        $search = $request->input('search');
        $students = Student::with(['classroom', 'passport', 'subjects'])
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhereHas('classroom', function ($query) use ($search) {
                        $query->where('name', 'like', "%{$search}%");
                    });
            })
            ->latest('id')->paginate(10);

        //    dd($students);
        return view(self::PATH_VIEW . __FUNCTION__, compact('students'));
    }


    public function show(Student $student)
    {
        $student->load(['passport', 'classroom', 'subjects']);
        // dd($student);

        return view(self::PATH_VIEW . __FUNCTION__, compact('student'));
    }


    public function create()
    {
        $classrooms = Classroom::all();
        $subjects = Subject::all();
        // dd($classrooms);
        return view(self::PATH_VIEW . __FUNCTION__, compact('classrooms', 'subjects'));
    }



    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' =>[ 'required','email',Rule::unique('students','email')],
            'classroom_id' => 'required|exists:classrooms,id',
            'passport_number' => ['required','string',Rule::unique('passports','passport_number')],
            'issued_date' => 'required|date',
            'expiry_date' => 'required|date|after:issued_date',
            'subjects' => 'array|required'
        ]);

        $student = Student::create($data);
        Passport::create([
            'student_id' => $student->id,
            'passport_number' => $data['passport_number'],
            'issued_date' => $data['issued_date'],
            'expiry_date' => $data['expiry_date'],
        ]);

        $student->subjects()->attach($data['subjects']);

        return redirect()->route('students.index')
        ->with('success', 'Học sinh đã được tạo thành công.');
    }



    public function edit(Student $student)
    {
        $classrooms = Classroom::all();
        $subjects = Subject::all();
        $student->load('subjects');
        return view(self::PATH_VIEW . __FUNCTION__, compact('student', 'classrooms', 'subjects'));
    }



    public function update(Request $request, Student $student)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [ 'required','email',Rule::unique('students','email')->ignore($student->id)] ,
            'classroom_id' => 'required|exists:classrooms,id',
            'passport_number' => ['required','string',Rule::unique('passports','passport_number')->ignore($student->passport->id)] ,
            'issued_date' => 'required|date',
            'expiry_date' => 'required|date|after:issued_date',
            'subjects' => 'array|required'
        ]);

        $student->update($data);
        $student->passport->update([
            'passport_number' => $data['passport_number'],
            'issued_date' => $data['issued_date'],
            'expiry_date' => $data['expiry_date'],
        ]);

        $student->subjects()->sync($data['subjects']);

        return redirect()->back()
        ->with('success', 'Học sinh đã cập nhật thành công.');
    }


    
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')
        ->with('success', 'Học sinh đã xóa thành công.');
    }
}
