<div
    @class ([
        'hidden' => $vaga['id'] == 0,
    ])
>
    <div
        class="overflow-hidden rounded-2xl border border-seduc-neutral-200 bg-background-surface"
    >
        {{-- Cabeçalho --}}
        <div class="border-b border-seduc-neutral-200 bg-seduc-neutral-100/50 px-5 py-6 sm:px-8">
            <div class="flex items-start gap-3">
                <span class="mt-0.5 flex size-9 shrink-0 items-center justify-center rounded-xl bg-action-secondary">
                    <svg class="size-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" />
                    </svg>
                </span>
                <div>
                    <h1 class="font-heading text-2xl font-bold text-text-on-surface sm:text-3xl">
                        Lista de Espera
                    </h1>
                    <p class="mt-1 font-body text-sm text-seduc-neutral-600">Consulte a classificação dos estudantes para esta vaga.</p>
                </div>
            </div>

            <div class="mt-6 grid grid-cols-2 gap-4 sm:grid-cols-3">
                <div class="rounded-xl bg-background-surface px-4 py-3 sm:col-span-1">
                    <p class="font-body text-[11px] font-semibold uppercase tracking-wide text-seduc-neutral-500">Escola</p>
                    <p class="mt-1 font-heading text-base font-semibold leading-snug text-text-on-surface">
                        {{ $vaga['escola']['nome'] }}
                    </p>
                </div>

                <div class="rounded-xl bg-background-surface px-4 py-3">
                    <p class="font-body text-[11px] font-semibold uppercase tracking-wide text-seduc-neutral-500">Série</p>
                    <x-site.badge variant="neutral" class="mt-2">
                        {{ $vaga['serie'] }}
                    </x-site.badge>
                </div>

                <div class="flex flex-inline gap-4 items-center rounded-xl bg-background-surface px-4 py-3 sm:col-span-1">
                    <p class="font-body text-[11px] font-semibold uppercase tracking-wide text-seduc-neutral-500">Total de vagas</p>
                    <p class="mt-1 font-heading text-2xl font-bold text-teal-dark-600">
                        {{ $vaga['qtd'] }}
                    </p>
                </div>
            </div>
        </div>

        {{-- Tabela --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-seduc-neutral-200 bg-seduc-neutral-100/60">
                        <th class="px-5 py-3 font-body text-[11px] font-semibold uppercase tracking-wide text-seduc-neutral-600">
                            Posição
                        </th>
                        <th class="px-5 py-3 font-body text-[11px] font-semibold uppercase tracking-wide text-seduc-neutral-600">
                            Nome do aluno
                        </th>
                        <th class="hidden px-5 py-3 font-body text-[11px] font-semibold uppercase tracking-wide text-seduc-neutral-600 sm:table-cell">
                            Nome do responsável
                        </th>
                        <th class="px-5 py-3 font-body text-[11px] font-semibold uppercase tracking-wide text-seduc-neutral-600">
                            Situação
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-seduc-neutral-100">
                    @forelse ($listaEspera as $item)
                        <tr class="odd:bg-background-surface even:bg-seduc-neutral-100/30 hover:bg-teal-light-100/40">
                            <td class="px-5 py-4">
                                @if ($item->posicao == 0)
                                    <x-site.badge variant="neutral">—</x-site.badge>
                                @elseif ($item->posicao <= 3)
                                    <span class="inline-flex size-8 items-center justify-center rounded-full bg-action-secondary font-heading text-sm font-bold text-white">
                                        {{ $item->posicao }}
                                    </span>
                                @else
                                    <span class="inline-flex size-8 items-center justify-center rounded-full bg-seduc-neutral-100 font-heading text-sm font-bold text-seduc-neutral-700">
                                        {{ $item->posicao }}
                                    </span>
                                @endif
                            </td>

                            <td class="px-5 py-4">
                                <p class="font-body text-sm font-semibold text-text-on-surface">
                                    @php
                                        $nome = explode(' ', trim($item->aluno->nome));
                                        $primeiro = array_shift($nome);
                                        $iniciais = collect($nome)
                                            ->map(fn($n) => strtoupper(substr($n, 0, 1)) . '.')
                                            ->join(' ');
                                    @endphp
                                    {{ $primeiro . ($iniciais ? ' ' . $iniciais : '') }}
                                </p>
                                <p class="mt-0.5 font-body text-[11px] text-seduc-neutral-500 sm:hidden">
                                    Responsável disponível no computador
                                </p>
                            </td>

                            <td class="hidden px-5 py-4 sm:table-cell">
                                <p class="font-body text-sm font-semibold text-text-on-surface">
                                    @php
                                        $nome = explode(' ', trim($item->aluno->nome_responsavel));
                                        $primeiro = array_shift($nome);
                                        $iniciais = collect($nome)
                                            ->map(fn($n) => strtoupper(substr($n, 0, 1)) . '.')
                                            ->join(' ');
                                    @endphp
                                    {{ $primeiro . ($iniciais ? ' ' . $iniciais : '') }}
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
                            <td colspan="4" class="px-5 py-14 text-center">
                                <div class="mx-auto flex size-12 items-center justify-center rounded-full bg-seduc-neutral-100">
                                    <svg class="size-6 text-seduc-neutral-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                        <circle cx="9" cy="7" r="4" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" />
                                    </svg>
                                </div>
                                <p class="mt-3 font-heading text-base font-semibold text-text-on-surface">Nenhum aluno na lista de espera</p>
                                <p class="mt-1 font-body text-sm text-seduc-neutral-600">Ainda não há estudantes aguardando essa vaga.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
