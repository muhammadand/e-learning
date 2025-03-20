<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cpl extends Model
{
    use HasFactory;

    protected $table = 'cpls';

    protected $fillable = [
        'code',
        'description',
    ];

    /**
     * Relasi ke CPMK (Satu CPL bisa memiliki banyak CPMK melalui tabel pivot).
     */
    public function cpmks()
    {
        return $this->belongsToMany(Cpmk::class, 'cpl_cpmk', 'cpl_id', 'cpmk_id');
    }
    public function courses()
{
    return $this->belongsToMany(Course::class, 'course_cpl', 'cpl_id', 'course_id');
}



}
