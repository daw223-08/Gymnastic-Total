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
        Schema::create('dietas', function (Blueprint $table) {
            $table->increments("id");
            $table->string("nombre");
            $table->string("tipo");
            $table->string("descripcion");
            $table->integer("id_usuario")->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade');;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dietas');
    }
};
