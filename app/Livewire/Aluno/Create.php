<?php

namespace App\Livewire\Aluno;

use App\Models\Aluno;
use App\Models\ListaEspera;
use Livewire\Component;

class Create extends Component
{
    public $dadosAluno = [
        'escola_id' => '2',
        'vaga_id' => "10",
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
        'tipo_vaga' => '',
        'serie' => '',
        'observacao' => '',
        'status' => '',
    ];

    public $dadosCriterio = [
        'area_de_abrangencia' => false,
        'mobilidade' => false,
        'irmao' => false,
        'vulnerabilidade' => false,
        'necessidade_especial' => false,
        'matriculado' => false,
    ];

    protected function rules()
    {
        return [
            'dadosAluno.nome' => 'required|string|max:255',
            'dadosAluno.sexo' => 'required',
            'dadosAluno.data_nascimento' => 'required|date',
            'dadosAluno.nome_responsavel' => 'required|string',
            'dadosAluno.cpf_responsavel' => 'required|string',
            'dadosAluno.telefone_pessoal' => 'required|string',
            'dadosAluno.cep' => 'required|string',
            'dadosAluno.uf' => 'required|string|size:2',
            'dadosAluno.municipio' => 'required|string',
            'dadosAluno.bairro' => 'required|string',
            'dadosAluno.logradouro' => 'required|string',
            'dadosAluno.tipo_vaga' => 'required|string',
            'dadosAluno.serie' => 'required|string',

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

        // cria aluno
        $aluno = Aluno::create($this->dadosAluno);

        // critérios
        $aluno->criterios()->create($this->dadosCriterio);

        // lista de espera

        $this->adicionarLista($aluno['id']);

        session()->flash('success', 'Aluno cadastrado com sucesso!');

        return redirect()->route('alunos.index');
    }

    public function adicionarLista($id) {
        $aluno = Aluno::where('id', $id)->with('criterios')->first()->toArray();
        
        $posicao = ListaEspera::where('vaga_id', $aluno['vaga_id'])
        ->orderByDesc('posicao')
        ->first()->toArray()['posicao'] ?? 0;
        
        $posicao = (int)$posicao + 1;

        $cadastrar = ["aluno_id" => $aluno['id'],
         'vaga_id' => $aluno['vaga_id'], 
         'posicao' => $posicao,
         'pontuacao' => 50
    ];

        $lista = ListaEspera::create($cadastrar);
        
        dd($posicao);
        //$cadastroLista = [$aluno['vaga_id'], $aluno['escola_id'],]
    }

    public function pontuarCriterios($id) {
        
    }
    public function render()
    {
        return view('livewire.aluno.create');
    }
}
