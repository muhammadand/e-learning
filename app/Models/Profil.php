<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\FotoProfilTrait;

class Profil extends Model
{
    use HasFactory, FotoProfilTrait;

    protected $table = 'profil';

    protected $fillable = ['user_id', 'alamat', 'tanggal_lahir', 'foto'];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
