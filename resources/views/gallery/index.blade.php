{{-- resources/views/blogs/index.blade.php --}}
@extends('layouts.app', ['navColor' => 'bg-white'])
@section('content')
    <x-slot name="header">
        <h2 class="report-title font-semibold leading-tight text-gray-800">
            PHOTO GALLERY
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:rounded-lg p-6">

                @if(session('success'))
                    <div class="mb-4 text-green-600">
                        {{ session('success') }}
                    </div>
                @endif

                @foreach($gallerys as $gallery)
                    <div class="mb-8 pb-4">
                        {{-- 画像 --}}
                        <img src="{{ asset('storage/' . $gallery->image_path) }}" alt="うさぎ画像" class="w-full max-w-md mb-4 rounded-xl">
                        {{-- 投稿日 --}}
                        <p class="text-[11px] text-gray-500">{{ $gallery->created_at->format('Y年m月d日') }}</p>

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
@endsection
