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
        Schema::create('alimentos', function (Blueprint $table) {
            $table->increments("id");
            $table->string("nombre");
            $table->string("cantidad");
            $table->string("familia");
            $table->string("horario_ingesta");
            $table->string("dia");
            $table->string("kcal");
            $table->string("id_usuario");
            $table->timestamps();
        });

        /*DB::table('alimentos')->insert([

            ["nombre" => "Yogur de soja con 2 cucharadas de miel", "cantidad" => "2 u.", "familia" => "Lacteo", "horario_ingesta" => "Desayuno", "dia" => "Lunes"],
            ["nombre" => "Pieza de fruta", "cantidad" => "1 u.", "familia" => "Fruta", "horario_ingesta" => "Desayuno", "dia" => "Lunes"],
            ["nombre" => "Pieza de fruta", "cantidad" => "2 u.", "familia" => "Fruta", "horario_ingesta" => "Desayuno", "dia" => "Lunes"],
            ["nombre" => "Cereal integral", "cantidad" => "60g", "familia" => "Cereal", "horario_ingesta" => "Desayuno", "dia" => "Martes"],
            ["nombre" => "Tostada integral con aceite de oliva", "cantidad" => "2 de 20g", "familia" => "Derivado cereal", "horario_ingesta" => "Desayuno", "dia" => "Miercoles"],
            ["nombre" => "Batido de soja enriquezido con caco en polvo", "cantidad" => "1 vaso", "familia" => "Derivado de leguminosas", "horario_ingesta" => "Desayuno", "dia" => "Jueves"],
            ["nombre" => "Batido de soja enriquezido con caco en polvo", "cantidad" => "1 bol", "familia" => "Derivado de leguminosas", "horario_ingesta" => "Desayuno", "dia" => "Jueves"],
            ["nombre" => "Galletas", "cantidad" => "4 u.", "familia" => "Derivado de cereal", "horario_ingesta" => "Desayuno", "dia" => "Viernes"],
            ["nombre" => "Bocadillo de seitán con aceite de oliva", "cantidad" => "1 u.", "familia" => "Otro", "horario_ingesta" => "Desayuno", "dia" => "Sabado"],
            ["nombre" => "Biscote integral", "cantidad" => "4 de 10g", "familia" => "Derivado cereal", "horario_ingesta" => "Desayuno", "dia" => "Domingo"],
            
            /*
            
            ["nombre" => "Bocadillo de seitán", "cantidad" => "1 u.", "familia" => "Otro", "horario_ingesta" => "Media mañana"],
            ["nombre" => "Pan integral", "cantidad" => "80 g", "familia" => "Derivado de cereal", "horario_ingesta" => "Media mañana"],
            ["nombre" => "Pan integral", "cantidad" => "40 g", "familia" => "Derivado de cereal", "horario_ingesta" => "Media mañana"],
            ["nombre" => "Rebanada de pan de molde integral", "cantidad" => "2 u.", "familia" => "Derivado de cereal", "horario_ingesta" => "Media mañana"],
            ["nombre" => "Rodaja de seitán", "cantidad" => "70 g", "familia" => "Otro", "horario_ingesta" => "Media mañana"],
            ["nombre" => "Frutos secos", "cantidad" => "40 g", "familia" => "Frutos secos", "horario_ingesta" => "Media mañana"],
            ["nombre" => "Tofu", "cantidad" => "50 g", "familia" => "Legumbre", "horario_ingesta" => "Media mañana"],
            
           
            
            ["nombre" => "Pasta con verduritas salteadas", "cantidad" => "---", "familia" => "Pasta", "horario_ingesta" => "Comida"],
            ["nombre" => "Hamburguesa vegetal con ensalada verde", "cantidad" => "---", "familia" => "Otro", "horario_ingesta" => "Comida"],
            ["nombre" => "Pieza de fruta", "cantidad" => "1 u.", "familia" => "Fruta", "horario_ingesta" => "Comida"],
            ["nombre" => "Pieza de fruta", "cantidad" => "2 u.", "familia" => "Fruta", "horario_ingesta" => "Comida"],
            ["nombre" => "Lentejas especiadas", "cantidad" => "---", "familia" => "Legumbres", "horario_ingesta" => "Comida"],
            ["nombre" => "Falafel con ensalada de tomate", "cantidad" => "---", "familia" => "Otro", "horario_ingesta" => "Comida"],
            ["nombre" => "Ensalada de cogollos y palmitos", "cantidad" => "---", "familia" => "Otro", "horario_ingesta" => "Comida"],
            ["nombre" => "Espaguetis a la boloñesa", "cantidad" => "---", "familia" => "Pasta", "horario_ingesta" => "Comida"],
            ["nombre" => "Arroz integral con setas", "cantidad" => "---", "familia" => "Arroz", "horario_ingesta" => "Comida"],
            ["nombre" => "Canelones de verduras", "cantidad" => "---", "familia" => "Verdura", "horario_ingesta" => "Comida"],
            ["nombre" => "Guisantes salteados", "cantidad" => "---", "familia" => "Verdura", "horario_ingesta" => "Comida"],
            ["nombre" => "Seitán frito a la menta con patata al horno", "cantidad" => "---", "familia" => "Otro", "horario_ingesta" => "Comida"],
            ["nombre" => "Parrillada de verduras", "cantidad" => "---", "familia" => "Verdura", "horario_ingesta" => "Comida"],
            ["nombre" => "Paella vegetal", "cantidad" => "---", "familia" => "Verdura", "horario_ingesta" => "Comida"],
            ["nombre" => "Guacamole", "cantidad" => "---", "familia" => "Fruta", "horario_ingesta" => "Comida"],
            ["nombre" => "Espinacas a la catalana", "cantidad" => "---", "familia" => "Verdura", "horario_ingesta" => "Comida"],
    
            

            ["nombre" => "Batido de soja enriquecido con caco en miel", "cantidad" => "1 vaso", "familia" => "Derivado de leguminosas", "horario_ingesta" => "Merienda"],
            ["nombre" => "Galletas", "cantidad" => "4 u.", "familia" => "Derivado dereal", "horario_ingesta" => "Merienda"],
            ["nombre" => "Yogur de soja con 2 cucharadas de miel", "cantidad" => "2 u.", "familia" => "Lacteo", "horario_ingesta" => "Merienda"],
            ["nombre" => "Cereal integral", "cantidad" => "30 g", "familia" => "Cereal", "horario_ingesta" => "Merienda"],
            ["nombre" => "Frutos secos", "cantidad" => "20 g", "familia" => "Frutos secos", "horario_ingesta" => "Merienda"],
            ["nombre" => "Infusión con miel", "cantidad" => "---", "familia" => "Otro", "horario_ingesta" => "Merienda"],
            ["nombre" => "Biscote integral", "cantidad" => "4 u.", "familia" => "Derivado cereal", "horario_ingesta" => "Merienda"],
            ["nombre" => "Biscote integral", "cantidad" => "3 u.", "familia" => "Derivado cereal", "horario_ingesta" => "Merienda"],
            ["nombre" => "Pieza de fruta", "cantidad" => "1 u.", "familia" => "Fruta", "horario_ingesta" => "Merienda"],

            

            ["nombre" => "Ensalada de tomate y nueces", "cantidad" => "---", "familia" => "Verdura", "horario_ingesta" => "Cena"],
            ["nombre" => "Brocheta de tofu", "cantidad" => "---", "familia" => "Legumbre", "horario_ingesta" => "Cena"],
            ["nombre" => "Pieza de fruta", "cantidad" => "1 u.", "familia" => "Fruta", "horario_ingesta" => "Cena"],
            ["nombre" => "Pieza de fruta", "cantidad" => "2 u.", "familia" => "Fruta", "horario_ingesta" => "Cena"],
            ["nombre" => "Crema de calabacin", "cantidad" => "---", "familia" => "Verdura", "horario_ingesta" => "Cena"],
            ["nombre" => "Rollitos de primavera con flan de arroz", "cantidad" => "---", "familia" => "Otro", "horario_ingesta" => "Cena"],
            ["nombre" => "Vichyssoise", "cantidad" => "200 g", "familia" => "Verdura", "horario_ingesta" => "Cena"],
            ["nombre" => "Macedonia con chocolate", "cantidad" => "---", "familia" => "Otro", "horario_ingesta" => "Cena"],
            ["nombre" => "Gazpacho", "cantidad" => "300 g", "familia" => "Verdura", "horario_ingesta" => "Cena"],
            ["nombre" => "Gazpacho", "cantidad" => "300 g", "familia" => "Verdura", "horario_ingesta" => "Cena"],
            ["nombre" => "Ensalada de arroz integral", "cantidad" => "---", "familia" => "Arroz", "horario_ingesta" => "Cena"],
            ["nombre" => "Espaguetis con alcachofas", "cantidad" => "---", "familia" => "Pasta", "horario_ingesta" => "Cena"],
            ["nombre" => "Croquetas de cuscús integral", "cantidad" => "---", "familia" => "Otro", "horario_ingesta" => "Cena"],
            ["nombre" => "Salteado de setas", "cantidad" => "---", "familia" => "Otro", "horario_ingesta" => "Cena"],
            ["nombre" => "Sopa de tomate", "cantidad" => "---", "familia" => "Verdura", "horario_ingesta" => "Cena"]*/
        //]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alimentos');
    }
};
