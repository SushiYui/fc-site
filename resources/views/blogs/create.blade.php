{{-- resources/views/blogs/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            ブログ新規投稿
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto py-8">
        <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- タイトル --}}
            <div>
                <label class="block font-medium text-sm text-gray-700" for="title">タイトル</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('title')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- 本文 --}}
            <div>
                <label class="block font-medium text-sm text-gray-700" for="body">本文</label>
                <textarea name="body" id="body" rows="5"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('body') }}</textarea>
                @error('body')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- 画像 --}}
            <div>
                <label class="block font-medium text-sm text-gray-700" for="image">画像</label>
                <input type="file" name="image" id="image"
                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                           file:rounded-md file:border-0 file:text-sm file:font-semibold
                           file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                @error('image')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- 送信 --}}
            <div>
                <button type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">
                    投稿する
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
