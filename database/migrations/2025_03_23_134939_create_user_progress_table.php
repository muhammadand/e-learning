<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('sub_cpmk_id')->constrained()->onDelete('cascade');
            $table->foreignId('material_id')->nullable()->constrained()->onDelete('cascade'); // Menambahkan material_id
            $table->foreignId('quiz_id')->nullable()->constrained('quizzes')->onDelete('cascade'); // Menambahkan quiz_id
            $table->boolean('is_material_done')->default(false);
            $table->boolean('is_quiz_done')->default(false);
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_progress');
    }
};