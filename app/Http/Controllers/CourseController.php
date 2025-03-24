<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Gate;
use App\Models\Course;
use App\Models\MaterialUserProgress;
use App\Models\StudyProgram;
use App\Models\User;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\UserProgress;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    
    public function show(Course $course)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk mengakses kursus ini.');
        }
    
        $user = auth()->user();
    
        // Load semua data yang diperlukan
        $course->load('cpls.cpmks.subCpmks.materials', 'cpls.cpmks.subCpmks.quizzes');
    
        // Ambil hanya CPMK yang benar-benar milik Course ini
        $filteredCpmks = $course->cpls->flatMap->cpmks->where('course_id', $course->id);
    
        // Ambil hanya SubCPMK yang berasal dari CPMK milik Course ini
        $uniqueSubCpmks = $filteredCpmks->flatMap->subCpmks->unique('id');
    
        // Hitung total materi dan kuis
        $totalMaterials = $uniqueSubCpmks->flatMap->materials->count();
        $totalQuizzes = $uniqueSubCpmks->flatMap->quizzes->count();
        $totalItems = $totalMaterials + $totalQuizzes;
    
        // Hitung materi yang telah selesai oleh user
        $completedMaterials = UserProgress::where('user_id', $user->id)
            ->whereIn('material_id', $uniqueSubCpmks->flatMap->materials->pluck('id'))
            ->where('is_material_done', true)
            ->count();
    
        // Hitung kuis yang telah selesai oleh user
        $completedQuizzes = UserProgress::where('user_id', $user->id)
            ->whereIn('quiz_id', $uniqueSubCpmks->flatMap->quizzes->pluck('id'))
            ->where('is_quiz_done', true)
            ->count();
    
        $completedItems = $completedMaterials + $completedQuizzes;
    
        // Hitung progres dalam persen
        $progress = $totalItems > 0 ? ($completedItems / $totalItems) * 100 : 0;
    
        return view('courses.show', compact('course', 'progress', 'uniqueSubCpmks'));
    }
    
    

    
public function getQuizzes($subCpmkId)
{
    $quizzes = Quiz::where('sub_cpmk_id', $subCpmkId)->get();
    
    return response()->json($quizzes);
}


    
   
public function index()
{
    $user = auth()->user();
    $courses = Course::with('cpls.cpmks.subCpmks.materials')->get();

    foreach ($courses as $course) {
        // Menghitung total materials berdasarkan subCpmks
        $totalMaterials = $course->cpls->flatMap->cpmks->flatMap->subCpmks->flatMap->materials->count();

        if ($totalMaterials === 0) {
            $course->setAttribute('progress', 0);
        } else {
            // Mengambil semua material_id dari subCpmks yang berelasi
            $materialIds = $course->cpls->flatMap->cpmks->flatMap->subCpmks->flatMap->materials->pluck('id');

            // Menghitung jumlah materials yang sudah diselesaikan oleh user
            $completedMaterials = MaterialUserProgress::where('user_id', $user->id)
                ->whereIn('material_id', $materialIds)
                ->count();

            // Menghitung persentase progress
            $progress = ($completedMaterials / $totalMaterials) * 100;
            $course->setAttribute('progress', $progress);
        }
    }

    return view('courses.index', compact('courses'));
}



public function enrol()
{
    $user = auth()->user();

    // Ambil semua courses dengan relasi yang dibutuhkan
    $courses = Course::with('cpls.cpmks.subCpmks.materials', 'cpls.cpmks.subCpmks.quizzes')->get();

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

        // Tambahkan atribut progres ke course
        $course->setAttribute('progress', round($progress, 2));
    }

    return view('courses.enrol', compact('courses'));
}



