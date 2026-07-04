@props([
    'title' => null,
    'back' => null,
])

<header class="sticky top-0 z-30 border-b border-seduc-neutral-200 bg-background-surface/95 backdrop-blur">
    <div class="mx-auto flex h-16 max-w-5xl items-center justify-between gap-3 px-4">
        <div class="flex items-center gap-3">
            @if ($back)
                <a href="{{ $back }}" class="flex size-9 items-center justify-center rounded-full bg-seduc-neutral-100 text-text-on-surface" aria-label="Voltar">
                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 18l-6-6 6-6"/></svg>
                </a>
            @endif

            <a href="{{ route('site.search') }}" class="flex items-center gap-2.5">
                <span class="relative flex size-9 items-center justify-center rounded-[10px] bg-action-primary">
                    <span class="size-3 rotate-45 rounded-[2px] bg-teal-dark-700"></span>
                </span>
                <span class="leading-tight">
                    <span class="block font-heading text-sm font-bold text-text-on-surface">SEDUC</span>
                    <span class="block font-body text-[11px] text-seduc-neutral-600">Central de Vagas</span>
                </span>
            </a>
        </div>

        @if ($title)
            <p class="font-heading text-sm font-semibold text-text-on-surface">{{ $title }}</p>
        @endif

        <nav class="flex items-center gap-2">
            <a href="{{ route('site.map') }}" class="flex size-9 items-center justify-center rounded-full border border-seduc-neutral-200 text-text-on-surface" aria-label="Mapa">
                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-6-3V4l6 3 6-3 6 3v13l-6-3-6 3Zm0 0V7m6 13V10"/></svg>
            </a>
            <a href="{{ route('admin.login') }}" class="flex size-9 items-center justify-center rounded-full border border-seduc-neutral-200 text-text-on-surface" aria-label="Área administrativa">
                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="3.2"/><path stroke-linecap="round" d="M4.5 20c1.6-3.4 4.3-5 7.5-5s5.9 1.6 7.5 5"/></svg>
            </a>
        </nav>
    </div>
</header>
