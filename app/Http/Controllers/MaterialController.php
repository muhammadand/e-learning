<?php
namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\MaterialUserProgress;
use Illuminate\Support\Facades\Auth; 
use App\Models\Course;
use App\Models\Cpmk;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function getMaterials($cpmkId)
    {
        $userId = Auth::id();

        $materials = Material::where('cpmk_id', $cpmkId)
            ->with(['progress' => function ($query) use ($userId) {
                $query->where('user_id', $userId);
            }])
            ->get()
            ->map(function ($material) {
                return [
                    'id' => $material->id,
                    'title' => $material->title,
                    'description' => $material->description,
                    'file_path' => $material->file_path,
                    'is_completed' => $material->progress->is_completed ?? false, // Ambil dari progress user
                ];
            });

        return response()->json($materials);
    }
    public function index()
    {
        $courses = Course::where('user_id', auth()->id()) // Filter berdasarkan user login
            ->with('materials') // Ambil semua materi yang terkait dengan course
            ->get();
    
        return view('materials.index', compact('courses'));
    }
    
    
    

    public function create()
    {
        $courses = Course::all();
        $cpmks = Cpmk::all();
        return view('materials.create', compact('courses', 'cpmks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'file_path' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx',
            'course_id' => 'required|exists:courses,id',
            'cpmk_id' => 'required|exists:cpmks,id',
        ]);
    
        $data = $request->only(['title', 'description', 'course_id', 'cpmk_id']);
    
        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $path = $file->store('materials', 'public');
            $data['file_path'] = $path;
        }
    
        $material = Material::create($data);
        
    
        // Langsung redirect ke view materials.index tanpa lewat route
        return view('materials.index', [
            'materials' => Material::all(),
            'success' => 'Materi berhasil ditambahkan!'
        ]);
    }
    


    public function show(Material $material)
    {
        $material->load(['course.cpmks']); // Pastikan relasi di-load
        return view('materials.show', compact('material'));
    }
    

    public function edit(Material $material)
    {
        $courses = Course::all();
        $cpmks = Cpmk::all();
        return view('materials.edit', compact('material', 'courses', 'cpmks'));
    }

    public function update(Request $request, Material $material)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'file_path' => 'nullable|string',
            'course_id' => 'required|exists:courses,id',
            'cpmk_id' => 'required|exists:cpmks,id',
        ]);

        $material->update($request->all());
        return redirect()->route('materials.index')->with('success', 'Materi berhasil diperbarui!');
    }

    public function destroy(Material $material)
    {
        $material->delete();
        return redirect()->route('materials.index')->with('success', 'Materi berhasil dihapus!');
    }
}
