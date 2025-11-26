@extends('layouts.app')

@section('content')
  <x-slot name="header">
        <h2 class="text-[40px] font-normal">schedule</h2>  {{-- 1段目 --}}
 </x-slot>

        <div class="py-8 max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">

        {{-- 2段目：月/年 & ナビゲーション --}}
        <div class="flex items-center justify-between bg-white p-2 rounded-full">
            <form method="GET" action="{{ route('schedules.index') }}">
                <button name="month" value="{{ $prevMonth }}" class="text-2xl px-2">←</button>
            </form>

            <h3 class="text-lg font-semibold">
                {{ $currentYear }}.{{ sprintf('%02d', $currentMonth) }}
            </h3>

            <form method="GET" action="{{ route('schedules.index') }}">
                <button name="month" value="{{ $nextMonth }}" class="text-2xl px-2">→</button>
            </form>
        </div>


    <div class="py-[30px] px-[20px] rounded bg-[radial-gradient(ellipse_at_210%_20%,_#A4CE7A_0%,_#A4CE7A_21%,_#002928_93%)]">

            @php
            $categoryColors = [
                'live' => 'bg-pink-300 text-pink-900',
                'radio' => 'bg-green-300 text-green-900',
                'tv' => 'bg-yellow-300 text-yellow-900',
                'magazine' => 'bg-purple-300 text-purple-900',
                'release' => 'bg-indigo-300 text-indigo-900',
                'other' => 'bg-gray-300 text-gray-900',
            ];
            @endphp

            <div class="flex flex-wrap justify-center gap-2 my-2">
            {{-- ALLボタン --}}
            <a href="{{ route('schedules.index') }}"
            class="px-4 py-1 rounded-full text-sm transition
                    {{ request('category') === $category
                ? 'bg-red-200 text-red-900'
                : ($categoryColors[$category] ?? 'bg-gray-100 text-black') }}">All
            </a>

            {{-- 各カテゴリー --}}
                @foreach($categories as $category)
                    <a href="{{ route('schedules.index', ['category' => $category]) }}"
                    class="px-4 py-1 rounded-full text-sm transition
                    {{ request('category') === $category
                            ? 'bg-blue-200 text-blue-900'
                            : ($categoryColors[$category] ?? 'bg-gray-100 text-black') }}">
                    {{ ucfirst($category) }}
                    </a>
                @endforeach
            </div>

            {{-- 4段目：カレンダー表示 --}}
            <div class="grid grid-cols-7 text-center font-bold text-white">
                @foreach(['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'] as $day)
                <div class="py-2
                @if($day === 'Sat') text-blue-400
                @elseif($day === 'Sun') text-red-400
                @endif">{{ $day }}</div>
                @endforeach
            </div>
            <div class="bg-[#002928] rounded-[10px]"> {{-- 各週の間に縦の余白 --}}
            @foreach($calendar as $week)
                <div class="grid grid-cols-7 border-b border-white/40"> {{-- 1週間（7日分）を横並び --}}
                @foreach($week as $day)
                    <div class="p-2 text-left relative text-[#E9FEE1]
                    {{ $loop->index == 5 ? 'text-blue-500' : '' }}
                    {{ $loop->index == 6 ? 'text-red-500' : '' }}
                    {{ $loop->last ? '' : 'border-r' }}
                    {{ $loop->parent->last ? '' : 'border-b' }}
                    border-white/40 h-auto">

                    <div class="top-2 right-2 text-xs font-semibold">{{ $day['date']->day }}
                        @if(Auth::user()->admin)
                        <a href="{{ route('schedules.create', ['date' => $day['date']->format('Y-m-d')] ) }}"
                            class="inline-block text-center w-full h-full hover:bg-[#255946] transition border border-black/20 p-1 rounded-full mt-1 text-[#E9FEE1]">
                            ＋新規投稿</a>
                        @endif
                    </div>

                    @foreach($day['schedules'] as $schedule)
                        <div class="mt-2 text-xs whitespace-normal">
                        <p class="mb-1">
                            <a href="{{ route('schedules.show', $schedule->id) }}" class="px-1 rounded-full
                            {{ $categoryColors[$schedule->category] ?? 'bg-white/10 text-white'}}">
                            {{ $schedule->category }}
                            </a>
                        </p>
                        <a href="{{ route('schedules.show', $schedule->id) }}" class="">
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
  </div>
@endsection
