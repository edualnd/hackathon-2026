<?php

namespace App\Models;

use App\Models\ListaEspera;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Vaga extends Model
{
    protected $table = 'vagas';

    protected $fillable = [
        'escola_id',
        'serie',
        'qtd',
    ];

    public function escola(): BelongsTo
    {
        return $this->belongsTo(Escola::class);
    }
    public function lista(): HasOne
    {
        return $this->HasOne(ListaEspera::class);
    }

    public function alunos(): HasMany
    {
        return $this->HasMany(Aluno::class);
    }
}