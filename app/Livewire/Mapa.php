<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Attributes\Reactive;

class Mapa extends Component
{
    #[Reactive]
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

      public function updatedEscolas($value): void
   {
       $this->dispatch('escolas-atualizadas', escolas: $value);
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