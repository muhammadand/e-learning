<?php

namespace App\Http\Controllers;

use App\Models\StudyProgram;
use App\Models\Faculty;
use Illuminate\Http\Request;

class StudyProgramController extends Controller
{
    /**
     * Menampilkan daftar program studi.
     */
    public function index()
    {
        $studyPrograms = StudyProgram::with('faculty')->get();
        return view('study_programs.index', compact('studyPrograms'));
    }

    /**
     * Menampilkan form untuk menambah program studi baru.
     */
    public function create()
    {
        $faculties = Faculty::all();
        return view('study_programs.create', compact('faculties'));
    }

    /**
     * Menyimpan program studi baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'faculty_id' => 'required|exists:faculties,id',
            'name' => 'required|unique:study_programs|max:255',
        ]);

        StudyProgram::create([
            'faculty_id' => $request->faculty_id,
            'name' => $request->name,
        ]);

        return redirect()->route('study_programs.index')->with('success', 'Program Studi berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail program studi tertentu.
     */
    public function show(StudyProgram $studyProgram)
    {
        return view('study_programs.show', compact('studyProgram'));
    }

    /**
     * Menampilkan form edit program studi.
     */
    public function edit(StudyProgram $studyProgram)
    {
        $faculties = Faculty::all();
        return view('study_programs.edit', compact('studyProgram', 'faculties'));
    }

    /**
     * Menyimpan perubahan pada program studi.
     */
    public function update(Request $request, StudyProgram $studyProgram)
    {
        $request->validate([
            'faculty_id' => 'required|exists:faculties,id',
            'name' => 'required|unique:study_programs,name,' . $studyProgram->id . '|max:255',
        ]);

        $studyProgram->update([
            'faculty_id' => $request->faculty_id,
            'name' => $request->name,
        ]);

        return redirect()->route('study_programs.index')->with('success', 'Program Studi berhasil diperbarui!');
    }

    /**
     * Menghapus program studi dari database.
     */
    public function destroy(StudyProgram $studyProgram)
    {
        $studyProgram->delete();
        return redirect()->route('study_programs.index')->with('success', 'Program Studi berhasil dihapus!');
    }
}
