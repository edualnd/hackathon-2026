<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $pageTitle ?? 'Painel Administrativo' }} · SEDUC</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="min-h-screen bg-seduc-neutral-100 font-body text-text-on-surface antialiased">

        {{-- Área administrativa é desktop-only, conforme especificação --}}
        <div class="flex min-h-screen items-center justify-center px-6 text-center md:hidden">
            <div>
                <p class="font-heading text-lg font-semibold text-text-on-surface">Acesse pelo computador</p>
                <p class="mt-2 font-body text-sm text-seduc-neutral-600">
                    A área administrativa da SEDUC foi desenhada para uso em telas maiores. Acesse esta página a partir de um desktop ou notebook.
                </p>
            </div>
        </div>

        <div class="hidden md:flex min-h-screen">
            <aside class="flex w-64 shrink-0 flex-col justify-between bg-seduc-neutral-900 px-4 py-6">
                <div>
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5 px-2">
                        <span class="relative flex size-9 items-center justify-center rounded-[10px] bg-action-primary">
                            <span class="size-3 rotate-45 rounded-[2px] bg-teal-dark-700"></span>
                        </span>
                        <span class="leading-tight">
                            <span class="block font-heading text-sm font-bold text-white">SEDUC</span>
                            <span class="block font-body text-[11px] text-seduc-neutral-400">Painel Administrativo</span>
                        </span>
                    </a>

                    <nav class="mt-8 flex flex-col gap-1">
                        <x-site.sidebar-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')"
                            icon='<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 13h6V4H4v9Zm0 7h6v-5H4v5Zm10 0h6V11h-6v9Zm0-16v5h6V4h-6Z"/></svg>'>
                            Dashboard
                        </x-site.sidebar-link>
                        <x-site.sidebar-link :href="route('admin.alunos.index')" :active="request()->routeIs('admin.alunos.*')"
                            icon='<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 19V6a2 2 0 0 1 2-2h6l2 2h6a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2Z"/></svg>'>
                            Alunos
                        </x-site.sidebar-link>
                        <x-site.sidebar-link :href="route('admin.vagas.index')" :active="request()->routeIs('admin.vagas.*')"
                            icon='<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-6-3V4l6 3 6-3 6 3v13l-6-3-6 3Zm0 0V7m6 13V10"/></svg>'>
                            Vagas
                        </x-site.sidebar-link>
                        <x-site.sidebar-link href="{{ route('mapa') }}"
                            icon='<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 3 4 6v15l5-3 6 3 5-3V3l-5 3-6-3Zm0 3v12m6-9v12"/></svg>'>
                            Mapa interativo
                        </x-site.sidebar-link>

                        <p class="mt-4 px-3.5 font-body text-[11px] font-semibold uppercase tracking-wide text-seduc-neutral-500">Em breve</p>
                        <span class="flex cursor-not-allowed items-center gap-3 rounded-xl px-3.5 py-2.5 font-body text-sm font-medium text-seduc-neutral-500/70" title="Funcionalidade ainda não disponível">
                            <span class="flex size-5 items-center justify-center"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 19h16M7 19V9m5 10V5m5 14v-7"/></svg></span>
                            Relatórios
                        </span>
                        <span class="flex cursor-not-allowed items-center gap-3 rounded-xl px-3.5 py-2.5 font-body text-sm font-medium text-seduc-neutral-500/70" title="Funcionalidade ainda não disponível">
                            <span class="flex size-5 items-center justify-center"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09a1.65 1.65 0 0 0-1.08-1.51 1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09a1.65 1.65 0 0 0 1.51-1.08 1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1Z"/></svg></span>
                            Configurações
                        </span>
                    </nav>
                </div>

                <form method="GET" action="{{ route('site.search') }}">
                    <button type="submit" class="flex w-full items-center gap-3 rounded-xl px-3.5 py-2.5 font-body text-sm font-medium text-seduc-neutral-300 hover:bg-white/5 hover:text-white">
                        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17l5-5-5-5M20 12H9M12 19H6a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h6"/></svg>
                        Sair (simulado)
                    </button>
                </form>
            </aside>

            <div class="flex-1 overflow-y-auto">
                {{ $slot }}
            </div>
        </div>

        @livewireScripts
    </body>
</html>
