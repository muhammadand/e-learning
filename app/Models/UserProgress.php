<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProgress extends Model
{
    use HasFactory;

    protected $table = 'user_progress';

    protected $fillable = [
        'user_id',
        'sub_cpmk_id',
        'material_id',
        'quiz_id',
        'is_material_done',
        'is_quiz_done'
    ];

    protected $casts = [
        'is_material_done' => 'boolean',
        'is_quiz_done' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }

    public function subCpmk()
    {
        return $this->belongsTo(SubCpmk::class, 'sub_cpmk_id')->withDefault();
    }

    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id')->withDefault();
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id')->withDefault();
    }
}
