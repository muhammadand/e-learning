<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    /**
     * Menampilkan daftar fakultas.
     */
    public function index()
    {
        $faculties = Faculty::all();
        return view('faculties.index', compact('faculties'));
    }

    /**
     * Menampilkan form untuk menambah fakultas baru.
     */
    public function create()
    {
        return view('faculties.create');
    }

    /**
     * Menyimpan fakultas baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:faculties|max:255',
        ]);

        Faculty::create([
            'name' => $request->name,
        ]);

        return redirect()->route('faculties.index')->with('success', 'Fakultas berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail fakultas tertentu.
     */
    public function show(Faculty $faculty)
    {
        return view('faculties.show', compact('faculty'));
    }

    /**
     * Menampilkan form edit fakultas.
     */
    public function edit(Faculty $faculty)
    {
        return view('faculties.edit', compact('faculty'));
    }

    /**
     * Menyimpan perubahan pada fakultas.
     */
    public function update(Request $request, Faculty $faculty)
    {
        $request->validate([
            'name' => 'required|unique:faculties,name,' . $faculty->id . '|max:255',
        ]);

        $faculty->update([
            'name' => $request->name,
        ]);

        return redirect()->route('faculties.index')->with('success', 'Fakultas berhasil diperbarui!');
    }

    /**
     * Menghapus fakultas dari database.
     */
    public function destroy(Faculty $faculty)
    {
        $faculty->delete();
        return redirect()->route('faculties.index')->with('success', 'Fakultas berhasil dihapus!');
    }
}
