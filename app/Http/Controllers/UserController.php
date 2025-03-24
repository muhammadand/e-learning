<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\StudyProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Menampilkan daftar pengguna (Dosen & Mahasiswa).
     */
    public function index()
    {
        $users = User::with('studyProgram')->where('role', '!=', 'akademik')->get();
        return view('users.index', compact('users'));
    }

    /**
     * Menampilkan form untuk menambah pengguna baru.
     */
    public function create()
    {
        $studyPrograms = StudyProgram::all();
        return view('users.create', compact('studyPrograms'));
    }

    /**
     * Menyimpan pengguna baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'study_program_id' => 'nullable|exists:study_programs,id',
            'name' => 'required|max:255',
            'email' => 'required|unique:users|email|max:255',
            'password' => 'required|min:6',
            'role' => 'required|in:dosen,mahasiswa,akademik,program_studi',
        ]);

        User::create([
            'study_program_id' => $request->study_program_id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail pengguna tertentu.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Menampilkan form edit pengguna.
     */
    public function edit(User $user)
    {
        $studyPrograms = StudyProgram::all();
        return view('users.edit', compact('user', 'studyPrograms'));
    }

    /**
     * Menyimpan perubahan pada pengguna.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'study_program_id' => 'nullable|exists:study_programs,id',
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'role' => 'required|in:dosen,mahasiswa,akademik,program_studi',
        ]);

        $data = [
            'study_program_id' => $request->study_program_id,
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil diperbarui!');
    }

    /**
     * Menghapus pengguna dari database.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Pengguna berhasil dihapus!');
    }
}
