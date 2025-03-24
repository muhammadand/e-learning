<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Course;
use App\Models\Cpl;

class SingleCourseCplSeeder extends Seeder
{
    public function run()
    {
        // Ambil course dengan ID 1
        $course = Course::find(1);

        if (!$course) {
            echo "Course dengan ID 1 tidak ditemukan.\n";
            return;
        }

        // Ambil minimal 7 CPL secara acak
        $cpls = Cpl::inRandomOrder()->limit(7)->pluck('id');

        foreach ($cpls as $cplId) {
            DB::table('course_cpl')->updateOrInsert([
                'course_id' => $course->id,
                'cpl_id' => $cplId,
            ], [
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        echo "Seeder berhasil dijalankan untuk Course ID 1: {$course->name}\n";
    }
}
