<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ $liveItem->title }}
    </h2>
  </x-slot>

{{-- 表示エリア --}}
  <div id="live-display">
    @if ($liveItem->image_path)
        <img src="{{ asset('storage/' . $liveItem->image_path) }}" alt="{{ $liveItem->title }}">
    @endif

    <div>
      <p><strong>日程:</strong> {{ $liveItem->date }}</p>
      <p><strong>場所:</strong> {{ $liveItem->place }}</p>
      <p><strong>チケット情報:</strong> {!! nl2br(e($liveItem->ticket_info)) !!}</p>
      <p class="mt-4">{{ $liveItem->description }}</p>
    </div>
  </div>

  {{-- 編集モード --}}
    @if(Auth::user()->admin)
    <div id="live-edit" style="display: none;">
        <form action="{{ route('live.update', $liveItem->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

        @if ($liveItem->image_path)
        <img src="{{ asset('storage/' . $liveItem->image_path) }}" alt="{{ $liveItem->title }}" class="w-full rounded-xl shadow">
        @endif
        <input type="file" name="image_path" class="w-full rounded-xl shadow">
        <input type="text" name="live_title" value="{{ $liveItem->title }}" class="border p-2 w-full mb-2">
        <input type="text" name="live_date" value="{{ $liveItem->date }}" class="border p-2 w-full mb-2">
        <textarea name="live_description" class="border p-2 w-full mb-2" rows="8">{{ $liveItem->description }}</textarea>
        <input type="text" name="live_place" value="{{ $liveItem->place }}" class="border p-2 w-full mb-2">
        <textarea name="ticket_info" class="border p-2 w-full mb-2" rows="8">{{ $liveItem->ticket_info }}</textarea>

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

        <form action="{{ route('live.destroy', $liveItem->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="button"
                class="inline-flex items-center px-4 py-2 bg-indigo-600 border rounded-md font-semibold hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            削除
        </button>
        </form>
    </div>
    @endif

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(function () {
    $('#edit-button').on('click', function () {
      $('#live-display').hide();
      $('#live-edit').fadeIn();
    });

    $('#cancel-edit').on('click', function () {
      $('#live-edit').hide();
      $('#live-display').fadeIn();
    });
  });
</script>


</x-app-layout>
