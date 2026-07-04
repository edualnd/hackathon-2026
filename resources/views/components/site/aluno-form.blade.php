@props(['vagas', 'showStatus' => false])

<form wire:submit.prevent="salvar" class="space-y-6">

    {{-- ESTUDANTE --}}
    <div class="rounded-2xl border border-seduc-neutral-200 bg-background-surface p-6">
        <div class="mb-5 flex items-center gap-2">
            <span class="h-5 w-1 rounded-full bg-teal-dark-500"></span>
            <div>
                <p class="font-body text-[11px] font-semibold uppercase tracking-wide text-seduc-neutral-500">Estudante</p>
                <p class="font-heading text-base font-semibold text-text-on-surface">Identificação inicial</p>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
            <div class="lg:col-span-2">
                <x-site.input label="Nome completo" name="nome" wire:model="dadosAluno.nome" placeholder="Nome do estudante" :error="$errors->first('dadosAluno.nome')" />
            </div>
            <x-site.input label="RA (com dígito)" name="ra" wire:model="dadosAluno.ra" placeholder="999.999.999-9" :error="$errors->first('dadosAluno.ra')" />

            <x-site.input label="CPF" name="cpf" wire:model="dadosAluno.cpf" placeholder="999.999.999-99" :error="$errors->first('dadosAluno.cpf')" />
            <x-site.select label="Sexo" name="sexo" wire:model="dadosAluno.sexo">
                <option value="">Selecione...</option>
                <option value="M">Masculino</option>
                <option value="F">Feminino</option>
            </x-site.select>
            <x-site.input label="Data de nascimento" name="data_nascimento" type="date" wire:model="dadosAluno.data_nascimento" :error="$errors->first('dadosAluno.data_nascimento')" />

            <div class="lg:col-span-2">
                <x-site.input label="Número da certidão de nascimento" name="certidao_nascimento" wire:model="dadosAluno.certidao_nascimento" placeholder="000000.00.0000.0.00000.000.0000000" :error="$errors->first('dadosAluno.certidao_nascimento')" />
            </div>
            <x-site.select label="Escola / série pretendida" name="vaga_id" wire:model="dadosAluno.vaga_id">
                <option value="">Selecione...</option>
                @foreach ($vagas as $vaga)
                    <option value="{{ $vaga['id'] }}">{{ $vaga['label'] }}</option>
                @endforeach
            </x-site.select>
            @error('dadosAluno.vaga_id') <p class="-mt-3 font-body text-xs text-text-on-danger">{{ $message }}</p> @enderror

            @if ($showStatus)
                <x-site.select label="Situação do cadastro" name="status" wire:model="status">
                    @foreach (\App\Models\Aluno::STATUSES as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </x-site.select>
            @endif
        </div>
    </div>

    {{-- RESPONSÁVEL --}}
    <div class="rounded-2xl border border-seduc-neutral-200 bg-background-surface p-6">
        <div class="mb-5 flex items-center gap-2">
            <span class="h-5 w-1 rounded-full bg-amber-500"></span>
            <div>
                <p class="font-body text-[11px] font-semibold uppercase tracking-wide text-seduc-neutral-500">Responsável</p>
                <p class="font-heading text-base font-semibold text-text-on-surface">Contato e parentesco</p>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
            <x-site.input label="Nome do responsável" name="nome_responsavel" wire:model="dadosAluno.nome_responsavel" placeholder="Nome completo" :error="$errors->first('dadosAluno.nome_responsavel')" />
            <x-site.input label="CPF do responsável" name="cpf_responsavel" wire:model="dadosAluno.cpf_responsavel" placeholder="999.999.999-99" :error="$errors->first('dadosAluno.cpf_responsavel')" />
            <x-site.input label="Parentesco" name="parentesco" wire:model="dadosAluno.parentesco" placeholder="Mãe, pai, avó..." :error="$errors->first('dadosAluno.parentesco')" />
            <x-site.input label="Telefone pessoal" name="telefone_pessoal" wire:model="dadosAluno.telefone_pessoal" placeholder="(00) 00000-0000" :error="$errors->first('dadosAluno.telefone_pessoal')" />
            <x-site.input label="Telefone para recado" name="telefone_recado" wire:model="dadosAluno.telefone_recado" placeholder="(00) 00000-0000" />
        </div>
    </div>

    {{-- ENDEREÇO --}}
    <div class="rounded-2xl border border-seduc-neutral-200 bg-background-surface p-6">
        <div class="mb-5 flex items-center gap-2">
            <span class="h-5 w-1 rounded-full bg-lime-500"></span>
            <div>
                <p class="font-body text-[11px] font-semibold uppercase tracking-wide text-seduc-neutral-500">Endereço</p>
                <p class="font-heading text-base font-semibold text-text-on-surface">Residência do estudante</p>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-6">
            <x-site.input label="CEP" name="cep" wire:model="dadosAluno.cep" placeholder="00000-000" :error="$errors->first('dadosAluno.cep')" />
            <x-site.input label="UF" name="uf" wire:model="dadosAluno.uf" maxlength="2" :error="$errors->first('dadosAluno.uf')" />
            <div class="col-span-2">
                <x-site.input label="Município" name="municipio" wire:model="dadosAluno.municipio" :error="$errors->first('dadosAluno.municipio')" />
            </div>
            <div class="col-span-2">
                <x-site.input label="Bairro" name="bairro" wire:model="dadosAluno.bairro" :error="$errors->first('dadosAluno.bairro')" />
            </div>
            <div class="col-span-2 sm:col-span-2 lg:col-span-4">
                <x-site.input label="Logradouro" name="logradouro" wire:model="dadosAluno.logradouro" :error="$errors->first('dadosAluno.logradouro')" />
            </div>
            <x-site.input label="Nº" name="numero" wire:model="dadosAluno.numero" />
        </div>
    </div>

    {{-- CRITÉRIOS --}}
    <div class="rounded-2xl border border-seduc-neutral-200 bg-background-surface p-6">
        <div class="mb-5 flex items-center gap-2">
            <span class="h-5 w-1 rounded-full bg-teal-light-500"></span>
            <div>
                <p class="font-body text-[11px] font-semibold uppercase tracking-wide text-seduc-neutral-500">Critérios</p>
                <p class="font-heading text-base font-semibold text-text-on-surface">Condições para classificação</p>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
            @foreach ([
                'area_de_abrangencia' => 'Unidade de inscrição é mais próxima da residência?',
                'matriculado' => 'Já está matriculado em outra escola da rede?',
                'necessidade_especial' => 'Possui necessidade educacional especial?',
                'mobilidade' => 'Apresenta deficiência que compromete a mobilidade?',
                'vulnerabilidade' => 'Apresenta questão de vulnerabilidade social?',
                'irmao' => 'Possui irmão(s) matriculado(s) na mesma escola?',
            ] as $campo => $pergunta)
                <label class="flex cursor-pointer items-start gap-3 rounded-xl border border-seduc-neutral-200 p-4 hover:border-teal-dark-400">
                    <input type="checkbox" wire:model="dadosCriterio.{{ $campo }}" class="mt-0.5 size-4 rounded border-seduc-neutral-400 text-teal-dark-600 focus:ring-teal-dark-400">
                    <span class="font-body text-sm text-text-on-surface">{{ $pergunta }}</span>
                </label>
            @endforeach
        </div>
    </div>

    {{-- OBSERVAÇÃO --}}
    <div class="rounded-2xl border border-seduc-neutral-200 bg-background-surface p-6">
        <label for="observacao" class="mb-1.5 block font-body text-sm font-medium text-text-on-surface">Observações (opcional)</label>
        <textarea id="observacao" wire:model="dadosAluno.observacao" rows="3" placeholder="Alguma informação adicional relevante para a análise..."
            class="w-full rounded-xl border border-seduc-neutral-300 bg-background-surface px-4 py-3 font-body text-sm text-text-on-surface placeholder:text-seduc-neutral-400 focus:outline-none focus:ring-2 focus:ring-teal-dark-400 focus:border-teal-dark-500"></textarea>
    </div>

    <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
        <x-site.button variant="ghost" href="{{ route('admin.alunos.index') }}">Cancelar</x-site.button>
        <x-site.button variant="primary" type="submit" wire:loading.attr="disabled" wire:target="salvar">
            <span wire:loading.remove wire:target="salvar">Salvar cadastro</span>
            <span wire:loading wire:target="salvar">Salvando...</span>
        </x-site.button>
    </div>
</form>
