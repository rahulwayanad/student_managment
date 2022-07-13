<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Constant\Application;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Student::with('teacher');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = '<a href="'.route('students.edit',$row->id).'" class="edit btn btn-primary btn-sm">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)"  class="edit btn btn-danger btn-delete btn-sm" data-remote="/students/' . $row->id . '">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('student.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student.create',['teachers' => Teacher::all(),'genders' => Application::GENDER]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        Student::create($request->all('name','age','gender','teacher_id'));
        return redirect()->route('students.create')->with('status', 'Student Created Successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$student_id)
    {
        return view('student.edit',['student'=>Student::find($student_id),'teachers' => Teacher::all(),'genders' => Application::GENDER]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(StudentRequest $request, $student_id)
    {
        Student::whereId($student_id)->update($request->all('name','age','gender','teacher_id'));
        return redirect()->route('students.edit',$student_id)->with('status', 'Student Updated Successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($student_id)
    {
        Student::whereId($student_id)->delete();
        return redirect()->route('students.index')->with('status', 'Student Deleted Successfully!');
    }
}
