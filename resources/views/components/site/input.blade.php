@props([
    'label' => null,
    'name' => null,
    'type' => 'text',
    'error' => null,
])

<div class="w-full">
    @if ($label)
        <label for="{{ $name }}" class="mb-1.5 block font-body text-sm font-medium text-text-on-surface">
            {{ $label }}
        </label>
    @endif

    <input
        id="{{ $name }}"
        name="{{ $name }}"
        type="{{ $type }}"
        {{ $attributes->merge([
            'class' => 'w-full rounded-xl border font-body text-sm text-text-on-surface placeholder:text-seduc-neutral-400 px-4 py-3 transition
                focus:outline-none focus:ring-2 focus:ring-teal-dark-400 focus:border-teal-dark-500
                ' . ($error ? 'border-feedback-danger' : 'border-seduc-neutral-300 bg-background-surface'),
        ]) }}
    />

    @if ($error)
        <p class="mt-1.5 font-body text-xs text-text-on-danger">{{ $error }}</p>
    @endif
</div>
