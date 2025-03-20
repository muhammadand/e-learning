<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseFeedback;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class CourseFeedbackController extends Controller
{
    /**
     * Menampilkan daftar feedback untuk suatu course.
     */
    public function index($courseId)
    {
        $course = Course::findOrFail($courseId);
        $feedbacks = CourseFeedback::where('course_id', $courseId)->with('user')->latest()->get();

        return view('feedback.index', compact('course', 'feedbacks'));
    }

    /**
     * Menyimpan feedback dari mahasiswa.
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        CourseFeedback::create([
            'user_id' => Auth::id(),
            'course_id' => $request->course_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Feedback berhasil disimpan.');
    }
}
