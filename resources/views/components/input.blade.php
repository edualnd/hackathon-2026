@props (['disabled' => false])

<input
    {{ $disabled ? 'disabled' : '' }}
    {!! $attributes->merge(['class' => 'w-full rounded-xl border font-body text-sm text-text-on-surface placeholder:text-seduc-neutral-400 px-4 py-3 transition
                focus:outline-none focus:ring-2 focus:ring-teal-dark-400 focus:border-teal-dark-500']) !!}
/>
