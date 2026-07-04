<?php

namespace App\Livewire\Site;

use App\Models\Escola;
use App\Support\MockSchools;
use Livewire\Attributes\Computed;
use Livewire\Component;

/**
 * Tela dos pais: filtros de nível de ensino, bairro e série para
 * consulta de vagas em unidades escolares. Dados 100% mockados
 * (App\Support\MockSchools) — sem integração com backend/API.
 *
 * Filtragem em tempo real: os selects usam wire:model.live, então qualquer
 * alteração recalcula "resultados" automaticamente, sem reload e sem exigir
 * um botão de busca explícito.
 */
class SchoolSearch extends Component
{
     public $escolas = [];
    public $bairros = [];
    public $regioes = [];
    public $tipos = [];
    public $series = [];
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
        $this->tipos = $escolas->pluck('tipo')->unique()->values();
        $this->series = $escolas->pluck('tipo')->unique()->values();
        $this->escolas = $escolas->toArray();
    }


    public function render()
    {
        $this->carregarDados();
        return view('livewire.site.school-search')->layout('layouts.site', ['pageTitle' => 'Consultar Vagas']);
    }
}
