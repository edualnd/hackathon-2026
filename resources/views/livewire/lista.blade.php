<div class="grid grid-cols-3 gap-4">
    @foreach ($escolas as $escola)
        <div class="rounded-2xl border border-white/15 bg-white/10 p-5 shadow-[0_8px_32px_-8px_rgba(0,0,0,0.35)] backdrop-blur-md">
            <div class="flex items-start justify-between gap-3">
                <div>
                    <p class="font-heading text-base font-semibold text-text-on-canvas">{{ $escola['nome'] }}</p>
                </div>                
            </div>

            <div class="mt-2 flex flex-col items-center gap-4 border-t border-white/10 pt-3 font-body text-xs text-white/70">
                
                <div class="flex flex-col items-center">
                    <strong class="text-[2.25rem] text-glow font-semibold" style="color: rgb(192, 236, 29)">20</strong>
                    <small class="text-[14px] font-semibold" style="color: rgb(192, 236, 29)">vagas disponíveis</small>
                </div>

                <span class="flex items-center gap-1.5 self-start">
                    <svg class="size-4 text-teal-dark-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21c-4.5-4.2-7.5-7.7-7.5-11.2A7.5 7.5 0 0 1 12 2.3a7.5 7.5 0 0 1 7.5 7.5C19.5 13.3 16.5 16.8 12 21Z"/><circle cx="12" cy="9.8" r="2.5"/></svg>
                    {{ $escola['bairro'] . " · " . $escola['endereco'] }}
                </span>
            </div>
        </div>
    @endforeach
</div>
