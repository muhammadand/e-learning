<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizAnswer extends Model
{
    use HasFactory;

    protected $fillable = ['attempt_id', 'question_id', 'selected_option', 'is_correct'];

    // Relasi ke percobaan kuis mahasiswa
    public function attempt()
    {
        return $this->belongsTo(QuizAttempt::class);
    }

    // Relasi ke pertanyaan kuis
    public function question()
    {
        return $this->belongsTo(QuizQuestion::class, 'question_id');
    }
}
