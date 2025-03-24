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
    
    return view('home.visi');
}
public function courses()
{
    $courses = Course::with(['studyProgram', 'user'])->get();
    return view('home.courses', compact('courses'));
}
public function contact()
{
    
    return view('home.contact');
}
public function misi()
{
    
    return view('home.misi');
}
public function about()
{
    
    return view('home.about');
}


    public function profile()
    {
        // Fungsi untuk menampilkan profil pengguna
        return view('user.profile');
    }
}
