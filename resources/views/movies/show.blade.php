@extends('layouts.app')

@section('content')  <x-slot name="header">
    <h2 class="text-xl font-semibold text-gray-800 leading-tight">
      MOVIE詳細
    </h2>
  </x-slot>

  <div class="py-8 max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">
    <h3 class="text-2xl font-bold">{{ $movie->title }}</h3>

    <div class="aspect-w-16 aspect-h-9">
        <video controls class="w-full">
            <source src="{{ Storage::url($movie->video_path) }}" type="video/mp4">
        </video>
    </div>

    <div class="mt-4">
      <a href="{{ route('movies.index') }}" class="text-indigo-600 hover:underline">← MOVIE一覧へ戻る</a>
    </div>
  </div>
@endsection
