<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Tabel quizzes (Informasi kuis untuk setiap sub CPMK)
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_cpmk_id')->constrained('sub_cpmks')->onDelete('cascade'); // Relasi ke sub CPMK
            $table->string('title'); // Judul kuis
            $table->text('description')->nullable(); // Deskripsi kuis (opsional)
            $table->timestamps();
        });

        // Tabel quiz_questions (Pertanyaan dalam kuis)
        Schema::create('quiz_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_id')->constrained('quizzes')->onDelete('cascade'); // Relasi ke quizzes
            $table->text('question_text'); // Teks pertanyaan
            $table->string('option_a'); // Pilihan A
            $table->string('option_b'); // Pilihan B
            $table->string('option_c'); // Pilihan C
            $table->string('option_d'); // Pilihan D
            $table->char('correct_option', 1); // Jawaban benar (A, B, C, D)
            $table->timestamps();
        });

        // Tabel quiz_attempts (Hasil kuis mahasiswa)
        Schema::create('quiz_attempts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Mahasiswa
            $table->foreignId('quiz_id')->constrained('quizzes')->onDelete('cascade'); // Kuis yang dikerjakan
            $table->integer('score')->nullable(); // Menambahkan kolom score
            $table->timestamps();
        });

        // Tabel quiz_answers (Jawaban mahasiswa per pertanyaan)
        Schema::create('quiz_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attempt_id')->constrained('quiz_attempts')->onDelete('cascade'); // Relasi ke quiz_attempts
            $table->foreignId('question_id')->constrained('quiz_questions')->onDelete('cascade'); // Relasi ke quiz_questions
            $table->char('selected_option', 1); // Jawaban yang dipilih
            $table->boolean('is_correct'); // Apakah jawaban benar?
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quiz_answers');
        Schema::dropIfExists('quiz_attempts');
        Schema::dropIfExists('quiz_questions');
        Schema::dropIfExists('quizzes');
    }
};
