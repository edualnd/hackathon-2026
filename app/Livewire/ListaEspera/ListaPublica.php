<?php

namespace App\Livewire\ListaEspera;

use App\Models\ListaEspera;
use App\Models\Vaga;
use Livewire\Attributes\On;
use Livewire\Component;

class ListaPublica extends Component
{

    public $vagaId = null;
    public $vaga = [
        'escola' => [
            'nome' => ""
        ]
    ];

    public $listaEspera = [];

    public function mount(){
            $this->vaga = [
                'id' => 0,
                'escola' => [
                    'nome' => ""
                ],
                'serie'=> "",
                'qtd'=> ""
            ];

    }
    #[On('openListaPublica')]
    public function openListaPublica($id = 1){
        
        $this->vagaId = $id;

        $this->vaga = Vaga::with('escola')->findOrFail($id);

         $this->listaEspera = ListaEspera::with('aluno')
            ->where('vaga_id', $id)
            ->whereNotIn('status', ["Matriculado", "Desistencia"])
            ->orderBy('posicao')
            ->get();;


    }
    #[On('changeListaPublica')]
    public function changeListaPublica(){
            
            
            $this->reset('vaga');
            $this->vaga = [
                'id' => 0,
                'escola' => [
                    'nome' => ""
                ],
                'serie'=> "",
                'qtd'=> ""
            ];



        }
    public function render()
    {
        return view('livewire.lista-espera.lista-publica');
    }
}
