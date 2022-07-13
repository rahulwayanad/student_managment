<?php

namespace App\Http\Controllers;

use App\Constant\Application;
use App\Http\Requests\StudentMarkRequest;
use App\Models\Student;
use App\Models\StudentMark;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class StudentMarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = StudentMark::with('student');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="' . route('student-marks.edit', $row->id) . '" class="edit btn btn-primary btn-sm">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)"  class="edit btn btn-danger btn-delete btn-sm" data-remote="/student-marks/' . $row->id . '">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('student-mark.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student-mark.create', ['students' => Student::all(), 'terms' => Application::TERM]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentMarkRequest $request)
    {
        StudentMark::create($request->all('student_id', 'maths', 'science', 'history', 'term'));
        return redirect()->route('student-marks.create')->with('status', 'Student Mark Created Successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\StudentMark $studentMark
     * @return \Illuminate\Http\Response
     */
    public function show(StudentMark $studentMark)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\StudentMark $studentMark
     * @return \Illuminate\Http\Response
     */
    public function edit($studentMarkId)
    {
        return view('student-mark.edit', ['student_mark' => StudentMark::find($studentMarkId), 'students' => Student::all(),'terms' => Application::TERM]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\StudentMark $studentMark
     * @return \Illuminate\Http\Response
     */
    public function update(StudentMarkRequest $request, $studentMarkId)
    {
        StudentMark::whereId($studentMarkId)->update($request->all('student_id', 'maths', 'science', 'history', 'term'));
        return redirect()->route('student-marks.edit',$studentMarkId)->with('status', 'Student Mark Updated Successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\StudentMark $studentMark
     * @return \Illuminate\Http\Response
     */
    public function destroy($studentMarkId)
    {
        StudentMark::whereId($studentMarkId)->delete();
        return redirect()->route('students.index')->with('status', 'Student Mark Deleted Successfully!');
    }
}
