<div class="w-full mx-auto rounded-3xl overflow-hidden border border-seduc-neutral-300">
    @foreach ($items as $index => $item)
        <div class=" overflow-hidden">
            {{-- Cabeçalho --}}
            <button
                wire:click="toggle({{ $index }})"
                class="w-full flex justify-between items-center px-4 py-3 bg-seduc-neutral-100 hover:bg-lime-200 transition text-left font-medium {{ $index == 0 ? 'border-b border-seduc-neutral-300' : ''}} {{ $openIndex === $index ? 'bg-lime-100' : '' }}"
            >
                <span>{{ $item['title'] }}</span>
                <svg
                    class="w-5 h-5 transform transition-transform duration-200 {{ $openIndex === $index ? 'rotate-180' : '' }}"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            {{-- Conteúdo --}}
            @if ($openIndex === $index)
                <div class="px-4 py-3 bg-white text-gray-700" x-data x-transition>
                    {{ $item['content'] }}
                </div>
            @endif
        </div>
    @endforeach
</div>