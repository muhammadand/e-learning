<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\UserProgress;


class AdminController extends Controller
{

    
    public function index()
    {
        
    
        return view('admin.index');
    }
    
    public function dashboard()
    {
        $user = auth()->user();
    
        // Ambil semua courses dengan relasi yang dibutuhkan
        $courses = Course::with('cpls.cpmks.subCpmks.materials', 'cpls.cpmks.subCpmks.quizzes')->get();
    
        $totalCourses = $courses->count();
        $inProgressCourses = 0;
        $completedCourses = 0;
    
        foreach ($courses as $course) {
            // Ambil hanya CPMK yang benar-benar milik Course ini
            $filteredCpmks = $course->cpls->flatMap->cpmks->where('course_id', $course->id);
    
            // Ambil hanya SubCPMK yang berasal dari CPMK milik Course ini
            $uniqueSubCpmks = $filteredCpmks->flatMap->subCpmks->unique('id');
    
            // Hitung total materi dan kuis
            $totalMaterials = $uniqueSubCpmks->flatMap->materials->count();
            $totalQuizzes = $uniqueSubCpmks->flatMap->quizzes->count();
            $totalItems = $totalMaterials + $totalQuizzes;
    
            // Hitung jumlah materi yang telah selesai oleh user
            $completedMaterials = UserProgress::where('user_id', $user->id)
                ->whereIn('material_id', $uniqueSubCpmks->flatMap->materials->pluck('id'))
                ->where('is_material_done', true)
                ->count();
    
            // Hitung jumlah kuis yang telah selesai oleh user
            $completedQuizzes = UserProgress::where('user_id', $user->id)
                ->whereIn('quiz_id', $uniqueSubCpmks->flatMap->quizzes->pluck('id'))
                ->where('is_quiz_done', true)
                ->count();
    
            $completedItems = $completedMaterials + $completedQuizzes;
    
            // Hitung progres dalam persen
            $progress = $totalItems > 0 ? ($completedItems / $totalItems) * 100 : 0;
    
            // Simpan progres di atribut course
            $course->setAttribute('progress', round($progress, 2));
    
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
