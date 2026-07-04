<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}