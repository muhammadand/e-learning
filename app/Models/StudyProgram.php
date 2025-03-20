<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyProgram extends Model
{
    use HasFactory;

    protected $table = 'study_programs'; // Nama tabel di database

    protected $fillable = ['faculty_id', 'name']; // Kolom yang bisa diisi secara massal

    /**
     * Relasi dengan tabel faculties (Satu Program Studi hanya memiliki satu Fakultas).
     */
    public function faculty()
    {
        return $this->belongsTo(Faculty::class, 'faculty_id');
    }
}
