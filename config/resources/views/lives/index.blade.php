<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold text-gray-800 leading-tight">
      ライブ一覧
    </h2>
  </x-slot>

  <div class="py-8 max-w-6xl mx-auto sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach ($lives as $live)
        <a href="{{ route('lives.show', $live->id) }}"
           class="block bg-white rounded-xl shadow p-4 hover:bg-gray-50 transition">
          @if ($live->image_path)
            <img src="{{ asset('storage/' . $live->image_path) }}"
                 alt="{{ $live->title }}"
                 class="w-full h-48 object-cover rounded mb-3">
          @endif
          <h3 class="text-lg font-bold">{{ $live->title }}</h3>
          <p class="text-sm text-gray-600">📅 {{ $live->date }}</p>
          <p class="text-sm text-gray-600">📍 {{ $live->place }}</p>
        </a>
      @endforeach
    </div>

    {{-- ページネーション --}}
    <div class="mt-6">
      {{ $lives->links() }}
    </div>
  </div>
</x-app-layout>
