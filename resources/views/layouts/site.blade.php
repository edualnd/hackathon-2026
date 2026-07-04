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
    <body class="relative min-h-screen bg-fixed bg-gradient-to-br from-background-canvas-primary via-background-canvas-secondary to-background-canvas-tertiary font-body text-text-on-surface antialiased">
        <x-site.topbar :title="$pageTitle ?? null" :back="$back ?? null" />

            <div class="absolute w-full h-full overflow-hidden">
                
                   <svg xmlns="http://www.w3.org/2000/svg" width="1000" height="1000" viewBox="0 0 1000 1000">
                    <g stroke="#FFFFFF" stroke-width="1" opacity="0.12">
                        <line x1="0" y1="0" x2="1000" y2="0"></line>
                        <line x1="0" y1="100" x2="1000" y2="100"></line>
                        <line x1="0" y1="200" x2="1000" y2="200"></line>
                        <line x1="0" y1="300" x2="1000" y2="300"></line>
                        <line x1="0" y1="400" x2="1000" y2="400"></line>
                        <line x1="0" y1="500" x2="1000" y2="500"></line>
                        <line x1="0" y1="600" x2="1000" y2="600"></line>
                        <line x1="0" y1="700" x2="1000" y2="700"></line>
                        <line x1="0" y1="800" x2="1000" y2="800"></line>
                        
                        <line x1="0" y1="0" x2="0" y2="1000"></line>
                        <line x1="100" y1="0" x2="100" y2="1000"></line>
                        <line x1="200" y1="0" x2="200" y2="1000"></line>
                        <line x1="300" y1="0" x2="300" y2="1000"></line>
                        <line x1="400" y1="0" x2="400" y2="1000"></line>
                        <line x1="500" y1="0" x2="500" y2="1000"></line>
                        <line x1="600" y1="0" x2="600" y2="1000"></line>
                        <line x1="700" y1="0" x2="700" y2="1000"></line>
                        <line x1="800" y1="0" x2="800" y2="1000"></line>
                        <line x1="900" y1="0" x2="900" y2="1000"></line>
                        
                    </g>
                    </svg>
            </div>

        <main>
            {{ $slot }}
        </main>

        <footer class="border-t border-seduc-neutral-200 bg-seduc-neutral-100/60 px-4 py-8 font-body text-xs text-seduc-neutral-600">
            <div class="mx-auto max-w-5xl">
                <p>© {{ date('Y') }} SEDUC · Secretaria de Educação de Caraguatatuba · Todos os direitos reservados</p>
                <p class="mt-1">Dados exibidos nesta tela são simulados para fins de demonstração.</p>
            </div>
        </footer>

        @stack('scripts')
        @livewireScripts
    </body>
</html>
