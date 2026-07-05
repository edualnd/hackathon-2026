<div
    @class ([
        'rounded-3xl bg-neutral-100 p-6 shadow-2xl',
        'opacity-0' => $vaga['id'] == 0,
    ])
>
    <div
        class="p-5 mt-6 overflow-hidden rounded-2xl border border-seduc-neutral-200 bg-background-surface"
    >
        <div class="mb-8 flex flex-wrap items-start justify-between gap-4">
            <div>
                <h1 class="font-heading text-3xl font-bold text-text-on-surface">
                    Lista de Espera
                </h1>

                <p class="mt-2 font-body text-sm text-seduc-neutral-600">Consulte a classificação dos estudantes para esta vaga.</p>
            </div>
        </div>

        <div class="mb-6 rounded-2xl border border-seduc-neutral-200 bg-background-surface p-6">
            <div class="grid gap-6 sm:grid-cols-3">
                <div>
                    <p class="font-body text-xs uppercase tracking-wide text-seduc-neutral-500">Escola</p>

                    <p class="mt-1 font-heading text-lg font-semibold text-text-on-surface">
                        {{ $vaga['escola']['nome'] }}
                    </p>
                </div>

                <div>
                    <p class="font-body text-xs uppercase tracking-wide text-seduc-neutral-500">Série</p>

                    <x-site.badge variant="neutral" class="mt-2">
                        {{ $vaga['serie'] }}
                    </x-site.badge>
                </div>

                <div>
                    <p class="font-body text-xs uppercase tracking-wide text-seduc-neutral-500">Total de vagas</p>

                    <p class="mt-1 font-heading text-2xl font-bold text-teal-dark-600">
                        {{ $vaga['qtd'] }}
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
                            Nome do responsável
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
                                    @php
                                        $nome = explode(' ', trim($item->aluno->nome));

                                        $primeiro = array_shift($nome);

                                        $iniciais = collect($nome)
                                            ->map(fn($n) => strtoupper(substr($n, 0, 1)) . '.')
                                            ->join(' ');
                                    @endphp

                                    {{ $primeiro . ($iniciais ? ' ' . $iniciais : '') }}
                                </p>
                            </td>
                            <td class="px-5 py-4">
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
