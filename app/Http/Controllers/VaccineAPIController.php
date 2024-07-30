<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vaccine;

class VaccineAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Vaccine::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Vaccine::create($request->all())) {
            return response()->json(['vaccine' => Vaccine::create($request->all()), 'status' => 200, 'message' => 'เพิ่มข้อมูลสำเร็จ']);
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
        return Vaccine::find($id);
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
        $vaccine = Vaccine::find($id);
        if ($vaccine->update($request->all())) {
            return response()->json(['vaccine' => $vaccine, 'status' => 200, 'message' => 'อัพเดทข้อมูลสำเร็จ']);
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
        if (Vaccine::destroy($id)) {
            return response()->json(['status' => 200, 'message' => 'ลบข้อมูลสำเร็จ']);
        } else {
            return response()->json(['status' => 404, 'message' => 'ลบข้อมูลไม่สำเร็จ']);
        }
    }
    /**
     * Search the specified resource from storage.
     *
     * @param  str  $name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
        return Vaccine::where('vaccine','like','%'.$name.'%')->get();
    }
}