<?php

namespace App\Livewire\Aluno;

use App\Models\Aluno;
use App\Models\ListaEspera;
use App\Models\Vaga;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin', ['pageTitle' => 'Editar Aluno'])]
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

        
        $this->status = ListaEspera::where("aluno_id", $aluno->id)->value('status');

        $criterio = $aluno->criterios()->first();
        if ($criterio) {
            $this->dadosCriterio = $criterio->only(array_keys($this->dadosCriterio));
        }
    }

    public function getVagasProperty()
    {

        return Vaga::where('escola_id', 1)->with('escola')
            ->orderBy('escola_id')
            ->get()
            ->map(fn (Vaga $vaga) => [
                'id' => $vaga->id,
                'escola' => $vaga->escola->nome,
                'label' => "{$vaga->serie} ({$vaga->qtd} " . ($vaga->qtd === 1 ? 'vaga' : 'vagas') . ')',
            ]);
    }

    protected function rules(): array
    {
        return [
            'dadosAluno.vaga_id' => 'required|exists:vagas,id',
            'dadosAluno.nome' => 'required|string|max:255',
            'dadosAluno.ra' => 'nullable|string|max:255',
            'dadosAluno.cpf' => 'required|string|min:11|max:11|unique:alunos,cpf,'.$this->aluno->id,
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
            'dadosAluno.numero' => 'required|string|max:20',
            'dadosAluno.observacao' => 'nullable|string',
            'status' => 'required|in:Matriculado,Aguardando,Foi chamado,Desistencia',

            // Criterios
            'dadosCriterio.area_de_abrangencia' => 'boolean',
            'dadosCriterio.mobilidade' => 'boolean',
            'dadosCriterio.irmao' => 'boolean',
            'dadosCriterio.vulnerabilidade' => 'boolean',
            'dadosCriterio.necessidade_especial' => 'boolean',
            'dadosCriterio.matriculado' => 'boolean',
        ];
    }

    public function updatedDadosAlunoCep($value)
    {
        $cep = preg_replace('/\D/', '', $value);

        if (strlen($cep) !== 8) {
            return;
        }

        $response = Http::withoutVerifying()
    ->get("https://viacep.com.br/ws/{$cep}/json/");

$data = $response->json();

        if (!$response->successful()) {
            return;
        }

        $data = $response->json();

        if (isset($data['erro'])) {
            return;
        }

        $this->dadosAluno['uf'] = $data['uf'] ?? '';
        $this->dadosAluno['municipio'] = $data['localidade'] ?? '';
        $this->dadosAluno['bairro'] = $data['bairro'] ?? '';
        $this->dadosAluno['logradouro'] = $data['logradouro'] ?? '';
    }
    public function salvar()
    {
        
        $this->validate();
        
        $vaga = Vaga::findOrFail($this->dadosAluno['vaga_id']);

        $this->aluno->update([
            ...$this->dadosAluno,
            'escola_id' => $vaga->escola_id,
        ]);
        ListaEspera::where('aluno_id', $this->aluno->id) ->update([ 'vaga_id' =>$this->dadosAluno['vaga_id'], 'status' => $this->status, ]);

        $this->aluno->criterios()->first()?->update($this->dadosCriterio)
            ?? $this->aluno->criterios()->create($this->dadosCriterio);

        session()->flash('success', "Cadastro de {$this->aluno->nome} atualizado com sucesso.");

        return redirect()->route('v1.alunos.index');
    }

    public function render()
    {
        return view('livewire.aluno.edit', [
            'vagas' => $this->vagas,
        ]);
    }
}
