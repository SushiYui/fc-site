@extends('layouts.app', ['navColor' => 'bg-transparent'])

@section('content')
<div class="py-8 max-w-6xl mx-auto sm:px-6 lg:px-8">

    <h2 class="text-[30px] mb-[30px] font-bold text-[#002928] leading-tight">
      Video
    </h2>

    {{-- カテゴリーで絞り込み --}}
    <div class="flex flex-wrap justify-center gap-2 my-2">

        {{-- ALL --}}
        <a href="{{ route('mv.index') }}"
        class="px-4 py-1 rounded-full text-sm transition
        {{ is_null($selectedMvCategory)
                ? 'bg-red-200 text-red-900'
                : 'bg-gray-100 text-black' }}">
            All
        </a>

        {{-- 各カテゴリー --}}
        @foreach($categories as $category)
            <a href="{{ route('mv.index', ['category' => $category]) }}"
            class="px-4 py-1 rounded-full text-sm transition
            {{ $selectedMvCategory === $category
                    ? 'bg-blue-200 text-blue-900'
                    : 'bg-gray-100 text-black' }}">
                {{ ucfirst($category) }}
            </a>
        @endforeach
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach ($mvs as $mv)
        <div class="bg-white p-4 max-w-[320px]">
          <div class="aspect-w-16 aspect-h-9 mb-3">
            <iframe class="w-full h-full rounded-xl"
                    src="{{ $mv->url }}"
                    frameborder="0"
                    allowfullscreen></iframe>
          </div>
          <p class="text-sm text-[#64860E]"> {{ $mv->category }}</p>
           <h3 class="text-lg font-bold mb-1">{{ $mv->title }}</h3>
          <p class="text-sm text-[#64860E]"> {{ \Carbon\Carbon::parse($mv->released_at)->format('Y.n.j') }}</p>
        </div>
      @endforeach
    </div>

    {{-- ページネーション --}}
    <div class="mt-6">
      {{ $mvs->links() }}
    </div>
  </div>
@endsection
