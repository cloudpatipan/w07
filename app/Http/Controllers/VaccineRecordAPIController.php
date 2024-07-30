<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\VaccineRecord;

class VaccineRecordAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vaccine_records = DB::table('vaccine_record')
            ->join('vaccine', 'vaccine_record.vac_id', '=', 'vaccine.id')
            ->join('student', 'vaccine_record.std_id', '=', 'student.id')
            ->select('vaccine_record.*', 'vaccine.vaccine', 'student.sid')
            ->get();
        return $vaccine_records;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (VaccineRecord::create($request->all())) {
            return response()->json(['vaccine_record' => VaccineRecord::create($request->all()), 'status' => 200, 'message' => 'เพิ่มข้อมูลสำเร็จ']);
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
        $vaccine_record = DB::table('vaccine_record')
            ->join('vaccine', 'vaccine_record.vac_id', '=', 'vaccine.id')
            ->join('student', 'vaccine_record.std_id', '=', 'student.id')
            ->select('vaccine_record.*', 'vaccine.vaccine', 'student.sid')
            ->where('vaccine_record.id', '=', $id)
            ->get();
        return $vaccine_record;
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
        $vaccine_record = VaccineRecord::find($id);

        if ($vaccine_record->update($request->all())) {
            return response()->json(['vaccine_record' => $vaccine_record, 'status' => 200, 'message' => 'อัพเดทข้อมูลสำเร็จ']);
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
        if (VaccineRecord::destroy($id)) {
            return response()->json(['status' => 200, 'message' => 'ลบข้อมูลสำเร็จ']);
        } else {
            return response()->json(['status' => 404, 'message' => 'ลบข้อมูลไม่สำเร็จ']);
        }
    }

    public function search($vaccined_date)
    {
        return VaccineRecord::where('vaccine_date', 'like', '%' . $vaccined_date . '%')->get();
    }
}