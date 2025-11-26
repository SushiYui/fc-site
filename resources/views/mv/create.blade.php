@extends('layouts.app')

@section('content')  <x-slot name="header">
    <h2 class="text-xl font-semibold text-gray-800 leading-tight">
      MV新規投稿
    </h2>
  </x-slot>

  <div class="py-8 max-w-3xl mx-auto sm:px-6 lg:px-8">
    <form action="{{ route('mv.store') }}" method="POST">
      @csrf

      <div class="mb-4">
        <label for="title" class="block text-sm font-medium">タイトル</label>
        <input type="text" name="title" id="title" value="{{ old('title') }}" required
               class="mt-1 block w-full border rounded p-2">
      </div>

      <div class="mb-4">
        <label for="category" class="block text-sm font-medium">カテゴリー</label>
        <input type="text" name="category" id="category" value="{{ old('category') }}" required
               class="mt-1 block w-full border rounded p-2">
      </div>

      <div class="mb-4">
        <label for="url" class="block text-sm font-medium">YouTube埋め込みURL</label>
        <input type="text" name="url" id="url" value="{{ old('url') }}" required
               class="mt-1 block w-full border rounded p-2">
        <p class="text-sm text-gray-500 mt-1">例：https://www.youtube.com/embed/XXXXXXXX</p>
      </div>

      <div class="mb-4">
        <label for="released_at" class="block text-sm font-medium">公開日</label>
        <input type="date" name="released_at" id="released_at" value="{{ old('released_at') }}" required
               class="mt-1 block w-full border rounded p-2">
      </div>

      <button type="submit"
              class="bg-green-600 text-black px-4 py-2 rounded hover:bg-green-700">
        投稿する
      </button>
    </form>
  </div>
@endsection
