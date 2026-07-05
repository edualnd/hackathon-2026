<div>
<section class="relative -mt-6 overflow-hidden px-4 py-12 lg:py-20">

    <div class="mx-auto max-w-7xl px-4">
        {{-- =========================================
             CABEÇALHO
        ========================================== --}}
        <div class="text-center lg:text-left">

            <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3.5 py-1.5 font-body text-xs font-semibold text-text-on-canvas backdrop-blur-sm">
                <span class="size-1.5 rounded-full bg-action-primary"></span>
                Central de Vagas · SEDUC
            </span>

            <livewire:mapa 
                :escolas="$escolas" 
                :regiao="$regiao"
                :bairro="$bairro"
                :tipo="$tipo"
                :serie="$serie"
            />

            {{-- Estatísticas --}}
            <div class="mx-auto mt-10 grid max-w-md grid-cols-2 gap-4 lg:mx-0">

                <div class="rounded-2xl bg-white/10 p-5 backdrop-blur-md">
                    <p class="font-data text-3xl font-semibold text-text-on-canvas">
                        {{ $totais['total_vagas'] }}
                    </p>

                    <p class="mt-1 text-sm text-white/70">
                        vagas disponíveis
                    </p>
                </div>

                <div class="rounded-2xl bg-white/10 p-5 backdrop-blur-md">
                    <p class="font-data text-3xl font-semibold text-text-on-canvas">
                        {{ $totais['total_escolas'] }}
                    </p>

                    <p class="mt-1 text-sm text-white/70">
                        unidades escolares
                    </p>
                </div>

            </div>

        </div>
    </div>

    <div class="mx-auto mt-10 grid max-w-7xl items-start gap-12 px-4 lg:grid-cols-[1fr_380px]">

        {{-- =========================================
             COLUNA ESQUERDA — mapa (extremo oposto ao filtro)
        ========================================== --}}


        {{-- =========================================
             COLUNA DIREITA
        ========================================== --}}

        <aside class="mx-auto w-full max-w-sm lg:mx-0">

            <div
                id="filtros"
                class="rounded-3xl bg-neutral-950 p-6 shadow-2xl"
            >

                <h2 class="mb-6 text-xl font-semibold text-white">
                    Filtrar vagas
                </h2>

                <div class="space-y-4">

                    <x-site.select
                        label="Nível de ensino"
                        name="tipo"
                        :options="$tipos"
                        wire:model.live="tipo"
                    />

                    <x-site.select
                        label="Bairro"
                        name="bairro"
                        :options="$bairros"
                        wire:model.live="bairro"
                    />

                    <x-site.select
                        label="Série"
                        name="serie"
                        :options="$series"
                        wire:model.live="serie"
                    />

                </div>

                <div class="mt-6 flex justify-end">

                    <x-site.button
                        variant="ghost"
                        wire:click="limparFiltros"
                        type="button"
                    >
                        <svg
                            class="size-4"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6 6l12 12M6 18L18 6"
                            />
                        </svg>

                        Limpar filtros

                    </x-site.button>

                </div>

            </div>

            {{-- Botão de limpar filtro fica aqui, o switch lista/mapa foi pra coluna esquerda --}}

        </aside>

    </div>

</section>

{{-- RESULTADOS --}}
<div
    class="mx-auto mt-12 max-w-7xl px-4 transition-opacity"
    wire:loading.class="opacity-50"
    wire:target="tipo,bairro,serie,limparFiltros"
>
    @if (empty($escolas))
        <div class="rounded-2xl border border-dashed border-white/25 bg-white/5 p-10 text-center backdrop-blur-sm">
            <p class="font-heading text-base font-semibold text-text-on-canvas">Nenhuma unidade encontrada</p>
            <p class="mt-1 font-body text-sm text-white/70">Tente ajustar ou limpar os filtros selecionados.</p>
        </div>
    @else
        <p class="mb-4 font-body text-sm text-white/70">
            <span class="font-semibold text-text-on-canvas">{{ count($escolas) }}</span>
            {{ count($escolas) === 1 ? 'unidade encontrada' : 'unidades encontradas' }}
        </p>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($escolas as $escola)
                <x-site.school-card :escola="$escola" wire:key="escola-{{ $escola['id'] }}" />
            @endforeach
        </div>
    @endif
</div>


</div>
