<?php

namespace App\Livewire\Vagas;


use App\Models\Escola;
use App\Models\ListaEspera;
use App\Models\Vaga;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;


#[Layout('layouts.admin', ['pageTitle' => 'Vagas'])]
class Index extends Component
{
    use WithPagination;


    public $busca = '';
    public $escolaFiltro = '';
    public $successMessage = '';
   

    public function updatingBusca(): void
    {
        $this->resetPage();
 
    }

    public function updatingEscolaFiltro(): void
    {
        $this->resetPage();

    }

    #[On('vagaSalva')]
    public function marcarSucesso(?string $mensagem = null): void
    {
        $this->successMessage = $mensagem ?? 'Operação realizada com sucesso.';
    }

    

    public function limparFiltros(): void
    {
        $this->reset(['busca', 'escolaFiltro']);
        $this->resetPage();
    }
public function excluir(int $id): void
    {
        $vaga = Vaga::findOrFail($id);
        $descricao = "{$vaga->serie} — {$vaga->escola?->nome}";
        $vaga->delete();

        $this->successMessage = "Vaga {$descricao} removida.";
    }
  
    public function render()
    {
        

        return view('livewire.vagas.index', [

'vagas' => Vaga::query()
    ->with('escola:id,nome')

    ->withCount([
        'lista as total_lista_espera',

        'lista as matriculados_count' =>
            fn ($q) => $q->where('status', 'Matriculado'),
    ])

    ->when($this->busca, fn ($q) =>
        $q->where('serie', 'like', "%{$this->busca}%")
    )

    ->when($this->escolaFiltro, fn ($q) =>
        $q->where('escola_id', $this->escolaFiltro)
    )

    ->paginate(10),

        'escolas' => Escola::select('id', 'nome')->orderBy('nome')->get()->toArray(),
    ]);
    }
}   
