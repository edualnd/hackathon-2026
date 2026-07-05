<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Aluno extends Model
{
    protected $table = 'alunos';

    protected $fillable = [
        'escola_id',
        'vaga_id',
        'nome',
        'ra',
        'cpf',
        'sexo',
        'data_nascimento',
        'certidao_nascimento',
        'nome_responsavel',
        'cpf_responsavel',
        'parentesco',
        'telefone_pessoal',
        'telefone_recado',
        'cep',
        'uf',
        'municipio',
        'bairro',
        'logradouro',
        'numero',
        'observacao',
        'status',
    ];

    protected $casts = [
        'data_nascimento' => 'date',
    ];



    public function escola(): BelongsTo
    {
        return $this->belongsTo(Escola::class);
    }

    public function documento(): HasOne
    {
        return $this->hasOne(Documento::class);
    }

    public function criterios(): HasMany
    {
        return $this->hasMany(Criterio::class);
    }

    public function vaga(): BelongsTo
    {
        return $this->belongsTo(Vaga::class);
    }

    public function listaEspera(): HasOne
    {
        return $this->hasOne(ListaEspera::class);
    }

}