<x-form-section submit="register">
    <x-slot name="title">
        <div class="space-y-2">
            <h2 class="text-xl text-gray-900 dark:text-white">Criar Conta</h2>
        </div>
    </x-slot>

    <x-slot name="description">
        <p class="text-sm text-gray-600 dark:text-gray-400">Preencha os dados abaixo para criar uma conta para servidores.</p>
    </x-slot>

    <x-slot name="form">
        <!-- Nome -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="Nome" />
            <x-input wire:model="name" class="mt-1 block w-full" />
        </div>

        <!-- CPF -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="cpf" value="CPF" />
            <x-input wire:model="cpf" class="mt-1 block w-full" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-label for="email" value="Email" />
            <x-input wire:model="email" class="mt-1 block w-full" />
        </div>

        <!-- ROLE -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="role" value="Função" />

            <x-site.select
                wire:model.live="role"
                id="role"
                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white rounded-md shadow-sm"
            >
                <option value="">Selecione</option>
                <option value="demanda">Demanda</option>
                <option value="administracao">Administração</option>
            </x-site.select>
        </div>

        <!-- ESCOLA -->
        @if ($role !== 'demanda')
            <div class="col-span-6 sm:col-span-4">
                <x-label for="escola_id" value="Escola" />

                <x-site.select
                    wire:model="escola_id"
                    id="escola_id"
                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white rounded-md shadow-sm"
                >
                    <option value="">Selecione uma escola</option>

                    @foreach ($escolas as $escola)
                        <option value="{{ $escola->id }}">{{ $escola->nome }}</option>
                    @endforeach
                </x-site.select>
            </div>
            @else  @php
                $escola_id = null;
            @endphp
        @endif

        <!-- Senha -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="password" value="Senha" />
            <x-input type="password" wire:model="password" class="mt-1 block w-full" />
        </div>

        <!-- Confirmar -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="password_confirmation" value="Confirmar Senha" />
            <x-input type="password" wire:model="password_confirmation" class="mt-1 block w-full" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-button wire:loading.attr="disabled"> Criar conta  </x-button>
    </x-slot>
    
</x-form-section>
