<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseCpl extends Model
{
    use HasFactory;

    protected $table = 'course_cpl'; // Nama tabel di database

    protected $fillable = ['course_id', 'cpl_id'];

    /**
     * Relasi ke Course.
     */
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    /**
     * Relasi ke CPL.
     */
    public function cpl()
    {
        return $this->belongsTo(Cpl::class, 'cpl_id');
    }
    public function cpmks()
{
    return $this->hasMany(Cpmk::class, 'course_id'); // Gunakan hasMany jika tidak ingin pivot
}

}
