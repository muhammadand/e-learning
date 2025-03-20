<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Progress;
use App\Models\MaterialUserProgress;
use Illuminate\Support\Facades\Auth;

class ProgressController extends Controller
{
    public function complete($materialId)
    {
        $user = Auth::user();

        // Cek apakah sudah ada progress sebelumnya
        $progress = MaterialUserProgress::firstOrCreate(
            ['user_id' => $user->id, 'material_id' => $materialId],
            ['is_completed' => true]
        );

        if (!$progress->wasRecentlyCreated) {
            $progress->update(['is_completed' => true]);
        }

        return response()->json(['success' => true]);
    }

    public function getProgress($courseId)
    {
        $user = Auth::id();
        $totalMaterials = \App\Models\Material::where('course_id', $courseId)->count();
        $completedMaterials = MaterialUserProgress::whereHas('material', function ($query) use ($courseId) {
            $query->where('course_id', $courseId);
        })->where('user_id', $user)->where('is_completed', true)->count();
    
        $percentage = $totalMaterials > 0 ? ($completedMaterials / $totalMaterials) * 100 : 0;
    
        // Ambil daftar materi yang sudah selesai
        $completedMaterialsIds = MaterialUserProgress::where('user_id', $user)
            ->where('is_completed', true)
            ->pluck('material_id');
    
        return response()->json([
            'percentage' => round($percentage),
            'completedMaterials' => $completedMaterialsIds
        ]);
    }

    
    
}
