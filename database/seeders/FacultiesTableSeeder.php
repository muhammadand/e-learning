<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class FacultiesTableSeeder extends Seeder
{
    public function run()
    {
        // Kosongkan tabel sebelum mengisi data baru
        Schema::disableForeignKeyConstraints();
        DB::table('faculties')->truncate();
        Schema::enableForeignKeyConstraints();

        // Data fakultas
        $faculties = [
            ['name' => 'Fakultas Teknik'],
            ['name' => 'Fakultas Ekonomi'],
            ['name' => 'Fakultas Hukum'],
            ['name' => 'Fakultas Ilmu Sosial dan Politik'],
            ['name' => 'Fakultas Kedokteran'],
            ['name' => 'Fakultas MIPA'],
        ];

        // Insert ke database
        DB::table('faculties')->insert($faculties);
    }
}
