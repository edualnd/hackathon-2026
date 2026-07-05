<?php

namespace App\Livewire;
use App\Models\Escola;
use App\Models\Vaga;
use Livewire\Component;

class Accordian extends Component
{
    public $escola;

    public $qtdVagas;

    public $items = [];
    public $openIndex = 0;

    #[On('escolaSelecionada')]
    public function changeEscola($escola){
        $this->escola = $escola;
    }

    public function mount()
    {
        $this->escola = Escola::find(1);

        $this->items = [
            [
                'title' => 'Informações',
                'content' => $this->escola,
            ],
            [
                'title' => 'Vagas',
                'content' => 'O JU é um assistente virtual que ajuda os cidadãos a encontrar informações públicas rapidamente.',
            ]
        ];
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
