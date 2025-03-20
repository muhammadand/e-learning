<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('faculties', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key (bigint)
            $table->string('name')->unique(); // Nama Fakultas, harus unik
            $table->timestamps(); // created_at & updated_at otomatis
        });
    }

    public function down()
    {
        Schema::dropIfExists('faculties');
    }
};
