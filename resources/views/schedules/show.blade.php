<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      スケジュール詳細
    </h2>
  </x-slot>

  <div class="max-w-2xl mx-auto py-8 px-4">
    <div id="schedule-display" class="bg-white rounded-lg shadow-md p-6 space-y-4">

      {{-- 日付 --}}
      <div>
        <h3 class="text-sm text-gray-500">日付</h3>
        <p class="text-lg text-gray-800 font-semibold">
          {{ $scheduleItem->date->format('Y年m月d日') }}
        </p>
      </div>

      {{-- カテゴリ --}}
      <div>
        <h3 class="text-sm text-gray-500">カテゴリ</h3>
        <p class="inline-block px-2 py-1 bg-blue-100 text-blue-700 rounded">
          {{ ucfirst($scheduleItem->category) }}
        </p>
      </div>

      {{-- タイトル --}}
      <div>
        <h3 class="text-sm text-gray-500">タイトル</h3>
        <p class="text-lg font-bold text-gray-900">
          {{ $scheduleItem->title }}
        </p>
      </div>

      {{-- 詳細 --}}
      <div>
        <h3 class="text-sm text-gray-500">詳細</h3>
        <p class="whitespace-pre-line text-gray-800">
          {{ $scheduleItem->detail }}
        </p>
      </div>

      {{-- 戻るボタン --}}
      <div class="pt-4">
        <a href="{{ route('schedules.index') }}"
           class="inline-block bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded">
          ← 一覧に戻る
        </a>
      </div>

    </div>

  {{-- 編集モード --}}
    @if(Auth::user()->admin)
    <div id="schedule-edit" style="display: none;">
        <form action="{{ route('schedules.update', $scheduleItem->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

        <input type="date" name="schedule_date" value="{{ $scheduleItem->date->format('Y-m-d') }}" class="border p-2 w-full mb-2">
        <input type="text" name="schedule_title" value="{{ $scheduleItem->title }}" class="border p-2 w-full mb-2">
        <input type="text" name="schedule_category" value="{{ ucfirst($scheduleItem->category) }}" class="border p-2 w-full mb-2">
        <textarea name="schedule_detail" class="border p-2 w-full mb-2" rows="8">{{ $scheduleItem->detail }}</textarea>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded mr-2">保存</button>
        <button type="button" id="cancel-edit" class="bg-gray-400 text-white px-4 py-2 rounded">キャンセル</button>
      </form>
    </div>

    {{-- ボタン表示 --}}
    <div id="live-display" class="flex justify-end">
        <button type="button" id="edit-button"
                class="inline-flex items-center px-4 py-2 bg-indigo-600 border rounded-md font-semibold hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            編集
        </button>

        <form action="{{ route('schedules.destroy', $scheduleItem->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit"
                class="inline-flex items-center px-4 py-2 bg-red-600 border rounded-md font-semibold hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            削除
        </button>
        </form>
    </div>
    @endif
  </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(function () {
    $('#edit-button').on('click', function () {
      $('#schedule-display').hide();
      $('#schedule-edit').fadeIn();
    });

    $('#cancel-edit').on('click', function () {
      $('#schedule-edit').hide();
      $('#live-display').fadeIn();
    });
  });
</script>

</x-app-layout>
