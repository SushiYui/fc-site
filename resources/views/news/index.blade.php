<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      お知らせ一覧
    </h2>
  </x-slot>

  <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
    @foreach ($news as $item)
      <div class="mb-4 p-4 bg-white shadow rounded">
        <a href="{{ route('news.show', $item->id) }}" class="text-lg font-bold text-blue-600 hover:underline">
          {{ $item->title }}
        </a>
        <p class="text-sm text-gray-500">{{ $item->published_at->format('Y年m月d日') }}</p>
      </div>
    @endforeach

    <div class="mt-6">{{ $news->links() }}</div>
  </div>
</x-app-layout>
