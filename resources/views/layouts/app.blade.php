<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        {{-- Font Awesome --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

        {{-- Swiper --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased relative overflow-x-hidden">

        {{-- ▼ ページ専用の背景（blogs/index から挿入される） --}}
        @yield('page-bg')

        {{-- ▼ メインコンテンツ（背景より前に表示したいので relative z-10） --}}
        <div class="min-h-screen relative z-10">

            @include('layouts.navigation', ['navColor' => $navColor ?? null])

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-transparent"> {{-- 背景を透過に変更 --}}
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="bg-transparent"> {{-- ここも透過に変更 --}}
                @yield('content')
            </main>
        </div>
    </body>
</html>
