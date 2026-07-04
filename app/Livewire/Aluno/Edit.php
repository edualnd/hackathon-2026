<?php

namespace App\Livewire\Aluno;

use App\Models\Escola;
use App\Models\Vaga;
use Livewire\Attributes\On;
use Livewire\Component;

class Edit extends Component
{
    
    public function render()
    {
        return view('livewire.aluno.edit');
    }
}
