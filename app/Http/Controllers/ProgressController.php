<?php
namespace App\Http\Controllers;
use App\Models\UserProgress;
use App\Models\SubCpmk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgressController extends Controller
{
    public function markAsDone(Request $request)
    {
        $request->validate([
            'material_id' => 'required|exists:materials,id',
            'sub_cpmk_id' => 'required|exists:sub_cpmks,id',
        ]);

        $userProgress = UserProgress::firstOrCreate([
            'user_id' => Auth::id(),
            'material_id' => $request->material_id,
            'sub_cpmk_id' => $request->sub_cpmk_id,
        ]);

        return response()->json(['success' => true]);
    }
}

