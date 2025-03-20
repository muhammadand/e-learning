<?php
namespace App\Models;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $fillable = ['course_id', 'cpmk_id', 'title', 'description', 'file_path'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function cpmk()
    {
        return $this->belongsTo(Cpmk::class);
    }

    public function progress()
    {
        return $this->hasOne(MaterialUserProgress::class, 'material_id')
            ->where('user_id', Auth::id()); // Ambil progress user yang sedang login
    }

// Cek apakah materi sudah selesai
public function getIsCompletedAttribute()
{
    return $this->progress ? true : false;
}
public function materialUserProgress()
{
    return $this->hasMany(MaterialUserProgress::class);
}
}
