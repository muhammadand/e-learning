<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cpl;

class CplSeeder extends Seeder
{
    public function run()
    {
        $cpls = [
            ['code' => 'CPL-1', 'description' => 'Memahami konsep dasar pemrograman'],
            ['code' => 'CPL-2', 'description' => 'Menguasai algoritma dan struktur data'],
            ['code' => 'CPL-3', 'description' => 'Mampu merancang basis data relasional'],
            ['code' => 'CPL-4', 'description' => 'Memahami konsep pemrograman berorientasi objek'],
            ['code' => 'CPL-5', 'description' => 'Mengembangkan aplikasi berbasis web'],
            ['code' => 'CPL-6', 'description' => 'Menguasai framework modern untuk pengembangan aplikasi'],
            ['code' => 'CPL-7', 'description' => 'Mampu bekerja dalam tim menggunakan metode Agile'],
            ['code' => 'CPL-8', 'description' => 'Memahami keamanan sistem informasi'],
            ['code' => 'CPL-9', 'description' => 'Menganalisis dan mengoptimalkan performa sistem'],
            ['code' => 'CPL-10', 'description' => 'Mampu melakukan riset teknologi baru dalam bidang IT'],
            ['code' => 'CPL-11', 'description' => 'Menguasai konsep kecerdasan buatan'],
            ['code' => 'CPL-12', 'description' => 'Memahami Internet of Things (IoT) dan implementasinya'],
            ['code' => 'CPL-13', 'description' => 'Mengembangkan aplikasi mobile yang efisien'],
            ['code' => 'CPL-14', 'description' => 'Menguasai teknik pengujian perangkat lunak'],
        ];

        foreach ($cpls as $cpl) {
            Cpl::create($cpl);
        }
    }
}
