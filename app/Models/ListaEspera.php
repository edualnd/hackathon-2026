<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ListaEspera extends Model
{
    protected $table = 'lista_espera';

    protected $fillable = [
        'aluno_id',
        'escola_id',
        'vaga_id',
        'posicao',
        'pontuacao',
        'data_chamada',
    ];

    protected $casts = [
        'data_chamada' => 'datetime',
    ];

    public function aluno(): BelongsTo
    {
        return $this->belongsTo(Aluno::class);
    }

    public function vaga(): BelongsTo
    {
        return $this->belongsTo(Vaga::class);
    }

}