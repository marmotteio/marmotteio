<x-filament-panels::page.simple>
    <x-filament-panels::form wire:submit="register">
        <p class="text-md p-1 text-gray-400">To proceed, please fill out the default team name in the form provided below.</p>
        {{ $this->form }}

        <x-filament-panels::form.actions
            :actions="$this->getCachedFormActions()"
            :full-width="$this->hasFullWidthFormActions()"
        />
    </x-filament-panels::form>
</x-filament-panels::page.simple>
