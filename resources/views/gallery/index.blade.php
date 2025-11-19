{{-- resources/views/blogs/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            うさぎ写真館Vol.
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                @if(session('success'))
                    <div class="mb-4 text-green-600">
                        {{ session('success') }}
                    </div>
                @endif

                @foreach($gallerys as $gallery)
                    <div class="mb-8 border-b pb-4">
                        {{-- 画像 --}}
                        <img src="{{ asset('storage/' . $gallery->image_path) }}" alt="うさぎ画像" class="w-full max-w-md mb-4 rounded-xl">
                        {{-- 投稿日 --}}
                        <p class="text-sm text-gray-500">{{ $gallery->created_at->format('Y年m月d日') }}</p>

                    </div>
                @endforeach

                {{-- ページネーション --}}
                <div class="mt-6">
                    {{ $gallerys->links() }}
                </div>

            </div>
        </div>
    </div>
    </script>
</x-app-layout>
