{{-- resources/views/blogs/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            うさぎ写真館
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto py-8">
        <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
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
