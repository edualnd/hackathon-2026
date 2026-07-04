<div>
    <div class="flex">
        <section class="inline-flex items-center justify-center gap-2 rounded-full px-5 py-3 text-sm font-semibold font-body">
            <button wire:click='switchLista' class="p-4">
                Lista
            </button>
            
            <button wire:click='switchMapa' class="p-4">
                Mapa
            </button>
        </section>
    </div>

    <div class="block">
        @switch($exibicao)
            @case('lista')
                    @livewire('lista')
                @break
            @case('mapa')
                    @livewire('mapa')
                @break
            @default
        @endswitch
    </div>
</div>