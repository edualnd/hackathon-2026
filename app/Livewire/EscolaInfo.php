<?php

namespace App\Livewire;
use Livewire\Attributes\On;
use App\Models\Escola;
use Livewire\Component;

class EscolaInfo extends Component
{
    public $escola;

    public function mount()
    {
        $this->escola = Escola::find(1);
    }

    #[On('escolaSelecionada')]
    public function changeEscola($escola){
        $this->escola = $escola;
    }

    public function render()
    {
        return view('livewire.escola-info');
    }
}
