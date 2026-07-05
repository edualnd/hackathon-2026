<div class="max-w-7xl mx-auto my-12">

    <span
        class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3.5 py-1.5 mb-4 font-body text-xs font-semibold text-text-on-canvas backdrop-blur-sm">
        <span class="size-1.5 rounded-full bg-action-primary"></span>
        Central de Vagas · SEDUC
    </span>

    <div class="items-start gap-12 grid lg:grid-cols-3 ">

        {{-- =========================================
        COLUNA ESQUERDA
        ========================================== --}}

        <div class="text-center lg:text-left col-span-2">

            <livewire:mapa :escolas="$escolas" :regiao="$regiao" :bairro="$bairro" :tipo="$tipo" :serie="$serie" />

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

        <div id="filtros" class="rounded-3xl bg-neutral-950 p-6 shadow-2xl">

            <h2 class="mb-6 text-xl font-semibold text-white">
                Filtrar vagas
            </h2>

            <div class="space-y-4">

                <x-site.select label="Nível de ensino" name="nivel" :options="[]" wire:model.live="nivel" />

                <x-site.select label="Bairro" name="bairro" :options="[]" wire:model.live="bairro" />

                <x-site.select label="Série" name="serie" :options="[]" wire:model.live="serie" />

            </div>

            <div class="mt-6 flex justify-end">

                <x-site.button variant="primary" wire:click="limparFiltros" type="button">


                    <svg width="30" height="30" viewBox="0 0 90 90" fill="none" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <rect width="90" height="90" fill="url(#pattern0_21_5984)" />
                        <defs>
                            <pattern id="pattern0_21_5984" patternContentUnits="objectBoundingBox" width="1" height="1">
                                <use xlink:href="#image0_21_5984" transform="scale(0.0111111)" />
                            </pattern>
                            <image id="image0_21_5984" width="90" height="90" preserveAspectRatio="none"
                                xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAACXBIWXMAAAsTAAALEwEAmpwYAAAC+UlEQVR4nO2dS4sTQRRGDz5u2lmNf8qlDxDUXzLbgVkYt6KMjgP+B8WJrl0rMm5c+FiNbkRXriMFFQgh6XQnnap7q+6BCwOpmdQcvnTSt6sr4DiO4ziO42zGVeAOcAp8An4BP+PPp/GxMMbZggfAN2C6pr4C97d5olq5AjzuIHixTgDJPXkrNMBkA8mzmsS/4bQQ0vh6C8mzegdca3uimpGBJLvshJJddkLJLjuhZJdNOslVy5bEkquULZkkVyVbMkuuQrYokVy0bAFeKZBbtGxRKrko2Q1wpkBml0aU2a6fKE/yYr3EII2RJC9WuNBgBjGW5Pn6YeUQMjKa5Pm6jXLEcJLnK1zwVYsUIjnUR5QiBUmexqUM6pDCJIe6QBlSoORQH1CEFCp5tjZEBaMCPsK11S0UUHKSp8B3DScsXZJ8BhwpELZp3bOQ5LdzS7EOFEjrW8dWktws/N6hAnlm2qR9k7yIhWS3zd+EZAuyi5GsWXZxkjXKLlayJtnFS9YguxrJOWVXJzmH7Golp5RdveQUsl1yAtnZJYfbed8ovFfvcEDJy3ovyTnusOgv1yQPSkgysd+qLclDJltFksP91V+UJnmIZKtIMvFamOYkb5NsFUmecbJikufAHjo5siaZuF7B0qK+0YZXdrJzsWKy++hjZFVym+jr6GJkWbKVQ0djXXLgufI3w6YEyYGba/6B8JLNRVOK5C4nLLk+8IuyBleSU/DUqWlKSnLfplKq9EiJSV5sk+ZOUaNgDknImSbpsMuB6SRrkC21Se4je6j2qdQqOaVsqV1yCtnikncvW1zy7mWLS969bHHJw/WEJyu6fnsd9n/O3cQyJ/s89rP3Y4X99j+7ZNt3yf4FnqzZ0Sscsh7FHQrCFaXxmrut+o6vRvYUeNYy1/GS8eMBx1cl+x9wqcd10bZtIfqOT0J4Sb1w0em4G7/3ROOtxMsOBQ8HHJ+cy8AN4CnwHvidQPCf+N0s694MxzGVXd8M+4x3HMdxHMdxHMdBPf8BePUdIp+X5QcAAAAASUVORK5CYII=" />
                        </defs>
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
<div class="mt-8 transition-opacity" wire:loading.class="opacity-50" wire:target="nivel, bairro, serie, limparFiltros">

    <livewire:lista :escolas="$escolas" :regiao="$regiao" :bairro="$bairro" :tipo="$tipo" :serie="$serie" />

    <div class="mx-auto mt-12 max-w-7xl px-4 transition-opacity" wire:loading.class="opacity-50"
        wire:target="nivel,bairro,serie,limparFiltros">
    </div>
</div>
</div>