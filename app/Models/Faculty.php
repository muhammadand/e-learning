<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;

    protected $table = 'faculties'; // Nama tabel di database

    protected $fillable = ['name']; // Kolom yang bisa diisi secara massal

    /**
     * Relasi dengan tabel study_programs (Satu Fakultas memiliki banyak Program Studi).
     */
    public function studyPrograms()
    {
        return $this->hasMany(StudyProgram::class, 'faculty_id');
    }
}
