<?php

namespace App\Http\Controllers;
use App\Models\Course;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
   
//     public function index()
// {
//     $courses = Course::with(['user', 'progress'])->get(); // Ambil course + dosen + progress

//     return view('home', compact('courses'));
// }
public function index()
{
    $courses = Course::with(['studyProgram', 'user'])->get();
    return view('home', compact('courses'));
}


    public function profile()
    {
        // Fungsi untuk menampilkan profil pengguna
        return view('user.profile');
    }
}
