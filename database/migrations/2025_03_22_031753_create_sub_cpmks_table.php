<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('sub_cpmks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cpmk_id')->constrained('cpmks')->onDelete('cascade'); // Relasi ke CPMK
            $table->string('code')->unique(); // Misal: SubCPMK1, SubCPMK2
            $table->text('description'); // Deskripsi Sub CPMK
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sub_cpmks');
    }
};
