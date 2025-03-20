<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CplCpmk extends Model
{
    use HasFactory;

    protected $table = 'cpl_cpmk'; // Nama tabel di database

    // Tambahkan 'course_id' ke dalam fillable
    protected $fillable = ['course_id', 'cpl_id', 'cpmk_id'];

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

    /**
     * Relasi ke CPMK.
     */
    public function cpmk()
    {
        return $this->belongsTo(Cpmk::class, 'cpmk_id');
    }
}
