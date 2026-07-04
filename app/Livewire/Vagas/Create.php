<?php

namespace App\Livewire\Vagas;

use App\Models\Escola;
use Livewire\Attributes\On;
use Livewire\Component;

class Create extends Component
{
    public $escolas = [];
    public $vaga = [
        "escola_id" => "",
        'qtd' => "",
        'serie' => "",
    ];

    public $series = [
        '1º Ano',
        '2º Ano',
        '3º Ano',
        '4º Ano',
        '5º Ano',
        '6º Ano',
        '7º Ano',
        '8º Ano',
        '9º Ano',
        'B1',
        'B2',
        'M1',
        'M2',
        ];
    #[On('dispatchOpenModalCreateVaga')]
    public function OpenModal(){
        $this->resetValidation();
        $this->reset('vaga');
        $this->escolas = Escola::select('id', 'nome')->get();
    }


    public function render()
    {
        return view('livewire.vagas.create');
    }
}
