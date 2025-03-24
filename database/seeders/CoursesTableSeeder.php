<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CoursesTableSeeder extends Seeder
{
    public function run()
    {
        // Kosongkan tabel sebelum mengisi data baru
        Schema::disableForeignKeyConstraints();
        DB::table('courses')->truncate();
        Schema::enableForeignKeyConstraints();

        // Data kursus/mata kuliah
        $courses = [
            [
                'study_program_id' => 1, // Sesuaikan dengan ID study_program yang ada
                'user_id' => 2, // Sesuaikan dengan ID dosen yang ada
                'code' => 'MK001',
                'name' => 'Pemrograman Web',
                'cluster' => 'Teknologi Informasi',
                'sks' => 3,
                'semester' => 3,
                'tgl_penyusunan' => '2023-08-01',
                'short_description' => 'Mata kuliah ini membahas dasar-dasar pengembangan web.',
                'learning_materials' => 'HTML, CSS, JavaScript, Laravel, Database',
            ],
            [
                'study_program_id' => 2,
                'user_id' => 3,
                'code' => 'MK002',
                'name' => 'Manajemen Keuangan',
                'cluster' => 'Ekonomi dan Bisnis',
                'sks' => 4,
                'semester' => 2,
                'tgl_penyusunan' => '2023-07-15',
                'short_description' => 'Mata kuliah ini membahas tentang dasar-dasar keuangan perusahaan.',
                'learning_materials' => 'Akuntansi Dasar, Laporan Keuangan, Analisis Risiko',
            ],
        ];

        // Insert data ke tabel courses
        DB::table('courses')->insert($courses);
    }
}
