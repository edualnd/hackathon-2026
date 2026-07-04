<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('escolas', function (Blueprint $table) {
            $table->id();

            $table->string('nome');
            $table->string('telefone');
            $table->string('email');
            $table->string('tipo');
            $table->string('regiao');
            $table->string('bairro');
            $table->string('endereco');
            $table->boolean('integral');
            $table->decimal('lat', 10, 8);
            $table->decimal('lng', 11, 8);

            $table->timestamps();



        });
    }

    public function down(): void
    {
        Schema::dropIfExists('escolas');
    }
};
