<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class StudyProgramsTableSeeder extends Seeder
{
    public function run()
    {
        // Kosongkan tabel sebelum mengisi data baru
        Schema::disableForeignKeyConstraints();
        DB::table('study_programs')->truncate();
        Schema::enableForeignKeyConstraints();

        // Data Program Studi (pastikan fakultas sudah ada)
        $studyPrograms = [
            ['faculty_id' => 1, 'name' => 'Teknik Informatika'],
            ['faculty_id' => 1, 'name' => 'Teknik Sipil'],
            ['faculty_id' => 2, 'name' => 'Manajemen'],
            ['faculty_id' => 2, 'name' => 'Akuntansi'],
            ['faculty_id' => 3, 'name' => 'Ilmu Hukum'],
        ];

        // Insert ke database
        DB::table('study_programs')->insert($studyPrograms);
    }
}
