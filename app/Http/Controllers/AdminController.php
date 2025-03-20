<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\MaterialUserProgress;


class AdminController extends Controller
{

    
    public function index()
    {
        
    
        return view('admin.index');
    }
    
    public function dashboard()
    {
        $user = auth()->user();
        $courses = Course::with('cpmk.materials')->get();
    
        $totalCourses = $courses->count();
        $inProgressCourses = 0;
        $completedCourses = 0;
    
        foreach ($courses as $course) {
            $courseId = $course->id;
    
            // Ambil progres dari session (jika ada), kalau tidak ada set ke 0
            $progress = session()->get("progress_course_{$courseId}", 0);
    
            // Simpan progres di atribut course
            $course->setAttribute('progress', $progress);
    
            // Hitung jumlah kursus dalam progres dan yang sudah selesai
            if ($progress > 0 && $progress < 100) {
                $inProgressCourses++;
            } elseif ($progress == 100) {
                $completedCourses++;
            }
        }
    
        return view('dashboard', compact('courses', 'totalCourses', 'inProgressCourses', 'completedCourses'));
    }
    
    

    
}
