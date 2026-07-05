<?php

namespace App\Livewire\Aluno;

use App\Models\Aluno;
use App\Models\Vaga;
use Livewire\Component;

class Edit extends Component
{
    public Aluno $aluno;

    public array $dadosAluno = [];

    public array $dadosCriterio = [
        'area_de_abrangencia' => false,
        'mobilidade' => false,
        'irmao' => false,
        'vulnerabilidade' => false,
        'necessidade_especial' => false,
        'matriculado' => false,
    ];

    public string $status = '';

    public function mount(Aluno $aluno): void
    {
        $this->aluno = $aluno;

        $this->dadosAluno = $aluno->only([
            'vaga_id', 'nome', 'ra', 'cpf', 'sexo', 'data_nascimento',
            'certidao_nascimento', 'nome_responsavel', 'cpf_responsavel',
            'parentesco', 'telefone_pessoal', 'telefone_recado', 'cep',
            'uf', 'municipio', 'bairro', 'logradouro', 'numero', 'observacao',
        ]);

        $this->dadosAluno['data_nascimento'] = optional($aluno->data_nascimento)->format('Y-m-d');
        $this->status = $aluno->status;

        $criterio = $aluno->criterios()->first();
        if ($criterio) {
            $this->dadosCriterio = $criterio->only(array_keys($this->dadosCriterio));
        }
    }

    public function getVagasProperty()
    {
        return Vaga::with('escola')
            ->orderBy('escola_id')
            ->get()
            ->map(fn (Vaga $vaga) => [
                'id' => $vaga->id,
                'label' => "{$vaga->escola->nome} — {$vaga->serie} ({$vaga->qtd} " . ($vaga->qtd === 1 ? 'vaga' : 'vagas') . ')',
            ]);
    }

    protected function rules(): array
    {
        return [
            'dadosAluno.vaga_id' => 'required|exists:vagas,id',
            'dadosAluno.nome' => 'required|string|max:255',
            'dadosAluno.ra' => 'nullable|string|max:255',
            'dadosAluno.cpf' => 'nullable|string|max:255|unique:alunos,cpf,'.$this->aluno->id,
            'dadosAluno.sexo' => 'required|in:M,F',
            'dadosAluno.data_nascimento' => 'required|date|before:today',
            'dadosAluno.certidao_nascimento' => 'required|string|max:255',
            'dadosAluno.nome_responsavel' => 'required|string|max:255',
            'dadosAluno.cpf_responsavel' => 'required|string|max:255',
            'dadosAluno.parentesco' => 'required|string|max:255',
            'dadosAluno.telefone_pessoal' => 'required|string|max:255',
            'dadosAluno.telefone_recado' => 'nullable|string|max:255',
            'dadosAluno.cep' => 'required|string|max:9',
            'dadosAluno.uf' => 'required|string|size:2',
            'dadosAluno.municipio' => 'required|string|max:255',
            'dadosAluno.bairro' => 'required|string|max:255',
            'dadosAluno.logradouro' => 'required|string|max:255',
            'dadosAluno.numero' => 'nullable|string|max:20',
            'dadosAluno.observacao' => 'nullable|string',
            'status' => 'required|in:'.implode(',', array_keys(Aluno::STATUSES)),

            'dadosCriterio.area_de_abrangencia' => 'boolean',
            'dadosCriterio.mobilidade' => 'boolean',
            'dadosCriterio.irmao' => 'boolean',
            'dadosCriterio.vulnerabilidade' => 'boolean',
            'dadosCriterio.necessidade_especial' => 'boolean',
            'dadosCriterio.matriculado' => 'boolean',
        ];
    }

    public function salvar()
    {
        $this->validate();

        $vaga = Vaga::findOrFail($this->dadosAluno['vaga_id']);

        $this->aluno->update([
            ...$this->dadosAluno,
            'escola_id' => $vaga->escola_id,
            'status' => $this->status,
        ]);

        $this->aluno->criterios()->first()?->update($this->dadosCriterio)
            ?? $this->aluno->criterios()->create($this->dadosCriterio);

        session()->flash('success', "Cadastro de {$this->aluno->nome} atualizado com sucesso.");

        return redirect()->route('admin.alunos.index');
    }

    public function render()
    {
        return view('livewire.aluno.edit', [
            'vagas' => $this->vagas,
        ])->layout('layouts.admin', ['pageTitle' => 'Editar Aluno']);
    }
}
