{{-- resources/views/blogs/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Gallery
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

            <div class="flex flex-wrap gap-2">
                @foreach($categories as $category)
                    <a href="{{ route('blogs.index', ['category' => $category]) }}"
                    class="px-4 py-1 border rounded bg-gray-100 hover:bg-gray-200 text-sm {{ request('category') === $category ? 'bg-blue-200' : '' }}">
                    {{ $categoryMap[$category] }}
                    </a>
                @endforeach
            </div>


                @foreach($blogs as $blog)
                    <div class="mb-8 border-b pb-4">
                        {{-- 画像 --}}
                        @if($blog->image_path)
                            <img src="{{ asset('storage/' . $blog->image_path) }}" alt="ブログ画像" class="w-full max-w-md mb-4 rounded-xl">
                        @endif
                        {{-- 投稿日 --}}
                        <p class="text-sm text-gray-500">{{ $blog->created_at->format('Y年m月d日') }}</p>

                    </div>
                @endforeach

                {{-- ページネーション --}}
                <div class="mt-6">
                    {{ $blogs->links() }}
                </div>

            </div>
        </div>
    </div>
    </script>
</x-app-layout>
