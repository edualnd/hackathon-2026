<?php

namespace App\Livewire;

use Livewire\Component;

class SwitchExibicao extends Component
{   
    public $escolas = [];
    public $bairros = [];
    public $regioes = [];
    public $regiao = "";
    public $bairro = "";
    public $tipo = "";
    public $serie = "";

    public $exibicao = 'lista';

    public function switchLista(){
        $this->exibicao = 'lista'; 
    }
    
    public function switchMapa(){
        $this->exibicao = 'mapa';
    }

    public function render()
    {
        return view('livewire.switch-exibicao');
    }
}
