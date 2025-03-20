<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Cpmk;
use App\Models\QuizAttempt;
use App\Models\QuizQuestion;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index($cpmk_id)
{
    $cpmk = Cpmk::findOrFail($cpmk_id);
    $quizzes = Quiz::where('cpmk_id', $cpmk_id)->get();

    return view('quizzes.index', compact('cpmk', 'quizzes'));
}


    public function create($cpmk_id)
    {
        $cpmk = Cpmk::findOrFail($cpmk_id);
        return view('quizzes.create', compact('cpmk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cpmk_id' => 'required|exists:cpmks,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Quiz::create($request->all());

        return redirect()->route('quizzes.index', $request->cpmk_id)->with('success', 'Quiz berhasil dibuat!');
    }

   // Laporan semua kuis
   public function report($quiz_id)
   {
       // Ambil data kuis berdasarkan ID
       $quiz = Quiz::with(['attempts.user'])->findOrFail($quiz_id);
   
       return view('quizzes.report', compact('quiz'));
   }
   

   public function detailReport($attempt_id)
   {
       $attempt = QuizAttempt::with(['user', 'answers.question'])->findOrFail($attempt_id);
       
       return view('quizzes.detail', compact('attempt'));
   }
   public function detail($quiz_id, $user_id)
   {
       // Ambil data kuis
       $quiz = Quiz::findOrFail($quiz_id);
   
       // Ambil semua pertanyaan dari tabel quiz_questions berdasarkan quiz_id
       $questions = QuizQuestion::where('quiz_id', $quiz_id)->get();
   
       // Ambil semua jawaban mahasiswa berdasarkan user_id dan quiz_id
       $attempts = QuizAttempt::where('quiz_id', $quiz_id)
                           ->where('user_id', $user_id)
                           ->with(['answers'])
                           ->get();
   
       return view('quizzes.detail', compact('quiz', 'questions', 'attempts'));
   }
   

   
}
