<div class="mx-auto max-w-7xl px-6 py-8 sm:px-10">
    <div class="mb-6">
        <p class="font-body text-[11px] font-semibold uppercase tracking-wide text-seduc-neutral-500">Visão geral</p>
        <h1 class="font-heading text-2xl font-bold text-text-on-surface">Dashboard Administrativo</h1>
    </div>

    {{-- Cards de indicadores --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
        <div class="rounded-2xl border border-seduc-neutral-200 bg-background-surface p-5">
            <div class="flex items-center gap-3">
                <span class="flex size-11 items-center justify-center rounded-full bg-lime-100 text-lime-700">
                    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-6-3V4l6 3 6-3 6 3v13l-6-3-6 3Zm0 0V7m6 13V10"/></svg>
                </span>
                <p class="font-body text-xs font-semibold uppercase tracking-wide text-seduc-neutral-500">Total de vagas</p>
            </div>
            <p class="mt-4 font-data text-3xl font-semibold text-text-on-surface">{{ $totalVagas }}</p>
            <p class="mt-1 font-body text-xs text-seduc-neutral-500">Capacidade somada de todas as escolas</p>
        </div>

        <div class="rounded-2xl border border-seduc-neutral-200 bg-background-surface p-5">
            <div class="flex items-center gap-3">
                <span class="flex size-11 items-center justify-center rounded-full bg-amber-100 text-amber-700">
                    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="3.2"/><path stroke-linecap="round" d="M4.5 20c1.6-3.4 4.3-5 7.5-5s5.9 1.6 7.5 5"/></svg>
                </span>
                <p class="font-body text-xs font-semibold uppercase tracking-wide text-seduc-neutral-500">Lista de espera</p>
            </div>
            <p class="mt-4 font-data text-3xl font-semibold text-text-on-surface">{{ $totalListaEspera }}</p>
            <p class="mt-1 font-body text-xs text-seduc-neutral-500">Alunos aguardando chamada</p>
        </div>


        <div class="rounded-2xl border border-seduc-neutral-200 bg-background-surface p-5">
            <div class="flex items-center gap-3">
                <span class="flex size-11 items-center justify-center rounded-full bg-feedback-info text-text-on-info">
                    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
                </span>
                <p class="font-body text-xs font-semibold uppercase tracking-wide text-seduc-neutral-500">Alunos matriculados</p>
            </div>
            <p class="mt-4 font-data text-3xl font-semibold text-text-on-surface">{{ $totalMatriculados }}</p>
            <p class="mt-1 font-body text-xs text-seduc-neutral-500">Vagas já confirmadas</p>
        </div>
    </div>

    {{-- Cadastros recentes --}}
    <div class="mt-8 rounded-2xl border border-seduc-neutral-200 bg-background-surface">
        <div class="flex items-center justify-between border-b border-seduc-neutral-200 px-6 py-4">
            <p class="font-heading text-base font-semibold text-text-on-surface">Cadastros recentes</p>
            <a href="{{ route('admin.alunos.index') }}" class="font-body text-sm font-semibold text-teal-dark-600 hover:text-teal-dark-700">Ver todos →</a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-seduc-neutral-200">
                        <th class="px-6 py-3 font-body text-[11px] font-semibold uppercase tracking-wide text-seduc-neutral-600">Nome</th>
                        <th class="px-6 py-3 font-body text-[11px] font-semibold uppercase tracking-wide text-seduc-neutral-600">Escola</th>
                        <th class="px-6 py-3 font-body text-[11px] font-semibold uppercase tracking-wide text-seduc-neutral-600">Série</th>
                        <th class="px-6 py-3 font-body text-[11px] font-semibold uppercase tracking-wide text-seduc-neutral-600">Situação</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-seduc-neutral-100">
                    @forelse ($recentes as $aluno)
                        <tr>
                            <td class="px-6 py-3.5 font-body text-sm font-medium text-text-on-surface">{{ $aluno['aluno']['nome'] }}</td>
                            <td class="px-6 py-3.5 font-body text-sm text-seduc-neutral-600">{{ $aluno['aluno']['escola']['nome']?? '—' }}</td>
                            <td class="px-6 py-3.5 font-body text-sm text-seduc-neutral-600">{{ $aluno['vaga']['serie'] ?? '—' }}</td>
                            <td class="px-6 py-3.5">
                            @php
                                $variants = [
                                    'Matriculado' => 'success',
                                    'Aguardando' => 'neutral',
                                    'Foi chamado' => 'info'
                                ];
                            @endphp

                            <x-site.badge :variant="$variants[$aluno['status']] ?? 'neutral'">
                                {{ $aluno['status'] ?? '—' }}
                            </x-site.badge>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="px-6 py-8 text-center font-body text-sm text-seduc-neutral-500">Nenhum cadastro ainda.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
