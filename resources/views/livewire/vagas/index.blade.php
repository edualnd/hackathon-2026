<div class="mx-auto max-w-7xl px-6 py-8 sm:px-10">
    @if ($successMessage)
        <div
            class="mb-5 rounded-xl bg-feedback-success px-4 py-3 font-body text-sm font-medium text-text-on-success"
        >
            {{ $successMessage }}
        </div>
    @endif

    <div class="mb-6 flex flex-wrap items-end justify-between gap-4">
        <div>
            <p class="font-body text-[11px] font-semibold uppercase tracking-wide text-seduc-neutral-500">Painel administrativo</p>
            <h1 class="font-heading text-2xl font-bold text-text-on-surface">Vagas por Escola</h1>
        </div>
        @if (!Auth::user()->escola_id)
            <x-site.button
                variant="primary"
                type="button"
                wire:click="$dispatch('dispatchOpenModalCreateVaga')"
            >
                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M12 5v14m-7-7h14" /></svg>
                Nova vaga
            </x-site.button>
        @endif
    </div>

    {{-- Filtros --}}
    <div class="rounded-2xl border border-seduc-neutral-200 bg-background-surface p-5">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
            <div class="lg:col-span-2">
                <x-site.input
                    label="Buscar por série"
                    name="busca"
                    wire:model.live.debounce.400ms="busca"
                    placeholder="Ex.: 5º Ano, M1..."
                />
            </div>

            <x-site.select
                label="Escola"
                name="escolaFiltro"
                wire:model.live="escolaFiltro"
                :options="$escolas"
            />
        </div>

        @if ($busca || $escolaFiltro)
            <button
                wire:click="limparFiltros"
                type="button"
                class="mt-4 font-body text-xs font-semibold text-teal-dark-600 hover:text-teal-dark-700"
            >
                Limpar filtros
            </button>
        @endif
    </div>

    {{-- Tabela --}}
    <div
        class="mt-6 overflow-hidden rounded-2xl border border-seduc-neutral-200 bg-background-surface"
    >
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-seduc-neutral-200 bg-seduc-neutral-100/60">
                        <th
                            class="px-5 py-3 font-body text-[11px] font-semibold uppercase tracking-wide text-seduc-neutral-600"
                        >
                            Escola
                        </th>
                        <th
                            class="px-5 py-3 font-body text-[11px] font-semibold uppercase tracking-wide text-seduc-neutral-600"
                        >
                            Série
                        </th>
                        <th
                            class="px-5 py-3 font-body text-[11px] font-semibold uppercase tracking-wide text-seduc-neutral-600"
                        >
                            Vagas totais
                        </th>
                        <th
                            class="px-5 py-3 font-body text-[11px] font-semibold uppercase tracking-wide text-seduc-neutral-600"
                        >
                            Matriculados
                        </th>
                        <th
                            class="px-5 py-3 font-body text-[11px] font-semibold uppercase tracking-wide text-seduc-neutral-600"
                        >
                            Disponibilidade
                        </th>
                        @if (!Auth::user()->escola_id)
                            <th
                                class="px-5 py-3 font-body text-[11px] font-semibold uppercase tracking-wide text-seduc-neutral-600 text-right"
                            >
                                Ações
                            </th>
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-seduc-neutral-100">
                    @forelse ($vagas as $vaga)
                        <tr
                            wire:key="vaga-{{ $vaga->id }}"
                            class="hover:bg-seduc-neutral-100/60 hover:cursor-pointer"
                        >
                            <td
                                class="px-5 py-4 font-body text-sm font-semibold text-text-on-surface hover:cursor-pointer"
                            >
                                <a
                                    href="{{ route('vagas.lista', $vaga->id) }}"
                                    class="hover:text-blue-500"
                                >
                                    > {{ $vaga->escola?->nome ?? '—' }}
                                </a>
                            </td>
                            <td class="px-5 py-4">
                                <x-site.badge variant="neutral">{{ $vaga->serie }}</x-site.badge>
                            </td>
                            <td class="px-5 py-4 font-data text-sm text-text-on-surface">
                                {{ $vaga->qtd }}
                            </td>
                            <td class="px-5 py-4 font-data text-sm text-seduc-neutral-600">
                                {{ $vaga->matriculados_count ?? 0 }}
                            </td>
                            <td class="px-5 py-4">
                                @php $disponiveis = max($vaga->qtd - ($vaga->matriculados_count ?? 0), 0); @endphp
                                @if ($disponiveis > 0)
                                    <x-site.badge variant="success">
                                        {{ $disponiveis }} {{ $disponiveis === 1 ? 'vaga livre' : 'vagas livres' }}</x-site.badge
                                    >
                                @else
                                    <x-site.badge variant="danger">Sem vagas</x-site.badge>
                                @endif
                            </td>
                            @if (!Auth::user()->escola_id)
                                <td class="px-5 py-4">
                                    <div class="flex justify-end gap-2">
                                        <button
                                            type="button"
                                            wire:click="$dispatch('dispatchOpenModalEditVaga', { id: {{ $vaga->id }} })"
                                            class="flex size-8 items-center justify-center rounded-lg border border-seduc-neutral-200 text-seduc-neutral-600 hover:border-teal-dark-400 hover:text-teal-dark-600"
                                            title="Editar"
                                        >
                                            <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 4H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-5M18.5 2.5a2.1 2.1 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5Z" /></svg>
                                        </button>
                                        <button
                                            wire:click="excluir({{ $vaga->id }})"
                                            wire:confirm="Remover a vaga de {{ $vaga->serie }} em {{ $vaga->escola?->nome }}? Esta ação não pode ser desfeita."
                                            class="flex size-8 items-center justify-center rounded-lg border border-seduc-neutral-200 text-seduc-neutral-600 hover:border-feedback-danger hover:text-text-on-danger"
                                            title="Excluir"
                                        >
                                            <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M9 7V4h6v3m-8 0 1 13a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2l1-13" /></svg>
                                        </button>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-12 text-center">
                                <p class="font-heading text-base font-semibold text-text-on-surface">Nenhuma vaga cadastrada</p>
                                <p class="mt-1 font-body text-sm text-seduc-neutral-600">Ajuste os filtros ou cadastre uma nova vaga.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($vagas->total() > 0)
            <div
                class="flex flex-col gap-3 border-t border-seduc-neutral-200 px-5 py-4 sm:flex-row sm:items-center sm:justify-between"
            >
                <p class="font-body text-xs text-seduc-neutral-600">Mostrando {{ $vagas->firstItem() }} até {{ $vagas->lastItem() }} de {{ $vagas->total() }} resultados</p>
                <div class="font-body text-xs [&_.pagination]:flex [&_.pagination]:gap-1">
                    {{ $vagas->links() }}
                </div>
            </div>
        @endif
    </div>

    <livewire:vagas.create />
    <livewire:vagas.edit />
</div>
