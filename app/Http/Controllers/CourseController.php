<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Gate;
use App\Models\Course;
use App\Models\MaterialUserProgress;
use App\Models\StudyProgram;
use App\Models\User;
use App\Models\Quiz;
use App\Models\Progress;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function show(Course $course)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk mengakses kursus ini.');
        }
    
        $course->load('cpls.cpmks.materials', 'cpls.cpmks.quizzes');
        $user = auth()->user();
    
        // Ambil semua materi yang ada di kursus ini
        $totalMaterials = $course->cpls->flatMap->cpmks->flatMap->materials->count();
    
        // Hitung progres user berdasarkan jumlah materi yang telah diselesaikan
        if ($totalMaterials === 0) {
            $progressPercentage = 0;
        } else {
            $completedMaterials = MaterialUserProgress::where('user_id', $user->id)
                ->whereIn('material_id', $course->cpls->flatMap->cpmks->flatMap->materials->pluck('id'))
                ->count();
    
            $progressPercentage = ($completedMaterials / $totalMaterials) * 100;
        }
    
        // Update session jika progres berubah
        $sessionKey = "progress_course_{$course->id}";
        if (session()->get($sessionKey) != round($progressPercentage, 2)) {
            session()->put($sessionKey, round($progressPercentage, 2));
        }
    
        // Hitung jumlah pengguna aktif
        $activeUsersCount = MaterialUserProgress::whereIn(
            'material_id',
            $course->cpls->flatMap->cpmks->flatMap->materials->pluck('id')
        )->distinct('user_id')->count('user_id');
    
        $quizzes = $course->cpls->flatMap->cpmks->flatMap->quizzes->all();
    
        return view('courses.show', compact('course', 'progressPercentage', 'activeUsersCount', 'quizzes'));
    }
    


    
    public function getQuizzes($cpmkId)
{
    $quizzes = Quiz::where('cpmk_id', $cpmkId)->get();
    
    return response()->json($quizzes);
}

    
   
    public function index()
{
    $user = auth()->user();
    $courses = Course::with('cpls.cpmks.materials')->get();

    foreach ($courses as $course) {
        $totalMaterials = $course->cpls->flatMap->cpmks->flatMap->materials->count();
    
        if ($totalMaterials === 0) {
            $course->setAttribute('progress', 0);
        } else {
            $materialIds = $course->cpls->flatMap->cpmks->flatMap->materials->pluck('id');
    
            $completedMaterials = MaterialUserProgress::where('user_id', $user->id)
                ->whereIn('material_id', $materialIds)
                ->count();
    
            $progress = ($completedMaterials / $totalMaterials) * 100;
            $course->setAttribute('progress', $progress);
        }
    }
    

    return view('courses.index', compact('courses'));
}


public function enrol()
{
    $user = auth()->user();
    $courses = Course::with('cpmk.materials')->get();

    foreach ($courses as $course) {
        $courseId = $course->id;

        // Ambil progres dari session (jika ada), kalau tidak ada set ke 0
        $progress = session()->get("progress_course_{$courseId}", 0);

        // Simpan progres di atribut course
        $course->setAttribute('progress', $progress);
    }

    return view('courses.enrol', compact('courses'));
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
        return redirect()->route('courses.index')->with('success', 'Mata Kuliah berhasil ditambahkan!');
    }

  
    

    public function edit(Course $course)
    {
        $studyPrograms = StudyProgram::all();
        $users = User::where('role', 'dosen')->get();
        return view('courses.edit', compact('course', 'studyPrograms', 'users'));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'study_program_id' => 'required|exists:study_programs,id',
            'user_id' => 'required|exists:users,id',
            'code' => 'required|max:50|unique:courses,code,' . $course->id,
            'name' => 'required|max:255',
            'cluster' => 'nullable|string',
            'sks' => 'required|integer',
            'semester' => 'required|integer',
            'tgl_penyusunan' => 'required|date',
            'short_description' => 'nullable|string',
            'learning_materials' => 'nullable|string',
        ]);

        $course->update($request->all());
        return redirect()->route('courses.index')->with('success', 'Mata Kuliah berhasil diperbarui!');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Mata Kuliah berhasil dihapus!');
    }
}
