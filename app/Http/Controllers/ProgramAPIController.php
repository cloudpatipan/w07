<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Program;

class ProgramAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programs = DB::table('program')
        ->join('student','student.std_prg_id', '=', 'program.id')
        ->join('faculty','program.prg_fac_id','=','faculty.id')
        ->select('program.*','student.sid','faculty.faculty_th')
        ->get();
        return $programs;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Program::create($request->all())) {
            return response()->json(['program' => Program::create($request->all()), 'status' => 200, 'message' => 'เพิ่มข้อมูลสำเร็จ']);
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
        $program = DB::table('program')
        ->join('student','student.std_prg_id', '=', 'program.id')
        ->join('faculty','program.prg_fac_id','=','faculty.id')
        ->select('program.*','student.sid','faculty.faculty_th')
        ->where('program.id','=',$id)
        ->get();
        return $program;
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
        $program = Program::find($id);
        if ($program->update($request->all())) {
            return response()->json(['program' => $program, 'status' => 200, 'message' => 'อัพเดทข้อมูลสำเร็จ']);
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
        if (Program::destroy($id)) {
            return response()->json(['status' => 200, 'message' => 'ลบข้อมูลสำเร็จ']);
        } else {
            return response()->json(['status' => 404, 'message' => 'ลบข้อมูลไม่สำเร็จ']);
        }
    }
    public function search($program_name)
    {
        return Program::where('program_th','like','%'.$program_name.'%')->orWhere('program_en','like','%'.$program_name.'%')->get();
    }
}