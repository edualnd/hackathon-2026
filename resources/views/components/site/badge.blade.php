@props ([
    'variant' => 'info', // success | warning | danger | info | neutral
])

@php
    $variants = [
        'success' => 'bg-feedback-success text-text-on-success',
        'warning' => 'bg-feedback-warning text-text-on-warning',
        'danger' => 'bg-feedback-danger text-text-on-danger',
        'info' => 'bg-feedback-info text-text-on-info',
        'neutral' => 'bg-seduc-neutral-100 text-seduc-neutral-800',
    ];

    $classes = 'inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 font-body text-xs font-semibold ' . ($variants[$variant] ?? $variants['info']);
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}> {{ $slot }} </span>
