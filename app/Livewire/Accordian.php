<?php

namespace App\Livewire;

use Livewire\Component;

class Accordian extends Component
{
    public $items = [];
    public $openIndex = 0;

    public function mount()
    {
        $this->items = [
            [
                'title' => 'Informações',
                'content' => 'É a plataforma de transparência municipal de Caraguatatuba, com dados de licitações, contratos, servidores e mais.',
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
