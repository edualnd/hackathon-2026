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
    <body class="min-h-screen bg-background-surface font-body text-text-on-surface antialiased">
        <x-site.topbar :title="$pageTitle ?? null" :back="$back ?? null" />

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
