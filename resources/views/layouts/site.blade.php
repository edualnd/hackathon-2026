<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $pageTitle ?? 'Central de Vagas' }} · SEDUC</title>

        <!-- Fontes do Design System (Fundamentos): Poppins (headings), Inter (body), JetBrains Mono (dados) -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

        @stack('styles')

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="relative min-h-screen bg-fixed bg-gradient-to-br from-background-canvas-primary via-background-canvas-secondary to-background-canvas-tertiary font-body text-text-on-surface antialiased pb-20 sm:pb-0">
        <x-site.topbar :title="$pageTitle ?? null" :back="$back ?? null" />

           <div class="absolute inset-0 opacity-[0.06] pointer-events-none" aria-hidden="true">
            <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
                        <path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="1"></path>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#grid)"></rect>
            </svg>
        </div>

        <main>
            {{ $slot }}
        </main>

        <footer class="hidden border-t border-seduc-neutral-200 bg-seduc-neutral-100/60 px-4 py-8 font-body text-xs text-seduc-neutral-600 sm:block">
            <div class="mx-auto max-w-5xl">
                <p>© {{ date('Y') }} SEDUC · Secretaria de Educação de Caraguatatuba · Todos os direitos reservados</p>
                <p class="mt-1">Dados exibidos nesta tela são simulados para fins de demonstração.</p>
            </div>
        </footer>

        @stack('scripts')
        @livewireScripts
    </body>
</html>
