<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    use HasFactory;

    protected $fillable = ['quiz_id', 'question_text', 'option_a', 'option_b', 'option_c', 'option_d', 'correct_option'];

    // Relasi ke kuis
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    // Relasi ke jawaban mahasiswa
    public function answers()
    {
        return $this->hasMany(QuizAnswer::class, 'question_id');
    }
}
