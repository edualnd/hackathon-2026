<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lista_espera', function (Blueprint $table) {

            $table->id();
            $table->foreignId('aluno_id')
                ->constrained('alunos')
                ->cascadeOnDelete();
            $table->foreignId('escola_id')
                ->constrained('escolas')
                ->cascadeOnDelete();
            $table->integer('posicao');
            $table->string('status');
            $table->timestamp('data_entrada');
            $table->timestamp('data_chamada')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lista_espera');
    }
};
