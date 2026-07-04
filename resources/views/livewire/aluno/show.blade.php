<div class="mx-auto max-w-7xl px-6 py-8 sm:px-10">

    @if (session('success'))
        <div class="mb-5 rounded-xl bg-feedback-success px-4 py-3 font-body text-sm font-medium text-text-on-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-6 flex flex-wrap items-end justify-between gap-4">
        <div>
            <p class="font-body text-[11px] font-semibold uppercase tracking-wide text-seduc-neutral-500">Alunos</p>
            <h1 class="font-heading text-2xl font-bold text-text-on-surface">Cadastro de Estudantes</h1>
        </div>
        <x-site.button variant="primary" href="{{ route('admin.alunos.create') }}">
            <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M12 5v14m-7-7h14"/></svg>
            Novo cadastro
        </x-site.button>
    </div>

    {{-- Filtros --}}
    <div class="rounded-2xl border border-seduc-neutral-200 bg-background-surface p-5">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <div class="lg:col-span-2">
                <x-site.input label="Buscar estudante" name="busca" wire:model.live.debounce.400ms="busca" placeholder="Buscar por nome, RA ou certidão" />
            </div>
            <x-site.select label="Situação do cadastro" name="statusFiltro" wire:model.live="statusFiltro" :options="$statuses" />
            <x-site.select label="Escola" name="escolaFiltro" wire:model.live="escolaFiltro" :options="$escolas->pluck('nome', 'id')->all()" />
        </div>

        @if ($busca || $statusFiltro || $escolaFiltro)
            <button wire:click="limparFiltros" type="button" class="mt-4 font-body text-xs font-semibold text-teal-dark-600 hover:text-teal-dark-700">
                Limpar filtros
            </button>
        @endif
    </div>

    {{-- Tabela --}}
    <div class="mt-6 overflow-hidden rounded-2xl border border-seduc-neutral-200 bg-background-surface">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-seduc-neutral-200 bg-seduc-neutral-100/60">
                        <th class="px-5 py-3 font-body text-[11px] font-semibold uppercase tracking-wide text-seduc-neutral-600">Nome do estudante</th>
                        <th class="px-5 py-3 font-body text-[11px] font-semibold uppercase tracking-wide text-seduc-neutral-600">Contato</th>
                        <th class="px-5 py-3 font-body text-[11px] font-semibold uppercase tracking-wide text-seduc-neutral-600">Escola de opção</th>
                        <th class="px-5 py-3 font-body text-[11px] font-semibold uppercase tracking-wide text-seduc-neutral-600">Série</th>
                        <th class="px-5 py-3 font-body text-[11px] font-semibold uppercase tracking-wide text-seduc-neutral-600">Situação</th>
                        <th class="px-5 py-3 font-body text-[11px] font-semibold uppercase tracking-wide text-seduc-neutral-600 text-right">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-seduc-neutral-100">
                    @forelse ($alunos as $aluno)
                        <tr wire:key="aluno-{{ $aluno->id }}" class="hover:bg-seduc-neutral-100/40">
                            <td class="px-5 py-4">
                                <p class="font-body text-sm font-semibold text-text-on-surface">{{ $aluno->nome }}</p>
                                <p class="font-data text-xs text-seduc-neutral-500">RA: {{ $aluno->ra ?? '—' }}</p>
                            </td>
                            <td class="px-5 py-4 font-body text-sm text-seduc-neutral-600">{{ $aluno->telefone_pessoal }}</td>
                            <td class="px-5 py-4 font-body text-sm text-seduc-neutral-600">{{ $aluno->escola?->nome ?? '—' }}</td>
                            <td class="px-5 py-4">
                                <x-site.badge variant="neutral">{{ $aluno->vaga?->serie ?? '—' }}</x-site.badge>
                            </td>
                            <td class="px-5 py-4">
                                @php
                                    $variant = match($aluno->status) {
                                        \App\Models\Aluno::STATUS_VAGA_CONSEGUIDA => 'success',
                                        \App\Models\Aluno::STATUS_DESISTENCIA => 'neutral',
                                        default => 'warning',
                                    };
                                @endphp
                                <x-site.badge :variant="$variant">{{ $aluno->statusLabel() }}</x-site.badge>
                                <p class="mt-1 font-body text-[11px] text-seduc-neutral-500">{{ $aluno->updated_at->format('d/m/Y H:i') }}</p>
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.alunos.edit', $aluno) }}" class="flex size-8 items-center justify-center rounded-lg border border-seduc-neutral-200 text-seduc-neutral-600 hover:border-teal-dark-400 hover:text-teal-dark-600" title="Editar">
                                        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 4H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-5M18.5 2.5a2.1 2.1 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5Z"/></svg>
                                    </a>
                                    <button wire:click="excluir({{ $aluno->id }})" wire:confirm="Remover o cadastro de {{ $aluno->nome }}? Esta ação não pode ser desfeita."
                                        class="flex size-8 items-center justify-center rounded-lg border border-seduc-neutral-200 text-seduc-neutral-600 hover:border-feedback-danger hover:text-text-on-danger" title="Excluir">
                                        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M9 7V4h6v3m-8 0 1 13a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2l1-13"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-12 text-center">
                                <p class="font-heading text-base font-semibold text-text-on-surface">Nenhum aluno encontrado</p>
                                <p class="mt-1 font-body text-sm text-seduc-neutral-600">Ajuste os filtros ou cadastre um novo aluno.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($alunos->total() > 0)
            <div class="flex flex-col gap-3 border-t border-seduc-neutral-200 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">
                <p class="font-body text-xs text-seduc-neutral-600">
                    Mostrando {{ $alunos->firstItem() }} até {{ $alunos->lastItem() }} de {{ $alunos->total() }} resultados
                </p>
                <div class="flex items-center gap-4">
                    <select wire:model.live="perPage" class="rounded-lg border border-seduc-neutral-300 bg-background-surface px-2.5 py-1.5 font-body text-xs text-text-on-surface">
                        <option value="5">5 por página</option>
                        <option value="10">10 por página</option>
                        <option value="25">25 por página</option>
                    </select>
                    <div class="font-body text-xs [&_.pagination]:flex [&_.pagination]:gap-1">
                        {{ $alunos->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
