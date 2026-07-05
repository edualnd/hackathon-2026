@props([
    'label' => null,
    'name' => null,
    'options' => [],
    'placeholder' => 'Todos',
])

<div class="w-full">
    @if ($label)
        <label for="{{ $name }}" class="mb-1 sm:mb-1.5 block font-body text-xs sm:text-sm font-medium text-neutral-500">
            {{ $label }}
        </label>
    @endif

    <div class="relative">
        <select id="{{ $name }}" name="{{ $name }}"
            {{ $attributes->merge([
                'class' => 'w-full appearance-none rounded-xl border border-seduc-neutral-300 bg-background-surface font-body text-xs sm:text-sm text-text-on-surface px-3 py-2 pr-9 sm:px-4 sm:py-3 sm:pr-10 transition
                                focus:outline-none focus:ring-2 focus:ring-teal-dark-400 focus:border-teal-dark-500',
            ]) }}>
            @if ($slot->isEmpty())
                <option value="">{{ $placeholder }}</option>
                @foreach ($options as $o)
                    <option value="{{ is_array($o) ? $o['id'] : $o }}">
                        {{ is_array($o) ? $o['nome'] : $o }}
                    </option>
                @endforeach
            @else
                {{ $slot }}
            @endif
        </select>

    </div>
</div>
