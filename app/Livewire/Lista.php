<?php

namespace App\Livewire;

use Livewire\Component;

class Lista extends Component
{
    public $escolas = [];
    public $bairros = [];
    public $regioes = [];
    public $regiao = "";
    public $bairro = "";
    public $tipo = "";
    public $serie = "";

    public function carregarDados(){
        $query = Escola::query()->with('vagas');
        $query->when($this->regiao, function ($q) {
            $q->where('regiao', $this->regiao);
        });

        $query->when($this->bairro, function ($q) {
            $q->where('bairro', $this->bairro);
        });

        $query->when($this->tipo, function ($q) {
            $q->where('tipo', 'like', "%{$this->tipo}%");
        });
        $query->when($this->serie, function ($q) {
            $q->whereHas('vagas', function ($q) {
                $q->where('serie', $this->serie)
                    ->where('qtd', '!=', 0);
            });
        });

        $escolas = $query->get();
        $this->bairros = $escolas->pluck('bairro')->unique()->values();
        $this->regioes = $escolas->pluck('regiao')->unique()->values();
        $this->escolas = $escolas->toArray();
    }

    public function render()
    {
        return view('livewire.lista');
    }
}
