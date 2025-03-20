<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key (bigint)
            $table->foreignId('study_program_id')->constrained('study_programs')->onDelete('cascade'); // Foreign key ke study_programs
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Foreign key ke users (dosen)
            $table->string('code', 50)->unique(); // Kode mata kuliah unik
            $table->string('name'); // Nama mata kuliah
            $table->string('cluster')->nullable(); // Rumpun MK (bisa null)
            $table->integer('sks'); // Jumlah SKS
            $table->integer('semester'); // Semester
            $table->date('tgl_penyusunan'); // Tanggal penyusunan
            $table->text('short_description')->nullable(); // Deskripsi singkat MK
            $table->text('learning_materials')->nullable(); // Bahan kajian/materi pembelajaran
            $table->timestamps(); // created_at & updated_at otomatis
        });
    }

    public function down()
    {
        Schema::dropIfExists('courses');
    }
};
