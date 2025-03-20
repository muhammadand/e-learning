<?php

namespace App\Http\Controllers;

use App\Models\QuizAttempt;
use App\Models\Quiz;
use App\Models\QuizAnswer;
use App\Models\QuizQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuizAttemptController extends Controller
{
    // Mulai kuis
    public function start($quiz_id)
    {
        $quiz = Quiz::with('questions')->findOrFail($quiz_id);

        // Cek apakah user sudah mencoba kuis ini
        $existingAttempt = QuizAttempt::where('user_id', Auth::id())
            ->where('quiz_id', $quiz_id)
            ->first();

        if ($existingAttempt) {
            return redirect()->route('quizzes.index')->with('warning', 'Anda sudah mengerjakan kuis ini.');
        }

        return view('attempts.start', compact('quiz'));
    }

    // Simpan hasil kuis
   // Simpan hasil kuis
   public function store(Request $request)
   {
       $request->validate([
           'quiz_id' => 'required|exists:quizzes,id',
           'answers' => 'required|array',
           'answers.*' => 'in:A,B,C,D', // Jawaban harus A, B, C, atau D
       ]);

       $user_id = Auth::id();
       $quiz_id = $request->quiz_id;
       $answers = $request->answers;

       DB::transaction(function () use ($user_id, $quiz_id, $answers) {
           // Simpan attempt kuis
           $attempt = QuizAttempt::create([
               'user_id' => $user_id,
               'quiz_id' => $quiz_id,
           ]);

           $correctCount = 0;
           $totalQuestions = count($answers);

           // Simpan jawaban setiap pertanyaan
           foreach ($answers as $question_id => $selected_option) {
               $question = QuizQuestion::findOrFail($question_id);
               $is_correct = $question->correct_option === $selected_option;

               if ($is_correct) {
                   $correctCount++;
               }

               QuizAnswer::create([
                   'attempt_id' => $attempt->id,
                   'question_id' => $question_id,
                   'selected_option' => $selected_option,
                   'is_correct' => $is_correct,
               ]);
           }

           // Hitung skor (misal: jumlah benar / total pertanyaan * 100)
           $score = ($correctCount / $totalQuestions) * 100;

           // Update skor pada attempt
           $attempt->update(['score' => $score]);
       });

       return redirect()->route('quiz.completed');

   
   }
}
