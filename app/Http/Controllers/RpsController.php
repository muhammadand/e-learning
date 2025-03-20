<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class RpsController extends Controller
{
    public function show(Course $course)
    {
        // Load hanya CPL dan CPMK yang terkait dengan Course tertentu
        $course->load([
            'user.faculty',
            'user.studyProgram','cpls.cpmks']);
    
        return view('admin.rps', compact('course'));
    }

    // public function show(Course $course)
    // {
    //     if (!auth()->check()) {
    //         return redirect()->route('login')->with('error', 'Anda harus login untuk mengakses kursus ini.');
    //     }
    
    //     $course->load('cpls.cpmks.materials', 'cpls.cpmks.quizzes');
    //     $user = auth()->user();
    
    //     // Ambil semua materi yang ada di kursus ini
    //     $totalMaterials = $course->cpls->flatMap->cpmks->flatMap->materials->count();
    
    //     // Hitung progres user berdasarkan jumlah materi yang telah diselesaikan
    //     if ($totalMaterials === 0) {
    //         $progressPercentage = 0;
    //     } else {
    //         $completedMaterials = MaterialUserProgress::where('user_id', $user->id)
    //             ->whereIn('material_id', $course->cpls->flatMap->cpmks->flatMap->materials->pluck('id'))
    //             ->count();
    
    //         $progressPercentage = ($completedMaterials / $totalMaterials) * 100;
    //     }
    
    //     // Update session jika progres berubah
    //     $sessionKey = "progress_course_{$course->id}";
    //     if (session()->get($sessionKey) != round($progressPercentage, 2)) {
    //         session()->put($sessionKey, round($progressPercentage, 2));
    //     }
    
    //     // Hitung jumlah pengguna aktif
    //     $activeUsersCount = MaterialUserProgress::whereIn(
    //         'material_id',
    //         $course->cpls->flatMap->cpmks->flatMap->materials->pluck('id')
    //     )->distinct('user_id')->count('user_id');
    
    //     $quizzes = $course->cpls->flatMap->cpmks->flatMap->quizzes->all();
    
    //     return view('courses.show', compact('course', 'progressPercentage', 'activeUsersCount', 'quizzes'));
    // }
    

    
}

