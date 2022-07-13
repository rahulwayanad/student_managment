<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeacherRequest;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Teacher::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = '<a href="'.route('teachers.edit',$row->id).'" class="edit btn btn-primary btn-sm">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)"  class="edit btn btn-danger btn-delete btn-sm" data-remote="/teachers/' . $row->id . '">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('teacher.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teacher.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeacherRequest $request)
    {
        Teacher::create($request->all('name'));
        return redirect()->route('teachers.create')->with('status', 'Teacher Created Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit($teacher_id)
    {
        return view('teacher.edit',['teacher'=>Teacher::find($teacher_id)]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(TeacherRequest $request,  $teacher_id)
    {
        Teacher::whereId($teacher_id)->update($request->all('name'));
        return redirect()->route('teachers.edit',$teacher_id)->with('status', 'Teacher Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy($teacher_id)
    {
        Teacher::whereId($teacher_id)->delete();
        return redirect()->route('students.index')->with('status', 'Teacher Deleted Successfully!');
    }
}
