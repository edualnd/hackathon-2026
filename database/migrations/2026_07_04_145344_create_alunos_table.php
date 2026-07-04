<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alunos', function (Blueprint $table) {

            $table->id();

            $table->foreignId('escola_id')
                ->nullable()
                ->constrained('escolas')
                ->nullOnDelete();
            $table->foreignId('vaga_id')
                ->nullable()
                ->constrained('vagas')
                ->nullOnDelete();

            $table->string('nome');
            $table->string('ra')->nullable();
            $table->string('cpf')->nullable()->unique();
            $table->char('sexo',1);
            $table->date('data_nascimento');
            $table->string('certidao_nascimento');
            $table->string('nome_responsavel');

            $table->string('cpf_responsavel');
            $table->string('parentesco');
            $table->string('telefone_pessoal');
            $table->string('telefone_recado')->nullable();

            $table->string('cep');
            $table->char('uf',2);
            $table->string('municipio');
            $table->string('bairro');
            $table->string('logradouro');
            $table->string('numero')->nullable();

            $table->text('observacao')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alunos');
    }
};
