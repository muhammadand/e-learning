<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
   

    protected $table = 'users'; // Nama tabel di database

    protected $fillable = [
        'study_program_id',
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Relasi dengan tabel study_programs (Satu pengguna hanya memiliki satu Program Studi).
     */
    public function studyProgram()
    {
        return $this->belongsTo(StudyProgram::class, 'study_program_id');
    }
    public function faculty()
    {
        return $this->belongsTo(Faculty::class, 'faculty_id');
    }
    public function progress()
    {
        return $this->hasMany(UserProgress::class, 'user_id');
    }
    



}
