<x-guest-layout>
    <div class="max-w-4xl mx-auto p-6">

        <h2 class="text-2xl font-bold mb-6">Cadastro de Aluno</h2>

        @if (session()->has('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form wire:submit.prevent="salvar()" class="space-y-4">

            {{-- DADOS DO ALUNO --}}
            <div class="grid grid-cols-2 gap-4">

                <input wire:model="dadosAluno.nome" placeholder="Nome" class="input">
                <input wire:model="dadosAluno.ra" placeholder="RA" class="input">
                <input wire:model="dadosAluno.cpf" placeholder="CPF" class="input">

                <select wire:model="dadosAluno.sexo" class="input">
                    <option value="">Sexo</option>
                    <option value="M">Masculino</option>
                    <option value="F">Feminino</option>
                </select>

                <input type="date" wire:model="dadosAluno.data_nascimento" class="input">

                <input wire:model="dadosAluno.nome_responsavel" placeholder="Responsável" class="input">
                <input wire:model="dadosAluno.cpf_responsavel" placeholder="CPF Responsável" class="input">

                <input wire:model="dadosAluno.telefone_pessoal" placeholder="Telefone" class="input">

                <input wire:model="dadosAluno.cep" placeholder="CEP" class="input">
                <input wire:model="dadosAluno.bairro" placeholder="Bairro" class="input">
                <input wire:model="dadosAluno.logradouro" placeholder="Logradouro" class="input">
                <input wire:model="dadosAluno.numero" placeholder="Número" class="input">

                <input wire:model="dadosAluno.serie" placeholder="Série" class="input">
                <input wire:model="dadosAluno.tipo_vaga" placeholder="Tipo Vaga" class="input">

            </div>



            {{-- CRITÉRIOS --}}
            <div class="mt-4 space-y-2">

                <label><input type="checkbox" wire:model="dadosCriterio.area_de_abrangencia"> Área de abrangência</label>
                <label><input type="checkbox" wire:model="dadosCriterio.mobilidade"> Mobilidade</label>
                <label><input type="checkbox" wire:model="dadosCriterio.irmao"> Irmão na escola</label>
                <label><input type="checkbox" wire:model="dadosCriterio.vulnerabilidade"> Vulnerabilidade</label>
                <label><input type="checkbox" wire:model="dadosCriterio.necessidade_especial"> Necessidade especial</label>
                <label><input type="checkbox" wire:model="dadosCriterio.matriculado"> Já matriculado</label>

            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded mt-4">
                Salvar
            </button>

        </form>
    </div>
</x-guest-layout>