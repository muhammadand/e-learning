<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key (bigint)
            $table->foreignId('study_program_id')->nullable()->constrained('study_programs')->nullOnDelete(); // Foreign key ke study_programs
            $table->string('name'); // Nama pengguna
            $table->string('email')->unique(); // Email unik
            $table->string('password'); // Password
            $table->enum('role', ['akademik', 'dosen', 'mahasiswa']); // Peran pengguna
            $table->timestamps(); // created_at & updated_at otomatis
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
