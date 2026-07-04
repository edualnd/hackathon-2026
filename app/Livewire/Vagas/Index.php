<?php

namespace App\Livewire\Vagas;

use App\Models\Aluno;
use App\Models\Escola;
use App\Models\Vaga;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * Gerenciamento de Vagas por escola/série (área administrativa).
 * Lista, busca e filtra as vagas cadastradas, com ações de criar,
 * editar (via modais) e excluir.
 */
class Index extends Component
{
    use WithPagination;

    public string $busca = '';

    public string $escolaFiltro = '';

    public string $successMessage = '';

    protected $queryString = ['busca', 'escolaFiltro'];

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

    public function excluir(int $id): void
    {
        $vaga = Vaga::findOrFail($id);
        $descricao = "{$vaga->serie} — {$vaga->escola?->nome}";
        $vaga->delete();

        $this->successMessage = "Vaga {$descricao} removida.";
    }

    public function limparFiltros(): void
    {
        $this->reset(['busca', 'escolaFiltro']);
        $this->resetPage();
    }

    public function render()
    {
        $vagas = Vaga::query()
            ->with('escola')
            ->withCount(['alunos as matriculados_count' => function ($query) {
                $query->where('status', Aluno::STATUS_VAGA_CONSEGUIDA);
            }])
            ->when($this->busca, fn ($query) => $query->where('serie', 'like', "%{$this->busca}%"))
            ->when($this->escolaFiltro, fn ($query) => $query->where('escola_id', $this->escolaFiltro))
            ->orderBy('escola_id')
            ->paginate(8);

        return view('livewire.vagas.index', [
            'vagas' => $vagas,
            'escolas' => Escola::select('id', 'nome')->orderBy('nome')->get(),
        ])->layout('layouts.admin', ['pageTitle' => 'Vagas por Escola']);
    }
}
