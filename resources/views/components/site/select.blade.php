@props([
    'label' => null,
    'name' => null,
    'options' => [],
    'placeholder' => 'Todos',
])

<div class="w-full">
    @if ($label)
        <label for="{{ $name }}" class="mb-1.5 block font-body text-sm font-medium text-neutral-500">
            {{ $label }}
        </label>
    @endif

    <div class="relative">
        <select
            id="{{ $name }}"
            name="{{ $name }}"
            {{ $attributes->merge([
                'class' => 'w-full appearance-none rounded-xl border border-seduc-neutral-300 bg-background-surface font-body text-sm text-text-on-surface px-4 py-3 pr-10 transition
                    focus:outline-none focus:ring-2 focus:ring-teal-dark-400 focus:border-teal-dark-500',
            ]) }}
        >
            @if ($slot->isEmpty())
                <option value="">{{ $placeholder }}</option>
                @foreach ($options as $o)
<<<<<<< Updated upstream
                
=======
>>>>>>> Stashed changes
                    <option value="{{ $o['id']}}">{{ $o['nome'] }}</option>
                @endforeach
            @else
                {{ $slot }}
            @endif
        </select>

        <svg class="pointer-events-none absolute right-3.5 top-1/2 size-4 -translate-y-1/2 text-seduc-neutral-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6" />
        </svg>
    </div>
</div>
