<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center gap-2 rounded-full px-5 py-3 text-sm font-semibold font-body transition active:scale-[0.98] disabled:opacity-50 disabled:pointer-events-none bg-yellow-lime-400']) }}
>
    {{ $slot }}
</button>
