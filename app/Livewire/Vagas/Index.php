<?php

namespace App\Livewire\Vagas;

use App\Models\Escola;
use App\Models\Vaga;
use Livewire\Component;

class Index extends Component
{
    public $escolas = [];
    public $vagas = [];

    public $escola = "";
    public $serie = "";

    
    public function carregarDados($id){
        $this->escolas = Escola::select('id', 'nome')->get();
        $this->vagas = Vaga::query();

    }

    public function render()
    {
        return view('livewire.vagas.index');
    }
}
