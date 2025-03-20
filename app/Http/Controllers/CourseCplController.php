<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Cpl;
use Illuminate\Http\Request;

class CourseCplController extends Controller
{
    public function index()
    {
        $courses = Course::with(['cpls.cpmks'])->get();
        return view('course_cpl.index', compact('courses'));
    }
    
    

    public function create()
{
    $user = auth()->user();
    $courses = Course::where('user_id', $user->id)->get(); // Hanya course milik user yang login
    $cpls = Cpl::all(); // Ambil semua CPL

    return view('course_cpl.create', compact('courses', 'cpls'));
}


    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'cpl_ids' => 'required|array',
            'cpl_ids.*' => 'exists:cpls,id',
        ]);

        $course = Course::findOrFail($request->course_id);
        $course->cpls()->sync($request->cpl_ids);

        return redirect()->route('course_cpl.index')->with('success', 'Relasi Course-CPL berhasil diperbarui!');
    }
}
