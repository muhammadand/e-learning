<?php

namespace App\Http\Controllers;

use App\Models\QuizAttempt;
use App\Models\Quiz;
use App\Models\QuizAnswer;
use App\Models\QuizQuestion;
use App\Models\UserProgress;
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
            return redirect()->route('quizzes.index', ['sub_cpmk_id' => $quiz->sub_cpmk_id])
                ->with('warning', 'Anda sudah mengerjakan kuis ini.');
        }

        return view('attempts.start', compact('quiz'));
    }

    public function mulai($quiz_id)
    {
        $quiz = Quiz::with('subCpmk.cpmk.cpl')->findOrFail($quiz_id);
        
        // Simpan course_id di session untuk digunakan setelah kuis selesai
        session(['course_id' => $quiz->subCpmk->cpmk->cpl->course_id]);
    
        // Cek apakah user sudah mencoba kuis ini
        $existingAttempt = QuizAttempt::where('user_id', Auth::id())
            ->where('quiz_id', $quiz_id)
            ->latest()
            ->first();
    
        if ($existingAttempt && $existingAttempt->score >= 80) {
            return redirect()->route('courses.show', session('course_id'))
                ->with('warning', 'Anda sudah menyelesaikan kuis ini dengan skor yang cukup.');
        }
    
        return view('attempts.start', compact('quiz'))->with(
            'info',
            $existingAttempt ? 'Skor sebelumnya kurang dari 80. Anda bisa mencoba lagi.' : ''
        );
    }
    

    // Simpan hasil kuis
    public function store(Request $request)
    {
        $request->validate([
            'quiz_id' => 'required|exists:quizzes,id',
            'answers' => 'required|array',
            'answers.*' => 'in:A,B,C,D',
        ]);
    
        $user_id = Auth::id();
        $quiz_id = $request->quiz_id;
        $answers = $request->answers;
    
        // Ambil data kuis dan relasi
        $quiz = Quiz::with('subCpmk.cpmk.cpl')->findOrFail($quiz_id);
        $sub_cpmk_id = $quiz->sub_cpmk_id ?? null; // Pastikan sub_cpmk_id tidak null
        $courseId = $quiz->subCpmk->cpmk->cpl->course_id ?? null;
    
        DB::transaction(function () use ($user_id, $quiz_id, $answers, $sub_cpmk_id) {
            $attempt = QuizAttempt::create([
                'user_id' => $user_id,
                'quiz_id' => $quiz_id,
            ]);
    
            $correctCount = 0;
            $totalQuestions = count($answers);
    
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
    
            $score = ($correctCount / $totalQuestions) * 100;
            $attempt->update(['score' => $score]);
    
            // Jika skor mencapai batas (contoh: 80), update user_progress
            if ($score >= 80) {
                UserProgress::updateOrCreate(
                    [
                        'user_id' => $user_id,
                        'quiz_id' => $quiz_id,
                    ],
                    [
                        'sub_cpmk_id' => $sub_cpmk_id, // Tambahkan sub_cpmk_id
                        'is_quiz_done' => true
                    ]
                );
            }
    
            session(['quiz_completed' => true]);
        });
    
        return redirect()->route('quiz.completed')->with('courseId', $courseId);
    }
    

    public function quizCompleted()
    {
        // Ambil course_id dari session atau dari flash message redirect
        $courseId = session('course_id') ?? session()->get('courseId');

        // Hapus session quiz_completed
        session()->forget('quiz_completed');

        return view('quizzes.completed', compact('courseId'));
    }
}
