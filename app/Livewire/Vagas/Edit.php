<?php

namespace App\Livewire\Vagas;

use App\Models\Escola;
use App\Models\Vaga;
use Livewire\Attributes\On;
use Livewire\Component;

/**
 * Modal de edição de vaga, aberto a partir do Vagas\Index
 * via evento "dispatchOpenModalEditVaga".
 */
class Edit extends Component
{
    public bool $show = false;

    public ?int $vagaId = null;

    public array $vaga = [
        'escola_id' => '',
        'qtd' => '',
        'serie' => '',
    ];

    public array $series = [
        '1º Ano', '2º Ano', '3º Ano', '4º Ano', '5º Ano',
        '6º Ano', '7º Ano', '8º Ano', '9º Ano',
        'B1', 'B2', 'M1', 'M2',
    ];

    public $escola = [];

    #[On('dispatchOpenModalEditVaga')]
    public function abrir(int $id): void
    {
        $this->resetValidation();

        $registro = Vaga::findOrFail($id);
        $this->vagaId = $registro->id;
        $this->vaga = $registro->only(['escola_id', 'qtd', 'serie']);
        $this->escola = Escola::select('nome')->where('id', $this->vagaId)->value('nome');
        dd($this->escola);



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

        Vaga::findOrFail($this->vagaId)->update($this->vaga);

        $this->show = false;
        $this->dispatch('vagaSalva', mensagem: 'Vaga atualizada com sucesso.');
    }

    public function render()
    {
        return view('livewire.vagas.edit');
    }
}
