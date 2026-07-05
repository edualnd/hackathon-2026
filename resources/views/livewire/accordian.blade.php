<div class="w-full mx-auto rounded-3xl overflow-hidden border border-seduc-neutral-300">
    @foreach ($items as $index => $item)
        <div class="overflow-hidden">
            {{-- Cabeçalho --}}
            <button wire:click="toggle({{ $index }})"
                class="w-full flex justify-between items-center px-4 py-3 bg-yellow-lime-100 hover:bg-lime-200 transition text-left font-medium {{ $index == 0 ? 'border-b border-seduc-neutral-300' : '' }}">
                <span>{{ $item['title'] }}</span>
                <svg class="w-5 h-5 transform transition-transform duration-200 {{ $openIndex === $index ? 'rotate-180' : '' }}"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            {{-- Conteúdo --}}
            @if ($openIndex === $index)
                <div class="px-4 py-3 bg-white text-gray-700" x-data x-transition>
                    @if ($item['content'])
                        @if ($index == 0)
                            @if($item['content']->isEmpty())
                                <p class="font-medium capitalize text-amber-400">Nenhuma vaga disponível.</p>
                            @endif

                            <ul class="divide-y divide-seduc-neutral-200">
                                @foreach ($item['content'] as $vaga)
                                    <li class="flex justify-between py-2 hover:cursor-pointer" wire:click="$dispatch('openListaPublica', { id: {{ $vaga['id'] }} })">
                                        <span class="font-medium capitalize">{{ str_replace('_', ' ', $vaga['serie']) }}</span>
                                        <span>{{ $vaga['qtd'] }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <ul class="divide-y divide-seduc-neutral-200">
                                @foreach ($item['content']->getAttributes() as $campo => $valor)
                                    @if (
                                        $campo != 'id' &&
                                            $campo != 'created_at' &&
                                            $campo != 'updated_at' &&
                                            $campo != 'lat' &&
                                            $campo != 'lng' &&
                                            $campo != 'nome')
                                        <li class="flex justify-between py-2">
                                            <span class="font-medium capitalize">{{ str_replace('_', ' ', $campo) }}</span>
                                            <span>{{ $valor }}</span>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        @endif
                    @else
                        <p class="text-sm text-gray-400">Nenhuma informação disponível.</p>
                    @endif
                </div>
            @endif
        </div>
    @endforeach
</div>
