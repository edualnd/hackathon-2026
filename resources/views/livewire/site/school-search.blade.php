<div>
    {{-- Hero --}}
    <section class="relative -mt-6 overflow-hidden px-4 pb-14 pt-12 sm:pb-20 sm:pt-16">


        <div class="relative mx-auto max-w-5xl">
            <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3.5 py-1.5 font-body text-xs font-semibold text-text-on-canvas">
                <span class="size-1.5 rounded-full bg-action-primary"></span>
                Central de Vagas · SEDUC
            </span>

            <h1 class="mt-4 max-w-xl font-heading text-3xl font-bold leading-tight text-text-on-canvas sm:text-4xl">
                Encontre uma vaga na rede pública
            </h1>
            <p class="mt-3 max-w-md font-body text-sm text-white/80 sm:text-base">
                Consulte disponibilidade em escolas próximas de você. Filtre por nível de ensino, bairro e série.
            </p>

            <div class="mt-6 flex flex-wrap items-center gap-3">
                <x-site.button variant="primary" href="#filtros">
                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><path stroke-linecap="round" d="m21 21-4.3-4.3"/></svg>
                    Buscar vagas
                </x-site.button>
                <x-site.button variant="inverse" :href="route('site.map')">
                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-6-3V4l6 3 6-3 6 3v13l-6-3-6 3Zm0 0V7m6 13V10"/></svg>
                    Ver no mapa
                </x-site.button>
            </div>

            {{-- Estatísticas rápidas --}}
            <div class="mt-8 grid grid-cols-2 gap-3 sm:max-w-md sm:grid-cols-2">
                <div class="rounded-2xl bg-white/10 px-4 py-3 backdrop-blur-sm">
                    {{-- <p class="font-data text-2xl font-medium text-text-on-canvas">{{ $totais['total_vagas'] }}</p> --}}
                    <p class="font-body text-xs text-white/70">vagas disponíveis</p>
                </div>
                <div class="rounded-2xl bg-white/10 px-4 py-3 backdrop-blur-sm">
                    {{-- <p class="font-data text-2xl font-medium text-text-on-canvas">{{ $totais['total_escolas'] }}</p> --}}
                    <p class="font-body text-xs text-white/70">unidades escolares</p>
                </div>
            </div>
        </div>
    </section>

    <div class="mx-auto max-w-5xl px-4 py-6 sm:py-10">
        {{-- Card de filtros --}}
        <div id="filtros" class="scroll-mt-24 rounded-2xl border border-seduc-neutral-200 bg-background-surface p-5 shadow-[0_6px_20px_-4px_rgba(11,33,46,0.08)] sm:p-6">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                <x-site.select label="Nível de ensino" name="tipo" :options="$tipos" wire:model.live="tipo" />
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

            <livewire:switch-exibicao 
                :escolas="$escolas" 
                :regiao="$regiao"
                :bairro="$bairro"
                :tipo="$tipo"
                :serie="$serie"
                />
                
          

            {{-- @if ($this->resultados->isEmpty())
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
            @endif --}}
        </div>
    </div>
</div>
