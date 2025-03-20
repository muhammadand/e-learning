<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait FotoProfilTrait
{
    public function getFotoProfil()
    {
        $user = Auth::user();

        if ($user && $user->profil && $user->profil->foto) {
            return asset('storage/' . $user->profil->foto);
        }

        return asset('../assets/images/profile/user-1.jpg'); // Default foto jika tidak ada
    }
}
