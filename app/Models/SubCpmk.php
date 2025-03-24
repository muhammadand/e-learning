<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCpmk extends Model
{
    use HasFactory;

    protected $table = 'sub_cpmks';

    protected $fillable = [
        'cpmk_id',
        'code',
        'description',
    ];

    /**
     * Relasi ke CPMK (Satu Sub CPMK hanya memiliki satu CPMK).
     */
    public function cpmk()
    {
        return $this->belongsTo(Cpmk::class, 'cpmk_id');
    }
    public function materials()
{
    return $this->hasMany(Material::class);
}
  // ✅ Tambahkan relasi ke Quizzes
  public function quizzes()
  {
      return $this->hasMany(Quiz::class, 'sub_cpmk_id');
  }
  public function progress()
{
    return $this->hasMany(UserProgress::class);
}



}
