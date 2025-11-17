<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold text-gray-800 leading-tight">
      MOVIE詳細
    </h2>
  </x-slot>

  <div class="py-8 max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">
    <h3 class="text-2xl font-bold">{{ $movie->title }}</h3>
    <p class="text-sm text-gray-600">{{ $movie->category }} / 公開日：{{ \Carbon\Carbon::parse($movie->released_at)->format('Y年n月j日') }}</p>

    <div class="aspect-w-16 aspect-h-9">
      <iframe class="w-full h-full"
              src="{{ $movie->url }}"
              frameborder="0"
              allowfullscreen></iframe>
    </div>

    <div class="mt-4">
      <a href="{{ route('movies.index') }}" class="text-indigo-600 hover:underline">← MOVIE一覧へ戻る</a>
    </div>
  </div>
</x-app-layout>
