<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('study_programs', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key (bigint)
            $table->foreignId('faculty_id')->constrained('faculties')->onDelete('cascade'); // Foreign key ke faculties
            $table->string('name')->unique(); // Nama Program Studi, harus unik
            $table->timestamps(); // created_at & updated_at otomatis
        });
    }

    public function down()
    {
        Schema::dropIfExists('study_programs');
    }
};
