
<div class="max-w-7xl mx-auto ">

    <div class="items-center gap-12 grid lg:grid-cols-3 ">

        {{-- =========================================
             COLUNA ESQUERDA
        ========================================== --}}

        <div class="text-center lg:text-left col-span-2">

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
                        {{-- {{ $totais['total_vagas'] }} --}}
                    </p>

                    <p class="mt-1 text-sm text-white/70">
                        vagas disponíveis
                    </p>
                </div>

                <div class="rounded-2xl bg-white/10 p-5 backdrop-blur-md">
                    <p class="font-data text-3xl font-semibold text-text-on-canvas">
                        {{-- {{ $totais['total_escolas'] }} --}}
                    </p>

                    <p class="mt-1 text-sm text-white/70">
                        unidades escolares
                    </p>
                </div>

            </div>

        </div>

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
                        name="nivel"
                        :options="[]"
                        wire:model.live="nivel"
                    />

                    <x-site.select
                        label="Bairro"
                        name="bairro"
                        :options="[]"
                        wire:model.live="bairro"
                    />

                    <x-site.select
                        label="Série"
                        name="serie"
                        :options="[]"
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

            {{-- Botões --}}
            <div class="mt-5 flex justify-center gap-4 lg:justify-start">


            </div>

        </aside>

    </div>
    <div
        class="mt-8 transition-opacity"
        wire:loading.class="opacity-50"
        wire:target="nivel, bairro, serie, limparFiltros">

        <livewire:lista
            :escolas="$escolas" 
            :regiao="$regiao"
            :bairro="$bairro"
            :tipo="$tipo"
            :serie="$serie"
        />

        <div
            class="mx-auto mt-12 max-w-7xl px-4 transition-opacity"
            wire:loading.class="opacity-50"
            wire:target="nivel,bairro,serie,limparFiltros">
        </div>
    </div>
</div>