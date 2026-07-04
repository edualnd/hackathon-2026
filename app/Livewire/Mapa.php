<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class Mapa extends Component
{
    public $escolas = [];
    public $regiao = "";
    public $bairro = "";
    public $tipo = "";
    public $serie = "";

    public $aberto = false;

    public function mount(
        $escolas = [],
        $regiao = "",
        $bairro = "",
        $tipo = "",
        $serie = ""
    ) {
        $this->escolas = $escolas;
        $this->regiao = $regiao;
        $this->bairro = $bairro;
        $this->tipo = $tipo;
        $this->serie = $serie;
    }

    #[On('DispatchOpenMapa')]
    public function openMapa()
    {
        $this->aberto = true;
    }
    #[On('DispatchFecharnMapa')]
    public function fecharMapa()
    {
        $this->aberto = false;
    }

    public function render()
    {
        return view('livewire.mapa');
    }
}