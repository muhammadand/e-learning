<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Course;

class PemrogramanWebCpmkSeeder extends Seeder
{
    public function run()
    {
        // Cari course dengan nama "Pemrograman Web"
        $course = Course::where('name', 'Pemrograman Web')->first();

        if (!$course) {
            echo "Mata Kuliah 'Pemrograman Web' tidak ditemukan.\n";
            return;
        }

        // Data CPMK untuk Pemrograman Web (Semua memakai CPL 1)
        $cpmks = [
            ['code' => 'CPMK1', 'description' => 'Memahami konsep dasar pemrograman web dan struktur HTML.'],
            ['code' => 'CPMK2', 'description' => 'Menggunakan CSS untuk mendesain tampilan halaman web.'],
            ['code' => 'CPMK3', 'description' => 'Membuat halaman web interaktif dengan JavaScript.'],
            ['code' => 'CPMK4', 'description' => 'Mengelola data dengan PHP dan MySQL.'],
            ['code' => 'CPMK5', 'description' => 'Mengembangkan aplikasi web dengan framework Laravel.']
        ];

        // Insert CPMK ke dalam tabel
        foreach ($cpmks as $cpmk) {
            DB::table('cpmks')->updateOrInsert([
                'course_id' => $course->id,
                'code'      => $cpmk['code'],
            ], [
                'description' => $cpmk['description'],
                'cpl_id'      => 1, // Semua CPMK menggunakan CPL 1
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }

        echo "Seeder berhasil dijalankan untuk CPMK Pemrograman Web dengan CPL 1\n";
    }
}
