<?php

namespace App\Livewire;

use App\Models\Escola;
use Livewire\Component;

class Mapa extends Component
{
    public $escolas = [];
    public $regiao = "";
    public $bairro = "";
    public $tipo = "";

    public function carregarDados(){
        $query = Escola::query();
        $query->when($this->regiao, function ($q) {
            $q->where('regiao', $this->regiao);
        });

        $query->when($this->bairro, function ($q) {
            $q->where('bairro', $this->bairro);
        });

        $query->when($this->tipo, function ($q) {
            $q->where('tipo', 'like', "%{$this->tipo}%");
        });
        $this->escolas = $query->get()->toArray();
    }

    public function render()
    {
        $this->carregarDados();
        
        return view('livewire.mapa');
    }
}

// bairro, regiao, tipo