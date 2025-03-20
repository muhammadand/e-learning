<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseContent;
use Illuminate\Http\Request;

class CourseContentController extends Controller
{
    /**
     * Menampilkan daftar konten untuk suatu course.
     */
    public function index($course_id)
    {
        $course = Course::with('contents')->findOrFail($course_id);
        return view('course_contents.index', compact('course'));
    }

    /**
     * Menampilkan form tambah konten.
     */
    public function create($course_id)
    {
        $course = Course::findOrFail($course_id);
        return view('course_contents.create', compact('course'));
    }

    /**
     * Menyimpan konten baru.
     */
    public function store(Request $request, $course_id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        CourseContent::create([
            'course_id' => $course_id,
            'name' => $request->name,
        ]);

        return redirect()->route('course_contents.index', $course_id)->with('success', 'Konten berhasil ditambahkan!');
    }

    /**
     * Menghapus konten.
     */
    public function destroy($id)
    {
        $content = CourseContent::findOrFail($id);
        $course_id = $content->course_id;
        $content->delete();

        return redirect()->route('course_contents.index', $course_id)->with('success', 'Konten berhasil dihapus!');
    }
}
