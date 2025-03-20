<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cpmk extends Model
{
    use HasFactory;

    protected $table = 'cpmks';

    protected $fillable = [
        'course_id',
        'cpl_id', // Tambahkan cpl_id agar bisa disimpan
        'code',
        'description',
    ];

    /**
     * Relasi ke Mata Kuliah (Satu CPMK hanya memiliki satu mata kuliah).
     */
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    /**
     * Relasi ke CPL (Satu CPMK hanya memiliki satu CPL).
     */
    public function cpl()
    {
        return $this->belongsTo(Cpl::class, 'cpl_id');
    }
    public function quizzes()
    {
        return $this->hasMany(Quiz::class, 'cpmk_id');
    }

    /**
     * Relasi ke Material (Satu CPMK bisa memiliki banyak Material).
     */
    public function materials()
    {
        return $this->hasMany(Material::class);
    }
}
