{{-- resources/views/movie/index.blade.php --}}
@extends('layouts.app', ['navColor' => 'bg-transparent'])
    @section('page-bg')
    <div class="absolute inset-0 bg-[#006360cc] z-0"></div> {{-- 背景色 --}}

    <div class="absolute inset-0 overflow-hidden z-0 pointer-events-none">
        <div class="absolute w-[55vw] h-[55vw] right-[-10vw] top-[-5vw]
            rounded-[800px] bg-[#BCE670] opacity-30 blur-[70px]"></div>

        <div class="absolute w-[55vw] h-[55vw] left-[-10vw] top-[70vw]
            rounded-[800px] bg-[#A4CE7A] opacity-50 blur-[70px]"></div>
    </div>
    @endsection

@section('content')

    {{-- 最新MOVIE --}}
    @if($newMovie)
    <div class="my-10">
        <div class="aspect-w-16 aspect-h-9 mb-3 rounded-xl shadow">
        <iframe class="w-full h-full"
                src="{{ $newMovie->url }}"
                frameborder="0"
                allowfullscreen></iframe>
        </div>

        <h3 class="text-lg font-bold mb-1 text-white">{{ $newMovie->title }}</h3>
        <p class="text-xs text-[#DDFFA2]">
            <span>{{ $newMovie->released_at->format('Y') }}</span>
            <span>{{ $newMovie->released_at->format('m') }}</span>
            <span>{{ $newMovie->released_at->format('d') }}</span>
            ({{ strtoupper($newMovie->released_at->format('D')) }})
        </p>

    </div>
    @endif


    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6"> --}}

                @if(session('success'))
                    <div class="mb-4 text-green-600">
                        {{ session('success') }}
                    </div>
                @endif

        <h1 class="font-bold leading-tight text-[25px] text-white my-5">
            MORE MOVIES</h1>

                    @foreach ($movies as $movie)
                            <div class="aspect-w-16 aspect-h-9 mb-3 rounded-xl shadow">
                                <iframe class="w-full h-full"
                                        src="{{ $movie->url }}"
                                        frameborder="0"
                                        allowfullscreen></iframe>
                            </div>
                            <h3 class="text-lg font-bold mb-1 text-white">{{ $movie->title }}</h3>
                            <p class="text-xs text-[#DDFFA2]">
                                <span>{{ $movie->released_at->format('Y') }}</span>
                                <span>{{ $movie->released_at->format('m') }}</span>
                                <span>{{ $movie->released_at->format('d') }}</span>
                                ({{ strtoupper($movie->released_at->format('D')) }})
                            </p>

            {{-- </div> --}}
                @endforeach

                {{-- ページネーション --}}
                <div class="mt-6">
                    {{ $movies->links() }}
               </div>

        </div>
    </div>
@endsection
