<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center p-8 bg-slate-100">
        <div class="w-full max-w-7xl h-[720px] rounded-3xl overflow-hidden shadow-2xl flex">
            {{-- Lado Esquerdo --}}
            <div
                class="hidden lg:flex w-2/3 relative overflow-hidden bg-gradient-to-br from-background-canvas-primary via-background-canvas-secondary to-background-canvas-tertiary"
            >
                {{-- Formas decorativas --}}
                <div class="absolute top-0 left-0 w-72 h-72 rounded-br-[120px] bg-white/10"></div>
                <div
                    class="absolute bottom-0 right-0 w-72 h-72 rounded-tl-[120px] bg-white/10"
                ></div>
                <div class="absolute top-1/3 left-12 w-28 h-28 rounded-3xl bg-white/10"></div>
                <div class="absolute bottom-24 right-24 w-40 h-40 rounded-3xl bg-white/10"></div>

                <div class="relative z-10 flex flex-col justify-center px-20 text-white">
                    <h1 class="text-6xl font-bold mb-6">Bem-vindo!</h1>

                    <p class="text-xl max-w-lg text-white/90 leading-relaxed">Acesse o painel administrativo da Secretaria Municipal de Educação e gerencie todas as informações do sistema com segurança.</p>
                </div>
            </div>

            {{-- Lado Direito --}}
            <div class="w-full lg:w-1/3 bg-white flex items-center justify-center px-12">
                <div class="w-full max-w-sm">
                    {{-- Logo --}}
                    <div class="flex flex-col items-center mb-10">
                        <x-logo class="w-60 h-60 mb-5" />

                        <p class="text-gray-500 mt-2">Faça login para continuar</p>
                    </div>

                    <x-validation-errors class="mb-5" />

                    @session ('status')
                        <div class="mb-4 text-green-600 text-sm">{{ $value }}</div>
                    @endsession

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        {{-- CPF --}}
                        <div class="mb-5">
                            <x-label for="cpf" value="CPF" class="mb-2" />

                            <x-input
                                id="cpf"
                                class="w-full rounded-xl"
                                type="text"
                                name="cpf"
                                :value="old('cpf')"
                                required
                                autofocus
                            />
                        </div>

                        {{-- Senha --}}
                        <div class="mb-6">
                            <x-label for="password" value="Senha" class="mb-2" />

                            <x-input
                                id="password"
                                class="w-full rounded-xl"
                                type="password"
                                name="password"
                                required
                            />
                        </div>

                        {{-- Lembrar --}}
                        <div class="flex items-center justify-between mb-6">
                            <label class="flex items-center">
                                <x-checkbox name="remember" />

                                <span class="ml-2 text-sm text-gray-600"> Lembrar-me </span>
                            </label>

                            @if (Route::has('password.request'))
                                <a
                                    href="{{ route('password.request') }}"
                                    class="text-sm text-teal-700 hover:underline"
                                >
                                    Esqueceu a senha?
                                </a>
                            @endif
                        </div>

                        <x-button class="w-full justify-center rounded-xl py-3 text-base">
                            Entrar
                        </x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
