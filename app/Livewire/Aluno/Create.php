<?php

namespace App\Livewire\Aluno;

use App\Models\Aluno;
use App\Models\ListaEspera;
use App\Models\Vaga;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

/**
 * Cadastro de aluno (área administrativa).
 *
 * Ao salvar, verifica automaticamente se ainda há vaga disponível
 * na série/escola escolhida: se houver, o aluno é matriculado
 * (status "vaga_conseguida"); caso contrário, entra na lista de
 * espera com pontuação calculada a partir dos critérios marcados.
 */
class Create extends Component
{
    public array $dadosAluno = [
        'vaga_id' => '',
        'nome' => '',
        'ra' => '',
        'cpf' => '',
        'sexo' => '',
        'data_nascimento' => '',
        'certidao_nascimento' => '',
        'nome_responsavel' => '',
        'cpf_responsavel' => '',
        'parentesco' => '',
        'telefone_pessoal' => '',
        'telefone_recado' => '',
        'cep' => '',
        'uf' => 'SP',
        'municipio' => 'Caraguatatuba',
        'bairro' => '',
        'logradouro' => '',
        'numero' => '',
        'observacao' => '',
    ];

    public array $dadosCriterio = [
        'area_de_abrangencia' => false,
        'mobilidade' => false,
        'irmao' => false,
        'vulnerabilidade' => false,
        'necessidade_especial' => false,
        'matriculado' => false,
    ];

    public function mount(): void
    {
        //
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
            'dadosAluno.cpf' => 'nullable|string|max:255|unique:alunos,cpf',
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

            'dadosCriterio.area_de_abrangencia' => 'boolean',
            'dadosCriterio.mobilidade' => 'boolean',
            'dadosCriterio.irmao' => 'boolean',
            'dadosCriterio.vulnerabilidade' => 'boolean',
            'dadosCriterio.necessidade_especial' => 'boolean',
            'dadosCriterio.matriculado' => 'boolean',
        ];
    }

    protected function messages(): array
    {
        return [
            'dadosAluno.vaga_id.required' => 'Selecione a escola e a série pretendidas.',
            'dadosAluno.vaga_id.exists' => 'A vaga selecionada não é válida.',
            'dadosAluno.cpf.unique' => 'Já existe um aluno cadastrado com este CPF.',
            'dadosAluno.data_nascimento.before' => 'Informe uma data de nascimento válida.',
        ];
    }

    public function salvar()
    {
        $this->validate();

        $aluno = DB::transaction(function () {
            $vaga = Vaga::findOrFail($this->dadosAluno['vaga_id']);

            $matriculados = Aluno::where('vaga_id', $vaga->id)
                ->where('status', Aluno::STATUS_VAGA_CONSEGUIDA)
                ->count();

            $status = $matriculados < $vaga->qtd
                ? Aluno::STATUS_VAGA_CONSEGUIDA
                : Aluno::STATUS_FILA_ESPERA;

            $aluno = Aluno::create([
                ...$this->dadosAluno,
                'escola_id' => $vaga->escola_id,
                'status' => $status,
            ]);

            $aluno->criterios()->create($this->dadosCriterio);

            if ($status === Aluno::STATUS_FILA_ESPERA) {
                $this->adicionarListaEspera($aluno, $vaga);
            }

            return $aluno;
        });

        session()->flash('success', $aluno->status === Aluno::STATUS_VAGA_CONSEGUIDA
            ? "{$aluno->nome} foi matriculado(a) com sucesso!"
            : "{$aluno->nome} foi adicionado(a) à lista de espera.");

        return redirect()->route('admin.alunos.index');
    }

    private function adicionarListaEspera(Aluno $aluno, Vaga $vaga): void
    {
        $posicao = (ListaEspera::where('vaga_id', $vaga->id)->max('posicao') ?? 0) + 1;

        $pontuacao = 50 + collect($this->dadosCriterio)->filter()->count() * 10;

        ListaEspera::create([
            'aluno_id' => $aluno->id,
            'vaga_id' => $vaga->id,
            'posicao' => $posicao,
            'pontuacao' => (string) $pontuacao,
        ]);
    }

    public function render()
    {
        return view('livewire.aluno.create', [
            'vagas' => $this->vagas,
        ])->layout('layouts.admin', ['pageTitle' => 'Cadastro de Aluno']);
    }
}
