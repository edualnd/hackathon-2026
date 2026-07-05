<div class="flex justify-center items-center p-8">
    <div
        class="p-5 mt-6 overflow-hidden rounded-2xl border border-seduc-neutral-200 bg-background-surface"
    >
        <div class="mb-8 flex flex-wrap items-start justify-between gap-4">
            <div>
                <p class="font-body text-[11px] font-semibold uppercase tracking-wide text-seduc-neutral-500">Painel administrativo</p>

                <h1 class="font-heading text-3xl font-bold text-text-on-surface">
                    Lista de Espera
                </h1>

                <p class="mt-2 font-body text-sm text-seduc-neutral-600">Consulte a classificação dos estudantes para esta vaga.</p>
            </div>

            <div class="flex gap-3">
                <x-site.button variant="secondary">
                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15V3m0 12l4-4m-4 4l-4-4M5 21h14" />
                    </svg>

                    Exportar PDF
                </x-site.button>

                <x-site.button variant="primary">
                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 4h16v16H4z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 8h8M8 12h8M8 16h8" />
                    </svg>

                    Exportar Excel
                </x-site.button>
            </div>
        </div>

        <div class="mb-6 rounded-2xl border border-seduc-neutral-200 bg-background-surface p-6">
            <div class="grid gap-6 sm:grid-cols-3">
                <div>
                    <p class="font-body text-xs uppercase tracking-wide text-seduc-neutral-500">Escola</p>

                    <p class="mt-1 font-heading text-lg font-semibold text-text-on-surface">
                        {{ $vaga->escola->nome }}
                    </p>
                </div>

                <div>
                    <p class="font-body text-xs uppercase tracking-wide text-seduc-neutral-500">Série</p>

                    <x-site.badge variant="neutral" class="mt-2"> {{ $vaga->serie }} </x-site.badge>
                </div>

                <div>
                    <p class="font-body text-xs uppercase tracking-wide text-seduc-neutral-500">Total de vagas</p>

                    <p class="mt-1 font-heading text-2xl font-bold text-teal-dark-600">
                        {{ $vaga->qtd }}
                    </p>
                </div>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left rounded-2xl border border-seduc-neutral-200">
                <thead>
                    <tr class="border-b border-seduc-neutral-200 bg-seduc-neutral-100/60">
                        <th
                            class="px-5 py-3 font-body text-[11px] font-semibold uppercase tracking-wide text-seduc-neutral-600"
                        >
                            Posição
                        </th>

                        <th
                            class="px-5 py-3 font-body text-[11px] font-semibold uppercase tracking-wide text-seduc-neutral-600"
                        >
                            Nome do aluno
                        </th>

                        <th
                            class="px-5 py-3 font-body text-[11px] font-semibold uppercase tracking-wide text-seduc-neutral-600"
                        >
                            Situação
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-seduc-neutral-100">
                    @forelse ($listaEspera as $item)
                        <tr class="hover:bg-seduc-neutral-100/40">
                            <td class="px-5 py-4">
                                <x-site.badge variant="neutral">
                                    {{ $item->posicao == 0 ? '-':  $item->posicao}}
                                </x-site.badge>
                            </td>

                            <td class="px-5 py-4">
                                <p class="font-body text-sm font-semibold text-text-on-surface">
                                    {{ $item->aluno->nome }}
                                </p>
                            </td>

                            <td class="px-5 py-4">
                                @php
                                $variant = match($item->status) {
                                    'Matriculado' => 'success',
                                    'Aguardando' => 'warning',
                                    'Foi chamado' => 'info',
                                    'Desistencia' => 'danger',
                                    default => 'neutral',
                                };
                            @endphp

                                <x-site.badge :variant="$variant">
                                    {{ $item->status }}
                                </x-site.badge>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-5 py-12 text-center">
                                <p class="font-heading text-base font-semibold text-text-on-surface">Nenhum aluno na lista de espera</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
