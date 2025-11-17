<x-app-layout>
  <x-slot name="header">
    <h2 class="text-[40px] font-normal">News</h2>
  </x-slot>

<section id="news_detail" class="w-[calc(100%-140px)] mx-auto my-20">
     <ul class="">
        <li class="relative -translate-x-0 -translate-y-0">
            @foreach ($news as $item)
            <a href="{{ route('news.show', $item->id) }}"
                class="relative block mb-3 w-full rounded-[10px] bg-[#F5F5F5] h-full px-5 py-3 border border-black/20 overflow-hidden
                @if($item->published_at->gt(now()->subWeek())) has-new @endif">
                <div class="flex h-full items-center">
                {{-- 日付 --}}
                    <div class="bg-[#8E77F5] w-[50px] h-[50px] rounded-full flex items-center justify-center mr-7">
                        <p class="text-[14px] text-white">{{ $item->published_at->format('m.d') }}</p>
                    </div>
                {{-- タイトル --}}
                    <div>
                    <p class="text-lg font-bold leading-[1.4em]">{{ $item->title }}</p>
                    </div>
                </div>
            </a>
            @endforeach

            <div class="mt-6">{{ $news->links() }}</div>
        </li>
    </ul>
</section>
</x-app-layout>
