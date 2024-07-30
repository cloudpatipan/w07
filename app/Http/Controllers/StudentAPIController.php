<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Student;

class StudentAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = DB::table('student')
        ->join('program','student.std_prg_id', '=', 'program.id')
        ->join('faculty','program.prg_fac_id','=','faculty.id')
        ->select('student.*','program.program_th','faculty.faculty_th')
        ->get();
        return $students;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Student::create($request->all())) {
            return response()->json(['student' => Student::create($request->all()), 'status' => 200, 'message' => 'เพิ่มข้อมูลสำเร็จ']);
        } else {
            return response()->json(['status' => 404, 'message' => 'เพิ่มข้อมูลไม่สำเร็จ']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = DB::table('student')
        ->join('program','student.std_prg_id', '=', 'program.id')
        ->join('faculty','program.prg_fac_id','=','faculty.id')
        ->select('student.*','program.program_th','faculty.faculty_th')
        ->where('student.id','=',$id)
        ->get();
        return $student;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $student = Student::find($id);
        if ($student->update($request->all())) {
            return response()->json(['student' => $student, 'status' => 200, 'message' => 'อัพเดทข้อมูลสำเร็จ']);
        } else {
            return response()->json(['status' => 404, 'message' => 'อัพเดทข้อมูลไม่สำเร็จ']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Student::destroy($id);
        if (Student::destroy($id)) {
            return response()->json(['status' => 200, 'message' => 'ลบข้อมูลสำเร็จ']);
        } else {
            return response()->json(['status' => 404, 'message' => 'ลบข้อมูลไม่สำเร็จ']);
        }
    }
    public function search($sid)
    {
        return Student::where('sid','like','%'.$sid.'%')->get();
    }
}