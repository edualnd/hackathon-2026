@props([
    'variant' => 'primary', // primary | secondary | outline | ghost | inverse
    'href' => null,
    'type' => 'button',
])

@php
    $base = 'inline-flex items-center justify-center gap-2 rounded-full px-5 py-3 text-sm font-semibold font-body transition active:scale-[0.98] disabled:opacity-50 disabled:pointer-events-none';

    $variants = [
        'primary' => 'bg-action-primary text-text-on-canvas-tertiary hover:bg-action-primary-hover',
        'secondary' => 'bg-action-secondary text-text-on-canvas-tertiary hover:bg-action-secondary-hover',
        'outline' => 'bg-background-surface text-text-on-surface border border-seduc-neutral-300 hover:border-teal-dark-500',
        'ghost' => 'bg-transparent text-text-on-surface hover:bg-seduc-neutral-100',
        // Para uso sobre fundos escuros (hero, sidebar admin, etc.)
        'inverse' => 'bg-white/10 text-text-on-canvas border border-white/25 backdrop-blur-sm hover:bg-white/20 hover:border-white/40',
    ];

    $classes = $base . ' ' . ($variants[$variant] ?? $variants['primary']);
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
