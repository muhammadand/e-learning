<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;

    protected $table = 'progress';

    protected $fillable = [
        'user_id',
        'cpmk_id',
        'material_id',
        'status',
        'completed_at',
    ];

    protected $casts = [
        'completed_at' => 'datetime',
    ];

    /**
     * Relasi ke User (Mahasiswa yang mengerjakan).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke CPMK (Kompetensi yang dipelajari).
     */
    public function cpmk()
    {
        return $this->belongsTo(Cpmk::class);
    }

    /**
     * Relasi ke Material (Materi yang dikerjakan).
     */
    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}

