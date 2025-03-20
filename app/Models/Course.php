<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = 'courses';

    protected $fillable = [
        'study_program_id',
        'user_id',
        'code',
        'name',
        'cluster',
        'sks',
        'semester',
        'tgl_penyusunan',
        'short_description',
        'learning_materials',
    ];

    /**
     * Relasi ke Study Program (Satu mata kuliah hanya memiliki satu program studi).
     */
    public function studyProgram()
    {
        return $this->belongsTo(StudyProgram::class, 'study_program_id');
    }
    public function materials()
    {
        return $this->hasMany(Material::class);
    }

    /**
     * Relasi ke User (Satu mata kuliah dibuat oleh satu dosen).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi ke CPMK (Satu mata kuliah bisa memiliki banyak CPMK).
     */


    public function cpls()
{
    return $this->belongsToMany(Cpl::class, 'course_cpl', 'course_id', 'cpl_id');
}
public function contents()
{
    return $this->hasMany(CourseContent::class);
}
public function cpmks()
{
    return $this->belongsToMany(Cpmk::class, 'cpl_id', 'course_id', 'cpmk_id')
        ->withPivot('cpl_id');
}
public function cpmk()
    {
        return $this->hasMany(Cpmk::class);
    }


public function progress()
{
    return $this->hasMany(MaterialUserProgress::class, 'course_id');
}

public function feedback()
{
    return $this->hasMany(CourseFeedback::class, 'course_id');
}
public function getProgressPercentageAttribute()
{
    $user = auth()->user();

    // Pastikan ada materi dalam kursus ini
    $totalMaterials = $this->cpls->flatMap->cpmks->flatMap->materials->count();

    if ($totalMaterials === 0) {
        return 0;
    }

    // Ambil daftar ID materi dari kursus ini
    $materialIds = $this->cpls->flatMap->cpmks->flatMap->materials->pluck('id');

    // Hitung jumlah materi yang sudah diselesaikan user
    $completedMaterials = MaterialUserProgress::where('user_id', $user->id)
        ->whereIn('material_id', $materialIds)
        ->count();

    // Hitung persentase progress
    return ($completedMaterials / $totalMaterials) * 100;
}

    public function usersInProgress()
    {
        // Ambil semua user yang memiliki progress pada kursus ini
        $userIds = MaterialUserProgress::whereHas('material', function ($query) {
            $query->whereHas('cpmk', function ($query) {
                $query->whereHas('cpl', function ($query) {
                    $query->where('course_id', $this->id);
                });
            });
        })->distinct()->pluck('user_id');

        // Hitung jumlah user yang memiliki progress lebih dari 0% tetapi kurang dari 100%
        $count = 0;
        foreach ($userIds as $userId) {
            $user = User::find($userId);
            $totalMaterials = $this->cpls->flatMap->cpmks->flatMap->materials->count();

            if ($totalMaterials === 0) {
                continue;
            }

            $completedMaterials = MaterialUserProgress::where('user_id', $userId)
                ->whereIn('material_id', $this->cpls->flatMap->cpmks->flatMap->materials->pluck('id'))
                ->count();

            $progress = ($completedMaterials / $totalMaterials) * 100;

            if ($progress > 0 && $progress < 100) {
                $count++;
            }
        }

        return $count;
    }







}
