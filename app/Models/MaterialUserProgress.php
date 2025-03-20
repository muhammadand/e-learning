<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialUserProgress extends Model
{
    protected $fillable = ['user_id', 'material_id', 'is_completed'];

    protected $attributes = [
        'is_completed' => false, // Default nilai is_completed = false
    ];

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    // Scope untuk hanya mengambil progress yang sudah selesai
    public function scopeCompleted($query)
    {
        return $query->where('is_completed', true);
    }
}
