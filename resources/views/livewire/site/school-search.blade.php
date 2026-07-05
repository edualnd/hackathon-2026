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

            {{-- Estatísticas --}}
            <div class="mx-auto mt-10 grid max-w-md grid-cols-2 gap-4 lg:mx-0">



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

        {{-- =========================================
             COLUNA DIREITA
        ========================================== --}}

        <aside class="mx-auto w-full max-w-sm lg:mx-0">

            <div id="filtros" class="rounded-3xl bg-neutral-950 p-6 shadow-2xl">

                <h2 class="mb-6 text-xl font-semibold text-white">
                    Filtrar vagas
                </h2>

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

    <div class="rounded-3xl bg-neutral-100 p-6 shadow-2xl">

        <h3 class="font-heading font-semibold text-[1.5rem] mb-4">EMEF Pontal Santamarina</h3>

        <div class="mb-4">
            <livewire:accordian />
        </div>

        <div class="grid lg:grid-cols-12 mb-4 gap-4">
            <div class="flex flex-col col-span-1">
                <strong class="font-bold text-[14px]">
                    Bairro:
                </strong>

                <span class="font-medium text-[14px]">Pereque</span>
            </div>

            <div class="flex flex-col col-span-1">
                <strong class="font-bold text-[14px]">
                    Região:
                </strong>

                <span class="font-medium text-[14px]">Sul</span>
            </div>

            <div class="flex flex-col col-span-3">
                <strong class="font-bold text-[14px]">
                    Endereço:
                </strong>

                <span class="font-medium text-[14px]">Av. Perequê-Mirim, 340 - Perequê-Mirim, Caraguatatuba - SP</span>
            </div>


        </div>

        <div class="grid lg:grid-cols-6 gap-4">

            <div class="rounded-3xl bg-lime-200 p-4 flex flex-col justify-center">

                <div class="flex gap-2 items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-users" aria-hidden="true">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                        <path d="M16 3.128a4 4 0 0 1 0 7.744"></path>
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                    </svg>

                    <p class="text-[14px]">
                        Total de vagas
                    </p>
                </div>

                <strong class="text-[2.25rem]/[1.5] font-bold">
                    20
                </strong>
            </div>

            <div class="rounded-3xl bg-teal-light-200 p-4 flex flex-col justify-center">

                <div class="flex gap-2 items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-clock" aria-hidden="true">
                        <circle cx="12" cy="12" r="10"></circle>
                        <path d="M12 6v6l4 2"></path>
                    </svg>

                    <p class="text-[14px]">
                        Vagas disponíveis
                    </p>
                </div>

                <strong class="text-[2.25rem]/[1.5] font-bold">
                    20
                </strong>
            </div>

            <div class="rounded-3xl bg-teal-dark-200 p-4 flex flex-col justify-center">

                <div class="flex gap-2 items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-clock" aria-hidden="true">
                        <circle cx="12" cy="12" r="10"></circle>
                        <path d="M12 6v6l4 2"></path>
                    </svg>

                    <p class="text-[14px]">
                        Vagas ocupadas
                    </p>
                </div>

                <strong class="text-[2.25rem]/[1.5] font-bold">
                    20
                </strong>
            </div>

            <div class="rounded-3xl bg-amber-200 p-4 flex flex-col justify-center">

                <div class="flex gap-2 items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-clock" aria-hidden="true">
                        <circle cx="12" cy="12" r="10"></circle>
                        <path d="M12 6v6l4 2"></path>
                    </svg>

                    <p class="text-[14px]">
                        Lista de Espera
                    </p>
                </div>

                <strong class="text-[2.25rem]/[1.5] font-bold">
                    20
                </strong>
            </div>



        </div>

    </div>

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
