@props([
    'heading' => null,
    'subheading' => null,
])

<div {{ $attributes->class(['fi-simple-page', 'w-full',]) }} style="padding-left: 3rem; padding-right: 3rem;">
    <img src="{{ asset('logo.svg') }}" width="90%" />
    <br/>
    <br/>
    <section class="grid auto-cols-fr gap-y-6">
        {{ $slot }}
    </section>

    @if (! $this instanceof \Filament\Tables\Contracts\HasTable)
        <x-filament-actions::modals />
    @endif
</div>
