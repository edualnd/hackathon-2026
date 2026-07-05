<div>
    <div class="mx-auto sm:my-8 max-w-7xl px-4 sm:my-12 sm:px-6 lg:px-8">
        <span
            class="hidden lg:inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-2 font-body text-[14px] font-semibold text-text-on-canvas backdrop-blur-sm mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="rgb(192, 236, 29)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-icon lucide-map">
                <path d="M14.106 5.553a2 2 0 0 0 1.788 0l3.659-1.83A1 1 0 0 1 21 4.619v12.764a1 1 0 0 1-.553.894l-4.553 2.277a2 2 0 0 1-1.788 0l-4.212-2.106a2 2 0 0 0-1.788 0l-3.659 1.83A1 1 0 0 1 3 19.381V6.618a1 1 0 0 1 .553-.894l4.553-2.277a2 2 0 0 1 1.788 0z"/>
                <path d="M15 5.764v15"/>
                <path d="M9 3.236v15"/>
            </svg>
            Mapa - Clique em uma das Escolas para ver mais informações!
        </span>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3 lg:items-start">
            <div class="relative lg:contents">
                {{-- =========================================
             MOBILE: moldura escura ao redor do mapa (estilo "app"),
             com o badge dentro e o filtro flutuando por cima do mapa.
             Em telas lg+ esta div vira display:contents (sem fundo
             nem padding) e o layout desktop original assume: mapa
             e coluna de filtros lado a lado, exatamente como antes.
        ========================================== --}}

                <div class="rounded-[28px] p-2.5 lg:contents">
                    <div class="mb-2 px-1 pt-0.5 lg:hidden">
                        <span
                            class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3.5 py-1.5 font-body text-xs font-semibold text-white">
                            <span class="size-1.5 rounded-full bg-action-primary"></span>
                            Central de Vagas
                        </span>
                    </div>

                    <div class="relative lg:contents">
                        {{-- =========================================
                COLUNA PRINCIPAL (mapa + estatísticas)
                ========================================== --}}

                        <div class="text-center lg:order-1 lg:col-span-2 lg:text-left">
                            <livewire:mapa :escolas="$escolas" :regiao="$regiao" :bairro="$bairro" :tipo="$tipo"
                                :serie="$serie" />
                        </div>

                        {{-- =========================================
                     FILTROS (flutua sobre o mapa no mobile; coluna fixa no desktop)
                ========================================== --}}

                        <aside x-data="{ open: true }"
                            class="absolute inset-x-2.5 top-2.5 z-10 lg:static lg:z-auto lg:inset-auto lg:order-2 lg:mx-0 lg:mt-0 lg:w-full lg:max-w-sm">
                            <div id="filtros" x-show="open" x-cloak
                                class="rounded-2xl bg-neutral-100 p-4 shadow-2xl sm:rounded-3xl sm:p-6 lg:!block">
                                <div class="mb-3 flex items-center justify-between sm:mb-6">
                                    <div class="flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="rgb(132, 197, 17)"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-sliders-horizontal-icon lucide-sliders-horizontal">
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

                                        <h2 class="text-sm font-bold text-yellow-lime-500 sm:text-xl">
                                            Filtrar vagas
                                        </h2>
                                    </div>

                                    <button type="button" @click="open = false"
                                        class="text-white/60 hover:text-white lg:hidden" aria-label="Fechar filtro">
                                        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6 6l12 12M6 18L18 6" />
                                        </svg>
                                    </button>
                                </div>

                                <div class="grid grid-cols-2 gap-2 lg:block lg:space-y-4">
                                    <x-site.select label="Nível de ensino" name="nivel" :options="$tipos"
                                        wire:model.live="tipo" />

                                    <x-site.select label="Bairro" name="bairro" :options="$bairros"
                                        wire:model.live="bairro" />

                                    <div class="col-span-2 lg:col-span-1">
                                        <x-site.select label="Regiões" name="regioes" :options="$regioes"
                                            wire:model.live="regiao" />
                                    </div>
                                </div>

                                <div class="mt-3 flex justify-end sm:mt-6">
                                    <x-site.button variant="primary" wire:click="limparFiltros" type="button"
                                        class="!px-3 !py-2 text-xs sm:!px-5 sm:!py-3 sm:text-sm">
                                        <svg class="size-3.5 sm:size-4" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6 6l12 12M6 18L18 6" />
                                        </svg>

                                        Limpar filtros
                                    </x-site.button>
                                </div>
                            </div>

                            <button type="button" x-show="!open" x-cloak @click="open = true"
                                class="flex items-center gap-2 rounded-full bg-neutral-950 px-4 py-2 text-xs font-semibold text-white shadow-lg lg:hidden">
                                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M7 12h10M10 18h4" />
                                </svg>
                                Filtrar vagas
                            </button>
                        </aside>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5 flex flex-col gap-4">
            <livewire:escola-info />
            <livewire:lista-espera.lista-publica />
        </div>
    </div>
</div>
