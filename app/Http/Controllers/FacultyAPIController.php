<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VaccineRecord;
use App\Models\Faculty;
use App\Models\Program;
use Illuminate\Support\Facades\DB;

class FacultyAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faculties = DB::table('vaccine_record')
        ->join('vaccine','vaccine_record.vac_id','=','vaccine.id')
        ->join('student','vaccine_record.std_id','=','student.id')
        ->join('program','student.std_prg_id', '=', 'program.id')
        ->rightJoin('faculty','program.prg_fac_id','=','faculty.id')
        ->select('faculty.faculty_th',DB::raw('count(distinct vaccine_record.std_id ) as vaccined_count'))
        ->groupBy('faculty.faculty_th')
        ->get();
        return $faculties;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Faculty::create($request->all())) {
            return response()->json(['program' => Faculty::create($request->all()), 'status' => 200, 'message' => 'เพิ่มข้อมูลสำเร็จ']);
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
        $programs = Program::where('prg_fac_id', '=', $id)
            ->get();
        $faculty = DB::table('vaccine_record')
            ->join('vaccine', 'vaccine_record.vac_id', '=', 'vaccine.id')
            ->join('student', 'vaccine_record.std_id', '=', 'student.id')
            ->join('program', 'student.std_prg_id', '=', 'program.id')
            ->rightJoin('faculty', 'program.prg_fac_id', '=', 'faculty.id')
            ->select('faculty.faculty_th', DB::raw('count(distinct vaccine_record.std_id ) as vaccined_count'))
            ->groupBy('faculty.faculty_th')
            ->where('program.prg_fac_id', '=', $id)
            ->get();
        return $faculty;
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
        $faculty = Faculty::find($id);
        if ($faculty->update($request->all())) {
            return response()->json(['faculty' => $faculty, 'status' => 200, 'message' => 'อัพเดทข้อมูลสำเร็จ']);
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
        if (Faculty::destroy($id)) {
            return response()->json(['status' => 200, 'message' => 'ลบข้อมูลสำเร็จ']);
        } else {
            return response()->json(['status' => 404, 'message' => 'ลบข้อมูลไม่สำเร็จ']);
        }
    }
    public function graphFaculty(){
        $faculties = DB::table('vaccine_record')
        ->join('vaccine','vaccine_record.vac_id','=','vaccine.id')
        ->join('student','vaccine_record.std_id','=','student.id')
        ->join('program','student.std_prg_id', '=', 'program.id')
        ->rightJoin('faculty','program.prg_fac_id','=','faculty.id')
        ->select('faculty.faculty_th',DB::raw('count(distinct vaccine_record.std_id ) as vaccined_count'))
        ->groupBy('faculty.faculty_th')
        ->get();
        return $faculties;
    }
}
