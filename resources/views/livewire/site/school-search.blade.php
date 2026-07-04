<div class="mx-auto max-w-5xl px-4 py-6 sm:py-10">
    {{-- Cabeçalho da página --}}
    <div class="mb-6">
        <h1 class="font-heading text-2xl font-bold text-text-on-surface sm:text-3xl">Consultar Vagas Escolares</h1>
        <p class="mt-1.5 font-body text-sm text-seduc-neutral-600">
            Filtre por nível de ensino, bairro e série para encontrar unidades escolares com vagas disponíveis. Os resultados são atualizados automaticamente.
        </p>
    </div>

    {{-- Card de filtros --}}
    <div class="rounded-2xl border border-seduc-neutral-200 bg-background-surface p-5 shadow-[0_6px_20px_-4px_rgba(11,33,46,0.08)] sm:p-6">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
            <x-site.select label="Nível de ensino" name="nivel" :options="$niveis" wire:model.live="nivel" />
            <x-site.select label="Bairro" name="bairro" :options="$bairros" wire:model.live="bairro" />
            <x-site.select label="Série" name="serie" :options="$series" wire:model.live="serie" />
        </div>

        <div class="mt-5 flex justify-end">
            <x-site.button variant="ghost" wire:click="limparFiltros" type="button">
                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 6l12 12M6 18 18 6"/></svg>
                Limpar filtros
            </x-site.button>
        </div>
    </div>

    {{-- Resultados --}}
    <div
        class="mt-8 transition-opacity"
        wire:loading.class="opacity-50"
        wire:target="nivel, bairro, serie, limparFiltros"
    >
        <div class="mb-4 flex items-center justify-between">
            <p class="font-body text-sm text-seduc-neutral-600">
                <span class="font-semibold text-text-on-surface">{{ $this->resultados->count() }}</span>
                {{ $this->resultados->count() === 1 ? 'unidade encontrada' : 'unidades encontradas' }}
            </p>
            <a href="{{ route('site.map') }}" class="inline-flex items-center gap-1.5 font-body text-sm font-semibold text-teal-dark-600 hover:text-teal-dark-700">
                Ver no mapa
                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6"/></svg>
            </a>
        </div>

        @if ($this->resultados->isEmpty())
            <div class="rounded-2xl border border-dashed border-seduc-neutral-300 p-10 text-center">
                <p class="font-heading text-base font-semibold text-text-on-surface">Nenhuma unidade encontrada</p>
                <p class="mt-1 font-body text-sm text-seduc-neutral-600">Tente ajustar ou limpar os filtros selecionados.</p>
            </div>
        @else
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                @foreach ($this->resultados as $escola)
                    <x-site.school-card :escola="$escola" wire:key="escola-{{ $escola['id'] }}" />
                @endforeach
            </div>
        @endif
    </div>
</div>
