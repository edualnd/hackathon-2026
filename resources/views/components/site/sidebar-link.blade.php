@props(['href', 'active' => false, 'icon' => null])

<a href="{{ $href }}"
   class="flex items-center gap-3 rounded-xl px-3.5 py-2.5 font-body text-sm font-medium transition
        {{ $active ? 'bg-white/10 text-white' : 'text-seduc-neutral-300 hover:bg-white/5 hover:text-white' }}">
    <span class="flex size-5 items-center justify-center">{!! $icon !!}</span>
    {{ $slot }}
</a>
