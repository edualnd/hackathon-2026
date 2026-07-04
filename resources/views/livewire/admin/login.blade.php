<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Acesso Administrativo · SEDUC</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="min-h-screen font-body antialiased" style="background: linear-gradient(135deg, #0C4646 0%, #117D7D 45%, #97BC10 100%);">
        <div class="flex min-h-screen items-center justify-center px-4 py-10">
            <div class="w-full max-w-md">

                <div class="mb-6 flex items-center justify-center gap-2.5">
                    <span class="relative flex size-11 items-center justify-center rounded-xl bg-action-primary">
                        <span class="size-3.5 rotate-45 rounded-[3px] bg-teal-dark-700"></span>
                    </span>
                    <span class="leading-tight text-white">
                        <span class="block font-heading text-lg font-bold">SEDUC</span>
                        <span class="block font-body text-xs text-white/80">Painel Administrativo</span>
                    </span>
                </div>

                <div class="rounded-2xl border border-white/25 bg-white/12 p-8 shadow-2xl backdrop-blur-xl">
                    <h1 class="font-heading text-xl font-semibold text-white">Acessar o painel</h1>
                    <p class="mt-1 font-body text-sm text-white/75">Informe suas credenciais institucionais para continuar.</p>

                    @if ($errors->any())
                        <div class="mt-4 rounded-xl bg-feedback-danger px-4 py-3 font-body text-sm text-text-on-danger">
                            Verifique os campos destacados abaixo.
                        </div>
                    @endif

                    <form wire:submit.prevent="entrar" class="mt-6 space-y-4">
                        <div>
                            <label for="email" class="mb-1.5 block font-body text-sm font-medium text-white/90">E-mail institucional</label>
                            <input id="email" type="email" wire:model="email" placeholder="nome@educacaocaraguatatuba.sp.gov.br"
                                class="w-full rounded-xl border border-white/30 bg-white/10 px-4 py-3 font-body text-sm text-white placeholder:text-white/50 focus:outline-none focus:ring-2 focus:ring-white/60">
                            @error('email') <p class="mt-1.5 font-body text-xs text-amber-200">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="senha" class="mb-1.5 block font-body text-sm font-medium text-white/90">Senha</label>
                            <input id="senha" type="password" wire:model="senha" placeholder="••••••••"
                                class="w-full rounded-xl border border-white/30 bg-white/10 px-4 py-3 font-body text-sm text-white placeholder:text-white/50 focus:outline-none focus:ring-2 focus:ring-white/60">
                            @error('senha') <p class="mt-1.5 font-body text-xs text-amber-200">{{ $message }}</p> @enderror
                        </div>

                        <button type="submit"
                            class="w-full rounded-full bg-action-primary px-5 py-3 font-body text-sm font-semibold text-teal-dark-700 transition hover:bg-action-primary-hover">
                            Entrar
                        </button>
                    </form>

                    <p class="mt-5 text-center font-body text-xs text-white/60">
                        Acesso restrito à equipe da Secretaria de Educação. Ambiente de demonstração — sem autenticação real.
                    </p>
                </div>

                <p class="mt-6 text-center font-body text-xs text-white/70">
                    <a href="{{ route('site.search') }}" class="hover:underline">← Voltar para a área dos pais</a>
                </p>
            </div>
        </div>

        @livewireScripts
    </body>
</html>
