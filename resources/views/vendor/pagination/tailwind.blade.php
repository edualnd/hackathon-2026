{{-- Paginação com a identidade visual SEDUC (substitui o tema padrão do Laravel) --}}
@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center gap-1.5">

        {{-- Anterior --}}
        @if ($paginator->onFirstPage())
            <span class="flex size-8 items-center justify-center rounded-lg border border-seduc-neutral-200 text-seduc-neutral-400 cursor-not-allowed" aria-hidden="true">
                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 18l-6-6 6-6"/></svg>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="flex size-8 items-center justify-center rounded-lg border border-seduc-neutral-200 text-seduc-neutral-600 transition hover:border-teal-dark-400 hover:text-teal-dark-600" aria-label="{{ __('pagination.previous') }}">
                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 18l-6-6 6-6"/></svg>
            </a>
        @endif

        {{-- Páginas --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="flex size-8 items-center justify-center font-body text-xs font-medium text-seduc-neutral-500">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span aria-current="page" class="flex size-8 items-center justify-center rounded-lg bg-teal-dark-600 font-body text-xs font-semibold text-white">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="flex size-8 items-center justify-center rounded-lg font-body text-xs font-medium text-seduc-neutral-600 transition hover:bg-seduc-neutral-100 hover:text-text-on-surface" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Próxima --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="flex size-8 items-center justify-center rounded-lg border border-seduc-neutral-200 text-seduc-neutral-600 transition hover:border-teal-dark-400 hover:text-teal-dark-600" aria-label="{{ __('pagination.next') }}">
                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 18l6-6-6-6"/></svg>
            </a>
        @else
            <span class="flex size-8 items-center justify-center rounded-lg border border-seduc-neutral-200 text-seduc-neutral-400 cursor-not-allowed" aria-hidden="true">
                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 18l6-6-6-6"/></svg>
            </span>
        @endif
    </nav>
@endif
