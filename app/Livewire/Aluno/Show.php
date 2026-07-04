<?php

namespace App\Livewire\Aluno;

use Livewire\Attributes\On;
use App\Models\Escola;
use App\Models\Aluno;
use Livewire\Component;

class Show extends Component
{
    public $alunos = [];
    public $statusFiltro = '';
    public $escola;
    public $serie;

    public function mount()
    {
        $this->carregarAlunos();
    }

    public function carregarAlunos()
    {
        $this->alunos = Aluno::with(['criterios', 'escola'])
            ->when($this->statusFiltro, function ($query) {
                $query->where('status', $this->statusFiltro);
            })
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function updatedStatusFiltro()
    {
        $this->carregarAlunos();
    }

    public function render()
    {
        return view('livewire.aluno.show');
    }
}
