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
    public function mount()
    {
        $this->escolaFiltro = Auth::user()->escola_id ?? '';
    }

    public function render()
    {  $this->escolaFiltro = $this->escolaFiltro ?? 'all';
            $alunos = Aluno::query()
            ->select('alunos.*')
            ->join('lista_espera', 'lista_espera.aluno_id', '=', 'alunos.id')
            ->where('lista_espera.posicao', "!=", 0)
            ->when($this->busca, function ($q) {
                $termo = "%{$this->busca}%";
                $q->where(function ($q2) use ($termo) {
                    $q2->where('alunos.nome', 'like', $termo)
                        ->orWhere('alunos.ra', 'like', $termo)
                        ->orWhere('alunos.certidao_nascimento', 'like', $termo);
                });
            })
            ->when($this->statusFiltro, fn ($q) => $q->where('lista_espera.status', $this->statusFiltro))
            ->when($this->escolaFiltro, fn ($q) => $q->where('alunos.escola_id', $this->escolaFiltro))
            ->orderBy('escola_id', 'asc') ->orderBy('vaga_id', 'asc')
            ->orderBy('lista_espera.posicao', 'asc')
            ->with(['listaEspera'])
            ->paginate(6);

          
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
