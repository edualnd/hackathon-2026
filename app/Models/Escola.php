<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Escola extends Model
{
    protected $table = 'escolas';

    protected $fillable = [
        'nome',
        'telefone',
        'email',
        'tipo',
        'lat',
        'lng',
        'regiao',
        'bairro',
        'endereco',
        'integral'

    ];

    public function vagas(): HasMany
    {
        return $this->hasMany(Vaga::class);
    }

    public function alunos(): HasMany
    {
        return $this->hasMany(Aluno::class);
    }

    public function criterios(): HasMany
    {
        return $this->hasMany(Criterio::class);
    }

    public function listaEspera(): HasMany
    {
        return $this->hasMany(ListaEspera::class);
    }
}