<?php

namespace App\Http\Controllers;

use App\Models\Cpmk;
use App\Models\Material;
use App\Models\CplCpmk;
use Illuminate\Support\Facades\DB;

use App\Models\Course;
use Illuminate\Http\Request;

class CpmkController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $cpmks = Cpmk::with('course')->get(); 
        $courses = Course::all(); // Ambil semua Mata Kuliah untuk filter
    
        return view('cpmks.index', compact('cpmks', 'courses'));
    }
    


    public function create()
    {
        $courses = Course::with('cpls')->get();
    
        // Buat mapping Course ke CPL
        $courseCplMap = $courses->mapWithKeys(function ($course) {
            return [
                $course->id => $course->cpls->map(function ($cpl) {
                    return [
                        'id' => $cpl->id,
                        'code' => $cpl->code,
                        'description' => $cpl->description
                    ];
                })
            ];
        });
    
        return view('cpmks.create', compact('courses', 'courseCplMap'));
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'cpl_id' => 'required|exists:cpls,id',
            'cpmks' => 'required|array|min:1',
            'cpmks.*.code' => 'required|string|max:255',
            'cpmks.*.description' => 'required|string',
        ]);
    
        DB::transaction(function () use ($request) {
            foreach ($request->cpmks as $cpmk) {
                // Simpan ke tabel cpmks dulu
                $newCpmk = Cpmk::create([
                    'course_id' => $request->course_id,
                    'cpl_id' => $request->cpl_id,
                    'code' => $cpmk['code'],
                    'description' => $cpmk['description'],
                ]);
    
                // Simpan ke tabel pivot cpl_cpmk
                CplCpmk::create([
                    'course_id' => $request->course_id,
                    'cpl_id' => $request->cpl_id,
                    'cpmk_id' => $newCpmk->id,
                ]);
            }
        });
    
        return redirect()->route('cpmks.index')->with('success', 'CPMK berhasil ditambahkan dan langsung terhubung dengan CPL.');
    }

    public function show(Cpmk $cpmk)
    {
        return view('cpmks.show', compact('cpmk'));
    }

    public function edit(Cpmk $cpmk)
    {
        $courses = Course::all();
        return view('cpmks.edit', compact('cpmk', 'courses'));
    }

    public function update(Request $request, Cpmk $cpmk)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'code' => 'required|max:50',
            'description' => 'required|string',
        ]);

        $cpmk->update($request->all());
        return redirect()->route('cpmks.index')->with('success', 'CPMK berhasil diperbarui!');
    }

    public function destroy(Cpmk $cpmk)
    {
        $cpmk->delete();
        return redirect()->route('cpmks.index')->with('success', 'CPMK berhasil dihapus!');
    }

    public function getMaterials($id)
{
    $materials = Material::where('cpmk_id', $id)->get();
    return response()->json($materials);
}

}
