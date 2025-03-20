<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        // Tabel CPL (Capaian Pembelajaran Lulusan)
        Schema::create('cpls', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // Misal: CPL1, CPL2, dll.
            $table->text('description'); // Deskripsi capaian pembelajaran
            $table->timestamps();
        });

        // Tabel CPMK (Capaian Pembelajaran Mata Kuliah)
        Schema::create('cpmks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade'); // Mata kuliah terkait
            $table->foreignId('cpl_id')->nullable()->constrained('cpls')->onDelete('cascade'); // Tambahkan cpl_id
            $table->string('code')->unique(); // Misal: CPMK1, CPMK2, dll.
            $table->text('description'); // Deskripsi capaian pembelajaran mata kuliah
            $table->timestamps();
        });

        // Tabel Hubungan CPL-CPMK (Many-to-Many)
        Schema::create('cpl_cpmk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade'); 
            $table->foreignId('cpl_id')->constrained('cpls')->onDelete('cascade');
            $table->foreignId('cpmk_id')->constrained('cpmks')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['course_id', 'cpl_id', 'cpmk_id']); // Mencegah duplikasi
        });

        // Tabel Hubungan Course-CPL (Many-to-Many)
        Schema::create('course_cpl', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
            $table->foreignId('cpl_id')->constrained('cpls')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['course_id', 'cpl_id']); // Mencegah duplikasi Course-CPL
        });
    }        

    public function down()
    {
        Schema::dropIfExists('course_cpl');
        Schema::dropIfExists('cpl_cpmk');
        Schema::dropIfExists('cpmks');
        Schema::dropIfExists('cpls');
    }
};
