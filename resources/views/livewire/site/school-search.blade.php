<div class="max-w-7xl mx-auto my-12">

    <span
        class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3.5 py-1.5 font-body text-xs font-semibold text-text-on-canvas backdrop-blur-sm mb-4">
        <span class="size-1.5 rounded-full bg-action-primary"></span>
        Central de Vagas · SEDUC
    </span>

    <div class="items-center gap-12 grid lg:grid-cols-3 items-start">

        {{-- =========================================
        COLUNA ESQUERDA
        ========================================== --}}

        <div class="text-center lg:text-left col-span-2">


            <livewire:mapa :escolas="$escolas" :regiao="$regiao" :bairro="$bairro" :tipo="$tipo" :serie="$serie" />


        </div>

        {{-- =========================================
             COLUNA DIREITA
        ========================================== --}}

        <aside class="mx-auto w-full max-w-sm lg:mx-0">

            <div id="filtros" class="rounded-3xl bg-neutral-950 p-6 shadow-2xl">

                <div class="flex gap-2 items-center mb-6 ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="rgb(192, 236, 29)" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-sliders-horizontal-icon lucide-sliders-horizontal">
                        <path d="M10 5H3" />
                        <path d="M12 19H3" />
                        <path d="M14 3v4" />
                        <path d="M16 17v4" />
                        <path d="M21 12h-9" />
                        <path d="M21 19h-5" />
                        <path d="M21 5h-7" />
                        <path d="M8 10v4" />
                        <path d="M8 12H3" />
                    </svg>

                    <h2 class="text-xl font-semibold text-white">
                        Filtrar vagas
                    </h2>
                </div>


                <div class="space-y-4">
                    <x-site.select label="Nível de ensino" name="nivel" :options="$tipos" wire:model.live="tipo" />

                    <x-site.select label="Bairro" name="bairro" :options="$bairros" wire:model.live="bairro" />

                    <x-site.select label="Regiões" name="regioes" :options="$regioes" wire:model.live="regiao" />

                </div>

                <div class="mt-6 flex justify-end">

                    <x-site.button variant="ghost" wire:click="limparFiltros" type="button">
                        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 6l12 12M6 18L18 6" />
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

    <livewire:escola-info />


    <div class="mt-8 transition-opacity" wire:loading.class="opacity-50"
        wire:target="nivel, bairro, serie, limparFiltros">

        <livewire:lista :escolas="$escolas" :regiao="$regiao" :bairro="$bairro" :tipo="$tipo" :serie="$serie" />

        <div class="mx-auto mt-12 max-w-7xl px-4 transition-opacity" wire:loading.class="opacity-50"
            wire:target="nivel,bairro,serie,limparFiltros">
        </div>

        {{-- Botões --}}
        <div class="mt-5 flex justify-center gap-4 lg:justify-start">
        </div>

        </aside>

    </div>
    <div class="mt-8 transition-opacity" wire:loading.class="opacity-50"
        wire:target="nivel, bairro, serie, limparFiltros">

        <livewire:lista :escolas="$escolas" :regiao="$regiao" :bairro="$bairro" :tipo="$tipo"
            :serie="$serie" />

        <div class="mx-auto mt-12 max-w-7xl px-4 transition-opacity" wire:loading.class="opacity-50"
            wire:target="nivel,bairro,serie,limparFiltros">
        </div>
    </div>
