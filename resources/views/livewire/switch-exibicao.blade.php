<div>
    <div class="flex">
        <section class="rounded-full bg-white/10 p-2 backdrop-blur-sm mb-4">
            <button
                wire:click="switchLista"
                class="{{ 'button--switch text-[14px] rounded-full font-semibold ' . ($exibicao === 'lista' ? 'button--switch--active' : '') }}"
            >
                Lista
            </button>

            <button
                wire:click="switchMapa"
                class="{{ 'button--switch text-[14px] rounded-full font-semibold ' . ($exibicao === 'mapa' ? 'button--switch--active' : '') }}"
            >
                Mapa
            </button>
        </section>
    </div>
    <div class="block">
        <livewire:lista
            :escolas="$escolas"
            :regiao="$regiao"
            :bairro="$bairro"
            :tipo="$tipo"
            :serie="$serie"
        />

        <livewire:mapa
            :escolas="$escolas"
            :regiao="$regiao"
            :bairro="$bairro"
            :tipo="$tipo"
            :serie="$serie"
        />
    </div>
</div>
