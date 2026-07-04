<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Criterio extends Model
{
    protected $table = 'criterios';

    protected $fillable = [
        'aluno_id',
        'escola_id',
        'data_cadastro',
        'area_de_abrangencia',
        'mobilidade',
        'irmao',
        'vulnerabilidade',
        'necessidade_especial',
        'matriculado',
    ];

    protected $casts = [
        'data_cadastro' => 'date',
        'area_de_abrangencia' => 'boolean',
        'mobilidade' => 'boolean',
        'irmao' => 'boolean',
        'vulnerabilidade' => 'boolean',
        'necessidade_especial' => 'boolean',
        'matriculado' => 'boolean',
    ];

    public function aluno(): BelongsTo
    {
        return $this->belongsTo(Aluno::class);
    }

    public function escola(): BelongsTo
    {
        return $this->belongsTo(Escola::class);
    }

}