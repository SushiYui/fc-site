<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-bold">schedule</h2>  {{-- 1段目 --}}
  </x-slot>

  <div class="py-8 max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">

    {{-- 2段目：月/年 & ナビゲーション --}}
    <div class="flex items-center justify-between">
      <form method="GET" action="{{ route('schedules.index') }}">
        <button name="month" value="{{ $prevMonth }}" class="text-2xl px-2">←</button>
      </form>

      <h3 class="text-lg font-semibold">
        {{ sprintf('%02d', $currentMonth) }}/{{ $currentYear }}
      </h3>

      <form method="GET" action="{{ route('schedules.index') }}">
        <button name="month" value="{{ $nextMonth }}" class="text-2xl px-2">→</button>
      </form>
    </div>

    {{-- 3段目：カテゴリーの絞り込み --}}
    <div class="flex flex-wrap gap-2">
      @foreach($categories as $category)
        <a href="{{ route('schedules.index', ['category' => $category]) }}"
           class="px-4 py-1 border rounded bg-gray-100 hover:bg-gray-200 text-sm {{ request('category') === $category ? 'bg-blue-200' : '' }}">
          {{ ucfirst($category) }}
        </a>
      @endforeach
    </div>

    {{-- 4段目：カレンダー表示 --}}
    <div class="grid grid-cols-7 gap-2 text-center">
    <div class="flex text-black text-center py-2">
        @foreach(['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'] as $day)
        <div class="flex-1 font-bold">{{ $day }}</div>
      @endforeach
    </div>
    <div class="space-y-2"> {{-- 各週の間に縦の余白 --}}
    @foreach($calendar as $week)
        <div class="flex"> {{-- 1週間（7日分）を横並び --}}
        @foreach($week as $day)
            <div class="flex-1 border p-2 text-left">
            <div class="text-xs calendar-day">{{ $day['date']->day }}
                @if(Auth::user()->admin)
                <a href="{{ route('schedules.create', ['date' => $day['date']->format('Y-m-d')] ) }}">＋新規投稿</a>
                @endif
            </div>
            @foreach($day['schedules'] as $schedule)
                <div class="mt-1 text-xs">
                <a href="{{ route('schedules.show', $schedule->id) }}" class="underline">
                    {{ $schedule->title }}
                </a>
                </div>
            @endforeach
            </div>
        @endforeach
        </div>
    @endforeach
    </div>
    </div>
  </div>
</x-app-layout>
