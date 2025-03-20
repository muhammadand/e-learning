<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = ['cpmk_id', 'title', 'description'];

    // Relasi ke CPMK
    public function cpmk()
    {
        return $this->belongsTo(Cpmk::class);
    }

    // Relasi ke pertanyaan kuis
 
    public function questions()
{
    return $this->hasMany(QuizQuestion::class, 'quiz_id');
}


    // Relasi ke percobaan kuis mahasiswa
    public function attempts()
    {
        return $this->hasMany(QuizAttempt::class);
    }

    public function hardestQuestion()
{
    return $this->questions()
        ->withCount(['attempts as wrong_answers' => function ($query) {
            $query->where('is_correct', false);
        }])
        ->orderByDesc('wrong_answers')
        ->first()
        ->question ?? '-';
}

public function easiestQuestion()
{
    return $this->questions()
        ->withCount(['attempts as correct_answers' => function ($query) {
            $query->where('is_correct', true);
        }])
        ->orderByDesc('correct_answers')
        ->first()
        ->question ?? '-';
}

}
