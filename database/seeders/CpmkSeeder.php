<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CpmkSeeder extends Seeder
{
    public function run()
    {
        DB::table('cpmks')->insert([
            ['course_id' => 1, 'cpl_id' => 1, 'code' => 'CPMK1', 'description' => 'Mahasiswa mampu memahami konsep dasar pemrograman.'],
            ['course_id' => 1, 'cpl_id' => 2, 'code' => 'CPMK2', 'description' => 'Mahasiswa mampu menerapkan algoritma dalam pemrograman.'],
            ['course_id' => 2, 'cpl_id' => 3, 'code' => 'CPMK3', 'description' => 'Mahasiswa mampu mengembangkan aplikasi berbasis web.'],
        ]);
    }
}
