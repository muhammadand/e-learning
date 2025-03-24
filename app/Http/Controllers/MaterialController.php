<?php
namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\UserProgress;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\SubCpmk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{
    public function markAsDone($id)
    {
        $userId = Auth::id(); 
    
        // Ambil sub_cpmk_id dari tabel material
        $material = Material::findOrFail($id);
        $subCpmkId = $material->sub_cpmk_id; // Pastikan kolom ini ada di tabel materials
    
        // Cek apakah sudah pernah diselesaikan
        $progress = UserProgress::where('user_id', $userId)
            ->where('material_id', $id)
            ->first();
    
        if (!$progress) {
            UserProgress::create([
                'user_id' => $userId,
                'sub_cpmk_id' => $subCpmkId, // Tambahkan ini
                'material_id' => $id,
                'is_material_done' => true
            ]);
        } else {
            $progress->update(['is_material_done' => true]);
        }
    
        return redirect()->back()->with('success', 'Materi berhasil diselesaikan!');
    }
    
    public function getMaterials($subCpmkId)
    {
        $userId = Auth::id();

        $materials = Material::where('sub_cpmk_id', $subCpmkId)
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
        $subCpmks = SubCpmk::with('cpmk.course')->get(); // Pastikan memuat relasi
    
        return view('materials.create', compact('courses', 'subCpmks'));
    }
    


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable|string',
            'file_path' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx|max:2048',
            'course_id' => 'required|exists:courses,id',
            'sub_cpmk_id' => 'required|exists:sub_cpmks,id',
        ]);

        $data = $request->only(['title', 'description', 'course_id', 'sub_cpmk_id']);

        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $path = $file->store('materials', 'public');
            $data['file_path'] = $path;
        }

        Material::create($data);

        return redirect()->route('materials.index')->with('success', 'Materi berhasil ditambahkan!');
    }

    
    public function detail($id)
    {
        $material = Material::findOrFail($id);
        $userId = Auth::id();
    
        // Cek apakah user sudah menyelesaikan materi ini
        $isDone = UserProgress::where('user_id', $userId)
            ->where('material_id', $id)
            ->exists(); // Mengembalikan true/false
    
        return view('materials.detail', compact('material', 'isDone'));
    }

    public function edit(Material $material)
    {
        $courses = Course::all();
        $subCpmks = SubCpmk::all();
        return view('materials.edit', compact('material', 'courses', 'subCpmks'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file_path' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx|max:2048',
            'course_id' => 'required|exists:courses,id',
            'sub_cpmk_id' => 'nullable|exists:sub_cpmks,id',
        ]);

        $material = Material::findOrFail($id);

        if ($request->hasFile('file_path')) {
            if ($material->file_path) {
                Storage::disk('public')->delete($material->file_path);
            }
            $filePath = $request->file('file_path')->store('materials', 'public');
        } else {
            $filePath = $material->file_path;
        }

        $material->update([
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $filePath,
            'course_id' => $request->course_id,
            'sub_cpmk_id' => $request->sub_cpmk_id,
        ]);

        return redirect()->route('materials.index')->with('success', 'Materi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $material = Material::findOrFail($id);
        if ($material->file_path) {
            Storage::disk('public')->delete($material->file_path);
        }
        $material->delete();

        return redirect()->route('materials.index')->with('success', 'Materi berhasil dihapus.');
    }
}
