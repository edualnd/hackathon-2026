<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('criterios', function (Blueprint $table) {

            $table->id();

            $table->foreignId('aluno_id')
                ->constrained('alunos')
                ->cascadeOnDelete();
            $table->boolean('area_de_abrangencia');
            $table->boolean('mobilidade');
            $table->boolean('irmao');
            $table->boolean('vulnerabilidade');
            $table->boolean('necessidade_especial');
            $table->boolean('matriculado');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('criterios');
    }
};
