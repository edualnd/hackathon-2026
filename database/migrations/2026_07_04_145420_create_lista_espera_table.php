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
            $table->foreignId('vaga_id')
                ->constrained('vagas')
                ->cascadeOnDelete();
                
            $table->integer('posicao');
            $table->string('pontuacao');

            $table->timestamp('data_chamada')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lista_espera');
    }
};
