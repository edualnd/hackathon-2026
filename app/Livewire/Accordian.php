<?php

namespace App\Livewire;

use App\Models\Escola;
use App\Models\Vaga;
use Livewire\Component;
use Livewire\Attributes\On;

class Accordian extends Component
{
    public $openIndex = 0;
    public $items = [];

    public $escola;
    public $vagas = [];
    public $escola_id = 1;

    #[On('escolaSelecionada')]
    public function changeEscola($escola_id)
    {
        $this->escola = Escola::findOrFail($escola_id);
        $this->carregarDados($this->escola);
    }

    public function carregarDados($escola)
    {
        $vagas = Vaga::where('escola_id', $escola->id)
            ->where('qtd', '>', 0)
            ->get();

        $this->items = [
            [
                'title' => 'Vagas Disponíveis',
                'content' => $vagas,
            ],
            [
                'title' => 'Informações',
                'content' => $escola,
            ],
        ];
    }

    public function mount()
    {
        $this->escola = Escola::where('id', $this->escola_id)->first();
        $this->carregarDados($this->escola);
    }

    public function toggle($index)
    {
        $this->openIndex = $this->openIndex === $index ? null : $index;
    }

    public function render()
    {
        return view('livewire.accordian');
    }
}