public function report($id)
{
    $course = Course::with('cpls.cpmks.subCpmks.materials', 'cpls.cpmks.subCpmks.quizzes')
        ->findOrFail($id);

    // Ambil semua materi dalam course
    $materials = $course->cpls->flatMap->cpmks->flatMap->subCpmks->flatMap->materials;
    $totalMaterials = $materials->count();

    // Ambil semua quiz dalam course
    $quizzes = $course->cpls->flatMap->cpmks->flatMap->subCpmks->flatMap->quizzes;
    $totalQuizzes = $quizzes->count();
    $quizIds = $quizzes->pluck('id');

    // Ambil semua user yang memiliki progress dalam course ini
    $userIds = UserProgress::whereIn('material_id', $materials->pluck('id'))
        ->orWhereIn('quiz_id', $quizIds)
        ->pluck('user_id')
        ->unique();

    $users = User::whereIn('id', $userIds)->get();

    $inProgressUsers = 0;
    $completedUsers = 0;
    $userData = [];

    foreach ($users as $user) {
        // Hitung jumlah materi yang sudah selesai oleh user
        $completedMaterials = UserProgress::where('user_id', $user->id)
            ->whereIn('material_id', $materials->pluck('id'))
            ->where('is_material_done', true)
            ->count();

        // Hitung jumlah quiz yang sudah selesai oleh user dan ambil nilai tertinggi
        $userQuizScores = [];
        $completedQuizzes = 0;
        $totalScore = 0;
        $quizCount = 0;

        foreach ($quizIds as $quizId) {
            $quizProgress = UserProgress::where('user_id', $user->id)
                ->where('quiz_id', $quizId)
                ->first();

            if ($quizProgress && $quizProgress->is_quiz_done) {
                $completedQuizzes++;

                // Ambil nilai tertinggi dari percobaan user
                $highestScore = $quizProgress->quiz->attempts
                    ->where('user_id', $user->id)
                    ->max('score') ?? 0;

                $userQuizScores[$quizId] = $highestScore;
                $totalScore += $highestScore;
                $quizCount++;
            } else {
                $userQuizScores[$quizId] = '-';
            }
        }

        // Hitung rata-rata nilai kuis user
        $averageQuizScore = $quizCount > 0 ? round($totalScore / $quizCount, 2) : '-';

        // Cek apakah user sudah menyelesaikan semua quiz
        if ($completedQuizzes === $totalQuizzes) {
            $completedUsers++;
        } else {
            $inProgressUsers++;
        }

        // Simpan data lengkap user
        $userData[] = [
            'name' => $user->name,
            'completed_materials' => $completedMaterials,
            'quiz_scores' => $userQuizScores,
            'average_score' => $averageQuizScore,
        ];
    }

    return view('courses.report', compact(
        'course',
        'users',
        'inProgressUsers',
        'completedUsers',
        'totalMaterials',
        'totalQuizzes',
        'userData'
    ));
}










    
    

    



    

    public function create()
    {
        if (!Gate::allows('manage-course')) {
            abort(403, 'Anda tidak memiliki akses.');
        }
        $studyPrograms = StudyProgram::all();
        $users = User::where('role', 'dosen')->get();
        return view('courses.create', compact('studyPrograms', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'study_program_id' => 'required|exists:study_programs,id',
            'user_id' => 'required|exists:users,id',
            'code' => 'required|unique:courses,code|max:50',
            'name' => 'required|max:255',
            'cluster' => 'nullable|string',
            'sks' => 'required|integer',
            'semester' => 'required|integer',
            'tgl_penyusunan' => 'required|date',
            'short_description' => 'nullable|string',
            'learning_materials' => 'nullable|string',
        ]);

        Course::create($request->all());
        return redirect()->route('course_cpl.create')->with('success', 'Mata Kuliah berhasil ditambahkan!');
    }

  
    

    public function edit($id)
    {
        $course = Course::findOrFail($id);
        $studyPrograms = StudyProgram::all();
        $users = User::where('role', 'dosen')->get(); // Filter hanya dosen
    
        return view('courses.edit', compact('course', 'studyPrograms', 'users'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'study_program_id' => 'required|exists:study_programs,id',
            'user_id' => 'required|exists:users,id',
            'code' => 'required|string|max:10',
            'name' => 'required|string|max:255',
            'sks' => 'required|integer|min:1',
            'semester' => 'required|integer|min:1|max:8',
            'tgl_penyusunan' => 'required|date',
            'short_description' => 'nullable|string',
            'learning_materials' => 'nullable|string',
        ]);
    
        $course = Course::findOrFail($id);
        $course->update($request->all());
    
        return redirect()->route('courses.index')->with('success', 'Mata kuliah berhasil diperbarui.');
    }
    

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Mata Kuliah berhasil dihapus!');
    }
}
