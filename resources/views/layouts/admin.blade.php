<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $pageTitle ?? 'Painel Administrativo' }} · SEDUC</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="min-h-screen bg-seduc-neutral-100 font-body text-text-on-surface antialiased">

    {{-- Área administrativa é desktop-only, conforme especificação --}}
    <div class="flex min-h-screen items-center justify-center px-6 text-center md:hidden">
        <div>
            <p class="font-heading text-lg font-semibold text-text-on-surface">Acesse pelo computador</p>
            <p class="mt-2 font-body text-sm text-seduc-neutral-600">
                A área administrativa da SEDUC foi desenhada para uso em telas maiores. Acesse esta página a partir de
                um desktop ou notebook.
            </p>
        </div>
    </div>

    <div class="hidden md:flex min-h-screen">
        <aside class="flex w-64 shrink-0 flex-col justify-between bg-seduc-neutral-900 px-4 py-6">
            <div>
                <a href="{{ route('v1.dashboard') }}" class="flex justify-center items-center gap-2.5 px-2">
                    <svg width="143" height="40" viewBox="0 0 143 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M20 13.5C23.0375 13.5 25.5 11.0375 25.5 8C25.5 4.9625 23.0375 2.5 20 2.5C16.9625 2.5 14.5 4.9625 14.5 8C14.5 11.0375 16.9625 13.5 20 13.5ZM20 32.1688V22.8375C21.0187 22.4125 22.0563 21.9813 23.1063 21.5438C25.5438 20.5312 28.1562 20.0063 30.8 20.0063H32V30.0063H30.8C27.1062 30.0063 23.4438 30.7375 20.0312 32.1625L20 32.175V32.1688ZM20 18.5L18.4312 17.8438C15.5062 16.625 12.3687 16 9.2 16H7C5.34375 16 4 17.3438 4 19V31C4 32.6562 5.34375 34 7 34H9.2C12.3687 34 15.5062 34.625 18.4312 35.8438L19.2313 36.175C19.725 36.3812 20.275 36.3812 20.7687 36.175L21.5688 35.8438C24.4937 34.625 27.6312 34 30.8 34H33C34.6562 34 36 32.6562 36 31V19C36 17.3438 34.6562 16 33 16H30.8C27.6312 16 24.4937 16.625 21.5688 17.8438L20 18.5Z"
                            fill="#C0EC1D" />
                        <path
                            d="M56.257 14.066L52.024 26H48.386L44.153 14.066H47.247L50.205 23.076L53.18 14.066H56.257ZM64.901 23.892H60.447L59.733 26H56.69L61.008 14.066H64.374L68.692 26H65.615L64.901 23.892ZM64.153 21.648L62.674 17.279L61.212 21.648H64.153ZM77.9281 17.84C77.7128 17.4433 77.4011 17.143 76.9931 16.939C76.5965 16.7237 76.1261 16.616 75.5821 16.616C74.6415 16.616 73.8878 16.9277 73.3211 17.551C72.7545 18.163 72.4711 18.9847 72.4711 20.016C72.4711 21.1153 72.7658 21.9767 73.3551 22.6C73.9558 23.212 74.7775 23.518 75.8201 23.518C76.5341 23.518 77.1348 23.3367 77.6221 22.974C78.1208 22.6113 78.4835 22.09 78.7101 21.41H75.0211V19.268H81.3451V21.971C81.1298 22.6963 80.7615 23.3707 80.2401 23.994C79.7301 24.6173 79.0785 25.1217 78.2851 25.507C77.4918 25.8923 76.5965 26.085 75.5991 26.085C74.4205 26.085 73.3665 25.83 72.4371 25.32C71.5191 24.7987 70.7995 24.079 70.2781 23.161C69.7681 22.243 69.5131 21.1947 69.5131 20.016C69.5131 18.8373 69.7681 17.789 70.2781 16.871C70.7995 15.9417 71.5191 15.222 72.4371 14.712C73.3551 14.1907 74.4035 13.93 75.5821 13.93C77.0101 13.93 78.2115 14.2757 79.1861 14.967C80.1721 15.6583 80.8238 16.616 81.1411 17.84H77.9281ZM90.3844 23.892H85.9304L85.2164 26H82.1734L86.4914 14.066H89.8574L94.1754 26H91.0984L90.3844 23.892ZM89.6364 21.648L88.1574 17.279L86.6954 21.648H89.6364Z"
                            fill="white" />
                        <path
                            d="M103.259 14.066V16.395H98.3965V18.911H102.035V21.172H98.3965V26H95.4895V14.066H103.259ZM112.215 23.892H107.761L107.047 26H104.004L108.322 14.066H111.688L116.006 26H112.929L112.215 23.892ZM111.467 21.648L109.988 17.279L108.526 21.648H111.467ZM111.977 11.669L107.88 13.386V11.38L111.977 9.408V11.669ZM116.828 20.016C116.828 18.8373 117.083 17.789 117.593 16.871C118.103 15.9417 118.811 15.222 119.718 14.712C120.636 14.1907 121.673 13.93 122.829 13.93C124.245 13.93 125.458 14.304 126.467 15.052C127.475 15.8 128.15 16.82 128.49 18.112H125.294C125.056 17.6133 124.716 17.2337 124.274 16.973C123.843 16.7123 123.35 16.582 122.795 16.582C121.899 16.582 121.174 16.8937 120.619 17.517C120.063 18.1403 119.786 18.9733 119.786 20.016C119.786 21.0587 120.063 21.8917 120.619 22.515C121.174 23.1383 121.899 23.45 122.795 23.45C123.35 23.45 123.843 23.3197 124.274 23.059C124.716 22.7983 125.056 22.4187 125.294 21.92H128.49C128.15 23.212 127.475 24.232 126.467 24.98C125.458 25.7167 124.245 26.085 122.829 26.085C121.673 26.085 120.636 25.83 119.718 25.32C118.811 24.7987 118.103 24.079 117.593 23.161C117.083 22.243 116.828 21.1947 116.828 20.016ZM133.177 14.066V26H130.27V14.066H133.177ZM138.19 23.756H141.998V26H135.283V14.066H138.19V23.756Z"
                            fill="#C0EC1D" />
                    </svg>

                </a>

                <nav class="mt-8 flex flex-col gap-1">
                    <x-site.sidebar-link :href="route('v1.dashboard')" :active="request()->routeIs('v1.dashboard')"
                        icon='<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 13h6V4H4v9Zm0 7h6v-5H4v5Zm10 0h6V11h-6v9Zm0-16v5h6V4h-6Z"/></svg>'>
                        Dashboard
                    </x-site.sidebar-link>
                    <x-site.sidebar-link :href="route('v1.alunos.index')" :active="request()->routeIs('v1.alunos.*')"
                        icon='<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 19V6a2 2 0 0 1 2-2h6l2 2h6a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2Z"/></svg>'>
                        Alunos
                    </x-site.sidebar-link>
                    <x-site.sidebar-link :href="route('v1.vagas.index')" :active="request()->routeIs('v1.vagas.*')"
                        icon='<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-6-3V4l6 3 6-3 6 3v13l-6-3-6 3Zm0 0V7m6 13V10"/></svg>'>
                        Vagas
                    </x-site.sidebar-link>
                    <x-site.sidebar-link href="{{ route('mapa') }}"
                        icon='<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 3 4 6v15l5-3 6 3 5-3V3l-5 3-6-3Zm0 3v12m6-9v12"/></svg>'>
                        Mapa interativo
                    </x-site.sidebar-link>

                    <p
                        class="mt-4 px-3.5 font-body text-[11px] font-semibold uppercase tracking-wide text-seduc-neutral-500">
                        Em breve</p>
                    <span
                        class="flex cursor-not-allowed items-center gap-3 rounded-xl px-3.5 py-2.5 font-body text-sm font-medium text-seduc-neutral-500/70"
                        title="Funcionalidade ainda não disponível">
                        <span class="flex size-5 items-center justify-center"><svg viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4 19h16M7 19V9m5 10V5m5 14v-7" />
                            </svg></span>
                        Relatórios
                    </span>
                    <span
                        class="flex cursor-not-allowed items-center gap-3 rounded-xl px-3.5 py-2.5 font-body text-sm font-medium text-seduc-neutral-500/70"
                        title="Funcionalidade ainda não disponível">
                        <span class="flex size-5 items-center justify-center"><svg viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="3" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09a1.65 1.65 0 0 0-1.08-1.51 1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09a1.65 1.65 0 0 0 1.51-1.08 1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1Z" />
                            </svg></span>
                        Configurações
                    </span>
                </nav>
            </div>

            <form method="GET" action="{{ route('site.search') }}">
                <button type="submit"
                    class="flex w-full items-center gap-3 rounded-xl px-3.5 py-2.5 font-body text-sm font-medium text-seduc-neutral-300 hover:bg-white/5 hover:text-white">
                    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 17l5-5-5-5M20 12H9M12 19H6a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h6" />
                    </svg>
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