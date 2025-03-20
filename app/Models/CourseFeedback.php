<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseFeedback extends Model
{
    use HasFactory;

    protected $table = 'course_feedback';

    protected $fillable = [
        'user_id',
        'course_id',
        'rating',
        'comment',
    ];

    /**
     * Relasi ke User (Mahasiswa yang memberikan feedback).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Course (Kursus yang dinilai).
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
