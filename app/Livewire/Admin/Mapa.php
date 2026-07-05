<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class Mapa extends Component
{
    public $escolas = [];
    public $bairros = [];
    public $regioes = [];
    public $tipos = [];
    public $series = [];
    public $regiao = '';
    public $bairro = '';
    public $tipo = '';
    public $serie = '';

    public function carregarDados()
    {
        $query = Escola::query()->with(['vagas', 'listaEspera']);
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
        $this->series = $escolas->flatMap(fn ($escola) => $escola->vagas->pluck('serie'))->unique()->values();

        // Formato consumido por x-site.school-card (nivel, vagas e lista_espera
        // agregados, em vez dos relacionamentos crus do Eloquent).
        $this->escolas = $escolas->map(function ($escola) {
            return [
                'id' => $escola->id,
                'nome' => $escola->nome,
                'bairro' => $escola->bairro,
                'nivel' => $escola->tipo,
                'endereco' => $escola->endereco,
                'vagas' => $escola->vagas->sum('qtd'),
                'lista_espera' => $escola->listaEspera->count(),
            ];
        })->values()->all();
    }

    public function render()
    {
        return view('livewire.admin.mapa');
    }
}
