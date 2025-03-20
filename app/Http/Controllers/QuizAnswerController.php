<?php

namespace App\Http\Controllers;

use App\Models\QuizAnswer;
use App\Models\QuizAttempt;
use App\Models\QuizQuestion;
use Illuminate\Http\Request;

class QuizAnswerController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'attempt_id' => 'required|exists:quiz_attempts,id',
            'question_id' => 'required|exists:quiz_questions,id',
            'selected_option' => 'required|in:A,B,C,D',
        ]);

        $question = QuizQuestion::findOrFail($request->question_id);
        $is_correct = $request->selected_option === $question->correct_option;

        QuizAnswer::create([
            'attempt_id' => $request->attempt_id,
            'question_id' => $request->question_id,
            'selected_option' => $request->selected_option,
            'is_correct' => $is_correct,
        ]);

        return back()->with('success', 'Jawaban berhasil disimpan!');
    }
}
