@extends('layouts.app')

@section('content')  <x-slot name="header">
    <h2 class="text-xl font-semibold text-gray-800 leading-tight">
      MV一覧
    </h2>
  </x-slot>

    <div class="py-8 max-w-6xl mx-auto sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach ($mvs as $mv)
        <div class="bg-white rounded-xl shadow p-4">
          <div class="aspect-w-16 aspect-h-9 mb-3">
            <iframe class="w-full h-full"
                    src="{{ $mv->url }}"
                    frameborder="0"
                    allowfullscreen></iframe>
          </div>
           <h3 class="text-lg font-bold mb-1">{{ $mv->title }}</h3>
          <p class="text-sm text-gray-600"> {{ $mv->category }} / 公開日：{{ \Carbon\Carbon::parse($mv->released_at)->format('Y年n月j日') }}</p>
        </div>
      @endforeach
    </div>

    {{-- ページネーション --}}
    <div class="mt-6">
      {{ $mvs->links() }}
    </div>
  </div>
@endsection
