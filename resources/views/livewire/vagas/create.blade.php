<div>
    <x-modal wire:model="show" maxWidth="lg">
        <div class="px-6 py-6">
            <p class="font-body text-[11px] font-semibold uppercase tracking-wide text-seduc-neutral-500">Vagas</p>
            <h2 class="mt-0.5 font-heading text-lg font-semibold text-text-on-surface">Nova vaga</h2>
            <p class="mt-1 font-body text-sm text-seduc-neutral-600">Defina a escola, a série e a quantidade de vagas disponíveis.</p>

            <form wire:submit.prevent="salvar" class="mt-5 space-y-4">
                <div>
                    <x-site.input label="Escola" name="vaga_create_escola_id" value="{{ $escola['nome'] }}" readonly>
                        
                    </x-site.input>
                    
                </div>

                <div>
                    <x-site.select label="Série" name="vaga_create_serie" wire:model="vaga.serie">
                        <option value="">Selecione...</option>
                        @foreach ($series as $serie)
                            <option value="{{ $serie }}">{{ $serie }}</option>
                        @endforeach
                    </x-site.select>
                    @error('vaga.serie') <p class="mt-1.5 font-body text-xs text-text-on-danger">{{ $message }}</p> @enderror
                </div>

                <x-site.input label="Quantidade de vagas" name="vaga_create_qtd" type="number" min="0" wire:model="vaga.qtd" :error="$errors->first('vaga.qtd')" />

                <div class="flex flex-col-reverse gap-3 pt-2 sm:flex-row sm:justify-end">
                    <x-site.button type="button" variant="ghost" wire:click="$set('show', false)">Cancelar</x-site.button>
                    <x-site.button type="submit" variant="primary" wire:loading.attr="disabled" wire:target="salvar">
                        <span wire:loading.remove wire:target="salvar">Salvar vaga</span>
                        <span wire:loading wire:target="salvar">Salvando...</span>
                    </x-site.button>
                </div>
            </form>
        </div>
    </x-modal>
</div>
