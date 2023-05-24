<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dieta__alimentos', function (Blueprint $table) {
            $table->integer("id_dieta")->foreign('id_dieta')->references('id')->on('dietas')->onDelete('cascade');
            $table->integer("id_alimento")->foreign('id_alimento')->references('id')->on('alimentos')->onDelete('cascade');
            $table->integer("id_usuario")->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade');
            //$table->primary(['id_dieta', 'id_alimento', 'id_usuario']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dieta_alimentos');
    }
};
