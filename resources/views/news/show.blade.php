<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight" id="news-title">
      {{ $newsItem->title }}
    </h2>
  </x-slot>

  <div class="py-8 max-w-3xl mx-auto sm:px-6 lg:px-8">
    <p class="text-sm text-gray-500 mb-4" id="news-date">{{ $newsItem->published_at->format('Y年m月d日') }}</p>

{{-- 表示モード --}}
<div id="news-display">
    <div class="prose">{!! nl2br(e($newsItem->body)) !!}</div>
</div>

{{-- 編集モード --}}
    @if(Auth::user()->admin)
    <div id="news-edit" style="display: none;">
        <form action="{{ route('news.update', $newsItem->id) }}">
            @csrf
            @method('PUT')

            <input type="text" name="news_title" value="{{ $newsItem->title }}" class="border p-2 w-full mb-2">
            <textarea name="body" class="border p-2 w-full mb-2" rows="8">{{ $newsItem->body }}</textarea>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded mr-2">保存</button>
            <button type="submit" id="cancel-edit"
             class="bg-green-600 text-white px-4 py-2 rounded mr-2">キャンセル</button>

        </form>
    </div>


    <div class="flex justify-end">
        {{-- <input type="hidden" name="news_id" form="newsButton" value="{{ $newsItem->id }}"> --}}
        <button type="button" id="edit-button"
                class="inline-flex items-center px-4 py-2 bg-indigo-600 border rounded-md font-semibold hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            編集
        </button>

        <form action="{{ route('news.destroy', $newsItem->id) }}">
        @csrf
        @method('DELETE')
        <button type="submit"
                class="inline-flex items-center px-4 py-2 bg-indigo-600 border rounded-md font-semibold hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            削除
        </button>
        </form>
    </div>
    @endif


    <div class="mt-6">
      <a href="{{ route('news.index') }}" class="text-blue-600 hover:underline">← 一覧に戻る</a>
    </div>
  </div>
</x-app-layout>
