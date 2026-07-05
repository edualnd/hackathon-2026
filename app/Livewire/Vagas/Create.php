<?php

namespace App\Livewire\Vagas;

use App\Models\Escola;
use App\Models\Vaga;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

/**
 * Modal de cadastro de vaga, aberto a partir do Vagas\Index
 * via evento "dispatchOpenModalCreateVaga".
 */
class Create extends Component
{
    public bool $show = false;

    public array $vaga = [
        'escola_id' => '',
        'qtd' => 0,
        'serie' => '',
    ];

    public array $series = [
        '1º Ano', '2º Ano', '3º Ano', '4º Ano', '5º Ano',
        '6º Ano', '7º Ano', '8º Ano', '9º Ano',
        'B1', 'B2', 'M1', 'M2',
    ];

    public $escola = [
        ['id' => "",
        'nome' => " ",]
    ];

    #[On('dispatchOpenModalCreateVaga')]
    public function abrir(): void
    {
        $this->resetValidation();
        $this->reset('vaga');
        $escola = Auth::user()->escola_id;;
        $this->escola = Escola::select('id', 'nome')->get()->toArray();
        $this->vaga =  [
            'escola_id' => $escola,
            'qtd' => 0,
            'serie' => '',
        ];
        $this->show = true;
    }

    protected function rules(): array
    {
        return [
            'vaga.escola_id' => 'required|exists:escolas,id',
            'vaga.serie' => 'required|string|max:255',
            'vaga.qtd' => 'required|integer|min:0',
        ];
    }

    protected function messages(): array
    {
        return [
            'vaga.escola_id.required' => 'Selecione a escola.',
            'vaga.serie.required' => 'Selecione a série.',
            'vaga.qtd.required' => 'Informe a quantidade de vagas.',
        ];
    }

    public function salvar(): void
    {
        $this->validate();

        Vaga::create($this->vaga);

        $this->show = false;
        $this->dispatch('vagaSalva', mensagem: 'Vaga cadastrada com sucesso.');
    }

    public function render()
    {
        return view('livewire.vagas.create');
    }
}
