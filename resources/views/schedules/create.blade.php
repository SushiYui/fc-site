<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      スケジュール新規作成
    </h2>
  </x-slot>

  <div class="max-w-2xl mx-auto py-8 px-4">
    <form action="{{ route('schedules.store') }}" method="POST">
      @csrf

      {{-- 日付 --}}
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">日付</label>
        <input type="date" name="date" value="{{ old('date', $defaultDate) }}"
               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
      </div>

      {{-- カテゴリー --}}
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">カテゴリー</label>
        <select name="category" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
          <option value="">選択してください</option>
          @foreach(['live', 'radio', 'tv', 'magazine', 'release', 'other'] as $cat)
            <option value="{{ $cat }}" {{ old('category') === $cat ? 'selected' : '' }}>
              {{ ucfirst($cat) }}
            </option>
          @endforeach
        </select>
      </div>

      {{-- タイトル --}}
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">タイトル</label>
        <input type="text" name="title" value="{{ old('title') }}"
               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
      </div>

      {{-- 詳細 --}}
      <div class="mb-6">
        <label class="block text-sm font-medium text-gray-700">詳細</label>
        <textarea name="detail" rows="4"
                  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                  required>{{ old('detail') }}</textarea>
      </div>

      {{-- 送信ボタン --}}
      <div class="text-right">
        <button type="submit"
                class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
          投稿する
        </button>
      </div>
    </form>
  </div>
</x-app-layout>
