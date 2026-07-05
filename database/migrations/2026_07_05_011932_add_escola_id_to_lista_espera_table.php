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
        Schema::table('lista_espera', function (Blueprint $table) {
          $table->foreignId('escola_id')->after('aluno_id')->constrained('escolas')->cascadeOnDelete();
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::table('lista_espera', function (Blueprint $table) {
          $table->dropConstrainedForeignId('escola_id');
      });
    }
};
