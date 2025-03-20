<?php

namespace App\Http\Controllers;

use App\Models\Cpl;
use App\Models\Cpmk;
use App\Models\CplCpmk;
use App\Models\Course;
use Illuminate\Http\Request;

class CplCpmkController extends Controller
{
    public function index()
    {
        $cplCpmks = CplCpmk::with(['course', 'cpl', 'cpmk'])->get();
        return view('cpl_cpmk.index', compact('cplCpmks'));
    }
    

    public function create()
    {
        $courses = Course::all(); // Ambil semua data mata kuliah
        $cpls = Cpl::all();
        $cpmks = Cpmk::all();
        
        return view('cpl_cpmk.create', compact('courses', 'cpls', 'cpmks'));
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'cpl_id' => 'required|exists:cpls,id',
            'cpmk_ids' => 'required|array',
            'cpmk_ids.*' => 'exists:cpmks,id',
        ]);
    
        foreach ($request->cpmk_ids as $cpmk_id) {
            CplCpmk::create([
                'course_id' => $request->course_id, // Simpan course_id
                'cpl_id' => $request->cpl_id,
                'cpmk_id' => $cpmk_id,
            ]);
        }
    
        return redirect()->route('cpl_cpmk.index')->with('success', 'Data berhasil disimpan.');
    }
    

}
