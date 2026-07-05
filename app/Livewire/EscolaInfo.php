<?php

namespace App\Livewire;
use Livewire\Attributes\On;
use App\Models\Escola;
use App\Models\Vaga;
use App\Models\ListaEspera;
use Livewire\Component;

class EscolaInfo extends Component
{
    public $escola_id = 1;
    public $escola;
    public $qtdVagas;
    public $qtdEspera;

    public function mount()
    {
        $this->escola = Escola::where('id', $this->escola_id)->first();

        $this->carregarDados($this->escola);
    }

    public function carregarDados()
    {
        $this->qtdVagas = Vaga::where('escola_id', $this->escola->id)
            ->where('qtd', '>', 0)
            ->sum('qtd');

        $this->qtdEspera = ListaEspera::where('escola_id', $this->escola->id)
            ->count();
    }

    #[On('escolaSelecionada')]
    public function changeEscola($escola_id)
    {
        $this->escola = Escola::findOrFail($escola_id);
        $this->carregarDados();
    }


    public function render()
    {
        return view('livewire.escola-info');
    }
}
