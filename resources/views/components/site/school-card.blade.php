@props(['escola'])

<div class="rounded-2xl border border-seduc-neutral-200 bg-background-surface p-5 shadow-[0_6px_20px_-4px_rgba(11,33,46,0.10)]">
    <div class="flex items-start justify-between gap-3">
        <div>
            <p class="font-heading text-base font-semibold text-text-on-surface">{{ $escola['nome'] }}</p>
            <p class="mt-0.5 font-body text-sm text-seduc-neutral-600">{{ $escola['bairro'] }} · {{ $escola['nivel'] }}</p>
        </div>

        @if ($escola['vagas'] > 0)
            <x-site.badge variant="success">{{ $escola['vagas'] }} {{ $escola['vagas'] === 1 ? 'vaga' : 'vagas' }}</x-site.badge>
        @else
            <x-site.badge variant="danger">Sem vagas</x-site.badge>
        @endif
    </div>

    <div class="mt-4 flex items-center gap-4 border-t border-seduc-neutral-100 pt-3 font-body text-xs text-seduc-neutral-600">
        <span class="flex items-center gap-1.5">
            <svg class="size-4 text-teal-dark-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21c-4.5-4.2-7.5-7.7-7.5-11.2A7.5 7.5 0 0 1 12 2.3a7.5 7.5 0 0 1 7.5 7.5C19.5 13.3 16.5 16.8 12 21Z"/><circle cx="12" cy="9.8" r="2.5"/></svg>
            {{ $escola['endereco'] }}
        </span>
    </div>

    <div class="mt-2 font-body text-xs text-seduc-neutral-600">
        Lista de espera: <span class="font-semibold text-text-on-surface">{{ $escola['lista_espera'] }}</span>
    </div>
</div>
