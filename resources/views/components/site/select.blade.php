
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
        <select id="{{ $name }}" name="{{ $name }}"
            {{ $attributes->merge([
                'class' => 'w-full appearance-none rounded-xl border border-seduc-neutral-300 bg-white/10 backdrop-blur-md font-body text-sm px-4 py-3 pr-10 transition
                                focus:outline-none focus:ring-0 focus:border-yellow-lime-400',
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