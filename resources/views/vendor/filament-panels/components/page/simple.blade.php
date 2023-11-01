@props([
    'heading' => null,
    'subheading' => null,
])

<div {{ $attributes->class(['fi-simple-page', 'w-full',]) }} style="padding-left: 3rem; padding-right: 3rem;">
    <h1 class="text-2xl font-bold text-center mb-5">Marmotte.io</h1>
    <br/>
    <section class="grid auto-cols-fr gap-y-6">
        {{ $slot }}
    </section>

    @if (! $this instanceof \Filament\Tables\Contracts\HasTable)
        <x-filament-actions::modals />
    @endif
</div>
