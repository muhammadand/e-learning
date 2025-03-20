<?php

namespace App\Http\Controllers;

use App\Models\QuizQuestion;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizQuestionController extends Controller
{
    public function index($quiz_id)
    {
        $quiz = Quiz::findOrFail($quiz_id);
        $questions = QuizQuestion::where('quiz_id', $quiz_id)->get();
        
        return view('questions.index', compact('quiz', 'questions'));
    }

    public function create($quiz_id)
    {
        $quiz = Quiz::findOrFail($quiz_id);
        return view('questions.create', compact('quiz'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'quiz_id' => 'required|exists:quizzes,id',
            'question_text' => 'required|string',
            'option_a' => 'required|string',
            'option_b' => 'required|string',
            'option_c' => 'required|string',
            'option_d' => 'required|string',
            'correct_option' => 'required|in:A,B,C,D',
        ]);

        QuizQuestion::create($request->all());

        return redirect()->route('questions.index', $request->quiz_id)->with('success', 'Pertanyaan berhasil ditambahkan!');
    }
}
