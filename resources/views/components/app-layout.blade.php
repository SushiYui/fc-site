<div>
    @include('layouts.navigation', ['navColor' => $navColor ?? null])

    @isset($header)
        <header class="bg-gray-100">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endisset

    <main>
        {{ $slot }}
    </main>
</div>
