<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      ライブ情報の新規投稿
    </h2>
  </x-slot>

  <div class="py-8 max-w-4xl mx-auto sm:px-6 lg:px-8">
    <form method="POST" action="{{ route('lives.store') }}" enctype="multipart/form-data" class="space-y-6">
      @csrf

      <div>
        <label for="title" class="block font-medium text-sm text-gray-700">タイトル</label>
        <input type="text" name="title" id="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ old('title') }}">
        @error('title') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
      </div>

      <div>
        <label for="description" class="block font-medium text-sm text-gray-700">概要</label>
        <textarea name="description" id="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('description') }}</textarea>
      </div>

      <div>
        <label for="date" class="block font-medium text-sm text-gray-700">日程</label>
        <input type="date" name="date" id="date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ old('date') }}">
        @error('date') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
      </div>

      <div>
        <label for="place" class="block font-medium text-sm text-gray-700">場所</label>
        <input type="text" name="place" id="place" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ old('place') }}">
      </div>

      <div>
        <label for="ticket_info" class="block font-medium text-sm text-gray-700">チケット情報</label>
        <textarea name="ticket_info" id="ticket_info" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('ticket_info') }}</textarea>
      </div>

      <div>
        <label for="image" class="block font-medium text-sm text-gray-700">ライブ画像</label>
        <input type="file" name="image" id="image" class="mt-1 block w-full">
      </div>

      <div>
        <button type="submit" class="bg-blue-600 text-black px-4 py-2 rounded-lg hover:bg-blue-700 transition">
          登録する
        </button>
      </div>
    </form>
  </div>
</x-app-layout>
