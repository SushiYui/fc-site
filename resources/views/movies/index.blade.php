{{-- resources/views/movie/index.blade.php --}}
<x-app-layout>

    <div class="py-8 bg-[#006360]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6"> --}}

                @if(session('success'))
                    <div class="mb-4 text-green-600">
                        {{ session('success') }}
                    </div>
                @endif

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

    </script>
</x-app-layout>
