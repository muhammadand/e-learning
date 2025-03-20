<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('course_contents', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade'); // Relasi ke courses
            $table->string('name'); // Nama Konten
            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('course_contents');
    }
};
