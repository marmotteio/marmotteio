<x-filament-panels::layout.base :livewire="$livewire">
    @props([
        'after' => null,
        'heading' => null,
        'subheading' => null,
    ])

    <style>
        .split-layout {
            display: flex;
            height: 100vh;
        }

        .split-layout > div {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .split-layout .left-section {
            flex: 1 1 25%;
        }

        .split-layout .right-section {
            flex: 1 1 75%;
        }

        :root {
            --primary-600: #d2d04a;
            --primary-500: #a2a035;
        }

        .right-section {
            --c-500: var(--primary-500);
            --c-600: var(--primary-600);
            background: linear-gradient(to bottom, var(--primary-600), var(--primary-500)) !important;
        }
    </style>

    <div class="fi-simple-layout dark">
        <div class="fi-simple-main-ctn">
            <main class="fi-simple-main">
                <div class="split-layout">
                    <div class="left-section bg-black">
                        {{ $slot }}
                    </div>

                    <div class="right-section">
                        <div class="text-center">
                            <h1 class="text-2xl mb-4 text-black font-bold">Welcome back,</h1>
                            <p class="text-black">Log in to access your personalized dashboard and manage your assets.</p>
                        </div>
                    </div>
                </div>
            </main>
        </div>

        {{ \Filament\Support\Facades\FilamentView::renderHook('panels::footer') }}
    </div>
</x-filament-panels::layout.base>
