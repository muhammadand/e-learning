<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('material_user_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relasi ke user
            $table->foreignId('material_id')->constrained()->onDelete('cascade'); // Relasi ke material
            $table->boolean('is_completed')->default(false); // Status selesai atau belum
            $table->timestamps();
            
            // Mencegah duplikasi data (satu user hanya bisa menandai satu material sekali)
            $table->unique(['user_id', 'material_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('material_user_progress');
    }
};
