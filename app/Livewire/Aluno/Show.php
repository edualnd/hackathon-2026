<?php

namespace App\Livewire\Aluno;

use App\Models\Aluno;
use App\Models\Escola;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * Gerenciamento de Alunos (área administrativa).
 * Lista, busca e filtra os cadastros, com ações de editar/excluir.
 */
#[Layout('layouts.admin', ['pageTitle' => 'Gerenciamento de Alunos'])]
class Show extends Component
{
    use WithPagination;

    public  $busca = '';

    public  $statusFiltro = '';

    public  $escolaFiltro = '';



    public function updating($property): void
    {
        if (in_array($property, ['busca', 'statusFiltro', 'escolaFiltro'], true)) {
            $this->resetPage();
        }
    }

    public function excluir(int $id): void
    {
        $aluno = Aluno::findOrFail($id);
        $nome = $aluno->nome;
        $aluno->delete();

        session()->flash('success', "Cadastro de {$nome} removido.");
    }

    public function limparFiltros(): void
    {
        $this->reset(['busca', 'statusFiltro', 'escolaFiltro']);
        $this->resetPage();
    }

    public function render()
    {
        $alunos = Aluno::query()
            ->whereHas('listaEspera')
            ->with(['escola', 'vaga', 'listaEspera'])
            ->when($this->busca, function ($query) {
                $termo = "%{$this->busca}%";
                $query->where(function ($q) use ($termo) {
                    $q->where('nome', 'like', $termo)
                        ->orWhere('ra', 'like', $termo)
                        ->orWhere('certidao_nascimento', 'like', $termo);
                });
            })
            ->when($this->statusFiltro, fn ($query) => $query->where('status', $this->statusFiltro))
            ->when($this->escolaFiltro, fn ($query) => $query->where('escola_id', $this->escolaFiltro))
            ->orderByDesc('created_at')
            ->paginate(10);

            $this->escolaFiltro = Auth::user()->escola_id ?? '';
        return view('livewire.aluno.show', [
            'alunos' => $alunos,
            'escolas' => Escola::select('id', 'nome')->orderBy('nome')->get()->toArray(),
            'statuses' => [
                ['id' => 'Aguardando', 'nome' => 'Aguardando'],
                ['id' => 'Matriculado', 'nome' => 'Matriculado'],
                ['id' => 'Desistencia', 'nome' => 'Desistencia'],
                ['id' => 'Foi chamado', 'nome' => 'Foi chamado'],
            ],
        ]);
    }
}
