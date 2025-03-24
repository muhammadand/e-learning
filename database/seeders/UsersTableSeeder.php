<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Kosongkan tabel sebelum mengisi data baru
        Schema::disableForeignKeyConstraints();
        DB::table('users')->truncate();
        Schema::enableForeignKeyConstraints();

        // Data pengguna
        $users = [
            [
                'study_program_id' => 1, // Sesuaikan dengan ID yang ada di tabel study_programs
                'name' => 'Admin Akademik',
                'email' => 'akdemik@gmail.com',
                'password' => Hash::make('Rivian1207'),
                'role' => 'akademik',
            ],
            [
                'study_program_id' => 2,
                'name' => 'Dosen Teknik',
                'email' => 'Andi@gmail.com',
                'password' => Hash::make('Rivian1207'),
                'role' => 'dosen',
            ],
            [
                'study_program_id' => 3,
                'name' => 'Mahasiswa Manajemen',
                'email' => 'rivi@gmail.com',
                'password' => Hash::make('Rivian1207'),
                'role' => 'mahasiswa',
            ],
            [
                'study_program_id' => 3,
                'name' => 'Andi',
                'email' => 'belia@gmail.com',
                'password' => Hash::make('Rivian1207'),
                'role' => 'mahasiswa',
            ],
        ];

        // Insert ke database
        DB::table('users')->insert($users);
    }
}
