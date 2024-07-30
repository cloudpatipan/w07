<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VaccineProgramChartController extends Controller
{
    public function index()
    {

        $vaccineCountsByProgram = DB::table('vaccine_record')
            ->join('student', 'student.id', '=', 'vaccine_record.std_id')
            ->join('program', 'student.std_prg_id', '=', 'program.id')
            ->select(DB::raw('program_th, count(*) as vaccine_count'))
            ->whereYear('vaccine_record.vaccined_date', 2023)
            ->groupBy('program_th')
            ->orderBy('program_th')
            ->get();

        return view('vaccine.vaccine_program_chart', compact('vaccineCountsByProgram'));
    }
}
