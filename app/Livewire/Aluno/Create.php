<?php

namespace App\Livewire\Aluno;

use App\Models\Aluno;
use App\Models\ListaEspera;
use App\Models\Vaga;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Layout;
use Livewire\Component;

/**
 * Cadastro de aluno (área administrativa).
 *
 * Ao salvar, verifica automaticamente se ainda há vaga disponível
 * na série/escola escolhida: se houver, o aluno é matriculado
 * (status "vaga_conseguida"); caso contrário, entra na lista de
 * espera com pontuação calculada a partir dos critérios marcados.
 */
#[Layout('layouts.admin', ['pageTitle' => 'Cadastro de Aluno'])]
class Create extends Component
{
    public  $dadosAluno = [
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

    public  $dadosCriterio = [
        'area_de_abrangencia' => false,
        'mobilidade' => false,
        'irmao' => false,
        'vulnerabilidade' => false,
        'necessidade_especial' => false,
        'matriculado' => false,
    ];
    public $status  = "";

    public function mount(): void
    {
        $this->status = "Aguardando";
    }

    public function getVagasProperty()
    {
        $aux = Vaga::where('escola_id', 1)->with('escola')
            ->orderBy('escola_id')
            ->get()
            ->map(fn (Vaga $vaga) => [
                'id' => $vaga->id,
                'escola' => $vaga->escola->nome,
                'label' => "{$vaga->serie} ({$vaga->qtd} " . ($vaga->qtd === 1 ? 'vaga' : 'vagas') . ')',
            ]);
            
        
        return $aux;
    }

    protected function rules(): array
    {
        return [
            'dadosAluno.vaga_id' => 'required|exists:vagas,id',
            'dadosAluno.nome' => 'required|string|max:255',
            'dadosAluno.ra' => 'nullable|string|max:255',
            'dadosAluno.cpf' => 'required|string|min:11|max:11|unique:alunos,cpf,',
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

    protected function messages(): array
    {
        return [
            'dadosAluno.vaga_id.required' => 'Selecione a escola e a série pretendidas.',
            'dadosAluno.vaga_id.exists' => 'A vaga selecionada não é válida.',
            'dadosAluno.cpf.unique' => 'Já existe um aluno cadastrado com este CPF.',
            'dadosAluno.data_nascimento.before' => 'Informe uma data de nascimento válida.',
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
        $aluno = Aluno::create([
            ...$this->dadosAluno,
            'escola_id' => $vaga->escola_id,
         ]);
        $this->adicionarLista($aluno['id']);
        
        session()->flash('success',
            "{$aluno->nome} foi cadastrado(a) com sucesso!"
            );

        return redirect()->route('v1.alunos.index');
    }

    public function adicionarLista($id) {
        $aluno = Aluno::where('id', $id)->with('criterios')->first()->toArray();
        
        $posicao = ListaEspera::where('vaga_id', $aluno['vaga_id'])
        ->orderByDesc('posicao')
        ->first()?->toArray()['posicao'] ?? 0;
        
        $posicao = (int)$posicao + 1;
        $pontuacao = $this->pontuarCriterios($aluno['criterios']);
        $cadastrar = ["aluno_id" => $aluno['id'],
        'escola_id' => $aluno['escola_id'],
         'vaga_id' => $aluno['vaga_id'], 
         'posicao' => $posicao,
         'pontuacao' => $pontuacao,
         'status' => $this->status,
    ];

        $lista = ListaEspera::create($cadastrar);
        
        
        $this->classificar($aluno['vaga_id']);
    }

    public function pontuarCriterios($criterios) {
        $pontos = 0;

        $pontos += $criterios['area_de_abrangencia'] ?? false ? 5 : 0;
        $pontos += $criterios['mobilidade'] ?? false ? 4 : 0;
        $pontos += $criterios['irmao'] ?? false ? 3 : 0;
        $pontos += $criterios['vulnerabilidade'] ?? false ? 2 : 0;
        $pontos += $criterios['matriculado'] ?? false ? 1 : 0;

        return $pontos;
    }
    public function classificar($vagaId){
        $lista = ListaEspera::where('vaga_id', $vagaId)
        ->orderByDesc('pontuacao')
        ->orderBy('created_at')
        ->get();

        $posicao = 1;

        foreach ($lista as $item) {
            $item->posicao = $posicao;
            $item->save();
            $posicao++;
        }
    }
    
    public function render()
    {
        
        return view('livewire.aluno.create', [
            'vagas' => $this->vagas,
        ]);
    }
}
