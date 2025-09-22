<x-app-layout>
    <div class="space-y-8">

    <section id="top" class="font-suse">
        {{-- 1. アーティスト写真 --}}
        <section id="section-hero" class="relative w-full bg-hero-bg">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[100vh] h-[100vh] bg-[#DDFFA2] opacity-40 rounded-[800px] filter blur-[70px] z-0"></div>
            <div class="relative z-10">
                <div class="relative w-full h-[100vh] bg-cover flex items-center justify-center">
                    <figure class="relative max-w-[1324px] w-full px-4">
                        <img class="w-full h-screen object-cover" src="{{ 'images/artist.png' }}" alt="lilac">
                    </figure>
                </div>
            </div>
        </section>

         {{-- 2. ライブ情報 --}}
        <section id="live-info" class="w-[calc(100%-140px)] mx-auto mb-20">
        <h2 class="font-suse font-medium leading-none text-[clamp(20px,7vw,30px)]">
            Live</h2>
            @if($latestLives->isEmpty())
            <p class="text-center text-gray-600 mt-8">現在予定されているライブはありません。</p>
            @if(Auth::user()->admin)
                <a href="{{ route('lives.create') }}"
                    class="text-blue-600" hover:underline>
                    ＋ライブ情報追加
                </a>
            @endif

            @else

            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @foreach($latestLives as $latestLive)
                        <div class="swiper-slide bg-white rounded-xl shadow p-4">
                            <a href="{{ route('lives.show', $latestLive->id) }}">
                                <img src="{{ asset('storage/' . $latestLive->image_path) }}"
                                    alt="{{ $latestLive->title }}"
                                    class="w-full h-40 object-cover rounded-lg mb-2">
                                <h3 class="text-lg font-semibold">{{ $latestLive->title }}</h3>
                                <p class="text-sm text-gray-500">{{ $latestLive->date }}</p>
                            </a>
                        </div>
                    @endforeach
                </div>

             {{-- ナビゲーション --}}
                <div class="relative flex justify-between items-center w-full px-6 mt-4">
                    <div class="swiper-button-prev flex items-center justify-center w-[35px] h-[35px] rounded-full bg-[#1E4737] cursor-pointer transition duration-300 hover:bg-[#255946]">
                        <span class="arrow-left"></span>
                    </div>
                    <div class="swiper-button-next flex items-center justify-center w-[35px] h-[35px] rounded-full bg-[#1E4737] cursor-pointer transition duration-300 hover:bg-[#255946]">
                        <span class="arrow-right"></span>
                    </div>
                </div>
            </div>


            <div class="mt-6 text-right">
                <a href="{{ route('lives.index') }}" class="text-blue-600 hover:underline">
                過去のライブ情報はこちら↗
                </a>
            </div>
            @endif

        </section>

        {{-- 3. お知らせ --}}
        <section id="infoOfficial" class="w-[calc(100%-140px)] mx-auto mb-20">
        <div class="flex justify-between mb-4">
        <h2 class="font-suse font-medium leading-none text-[clamp(20px,7vw,30px)]">
            News</h2>
                <div class="mt-4 text-right flex">
                    <p class="relative">
                        <a href="{{ route('news.index') }}" class="w-full h-full px-[1.2em] py-[0.8em] rounded-full border border-black/20 text-[#002928] no-underline hover:underline inline-block text-center" hover:underline>
                            MORE
                        </a>
                    </p>
                    @if(Auth::user()->admin)
                    <p class="relative">
                    <a href="{{ route('news.create') }}" class="w-full h-full px-[1.2em] py-[0.8em] rounded-full border border-black/20 text-[#002928] no-underline hover:underline inline-block text-center ml-[10px]" hover:underline>
                        ＋新規作成
                    </a>
                    </p>
                    @endif
                </div>
        </div>
            {{-- 直近3つ＋過去リンク --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($latestNews as $news)
                <ul class="border rounded p-4 shadow">
                    <li class="relative  -translate-x-0 -translate-y-0">
                        <a href="{{ route('news.show' , $news->id) }}" class="relative block w-full rounded-full bg-[#F5F5F5] h-full px-5 py-3 border-black/20 overflow-hidden">
                            <div class="flex h-full items-center">
                                {{-- 日付 --}}
                                <div class="bg-[#8E77F5] w-[50px] h-[50px] rounded-full flex items-center justify-center mr-7">
                                    <p class="text-[14px] text-white">{{ $news->published_at->format('m.d') }}</p>
                                </div>
                                {{-- タイトル --}}
                                <div>
                                    <p class="text-lg font-bold leading-[1.4em]">{{ $news->title }}</p>
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>
                @endforeach
            </div>


        </section>


        {{-- 4. カレンダー --}}
        <section id="schedule" class="w-[calc(100%-140px)] mx-auto mb-20">
        <div class="flex justify-between mb-4">
            <h2 class="font-suse font-medium leading-none text-[clamp(20px,7vw,30px)]">
            Schedule</h2>
                <div class="mt-4 text-right flex">
                    <p class="relative">
                        <a href="{{ route('schedules.index') }}" class="w-full h-full px-[1.2em] py-[0.8em] rounded-full border border-black/20 text-[#002928] no-underline hover:underline inline-block text-center" hover:underline>
                            MORE
                        </a>
                    </p>
                    @if(Auth::user()->admin)
                    <p class="relative">
                        <a href="{{ route('news.create') }}" class="w-full h-full px-[1.2em] py-[0.8em] rounded-full border border-black/20 text-[#002928] no-underline hover:underline inline-block text-center ml-[10px]" hover:underline>
                            ＋新規作成
                        </a>
                    </p>
                    @endif
                </div>
        </div>

            <ul class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($latestSchedules as $schedule)
                @php
                    $date = \Carbon\Carbon::parse($schedule->date);
                @endphp
                <li class="border rounded p-4 shadow">
                    <a href="{{ route('schedules.show' , $schedule->id) }}">
                        <p class="text-sm text-gray-500">
                            <span>{{ $date->format('Y') }}</span>
                            <span>{{ $date->format('m') }}</span>
                            <span>{{ $date->format('d') }}</span>
                            ({{ strtoupper($date->format('D')) }})
                            {{ $schedule->category }}
                        </p>
                        <h3 class="text-lg font-bold">{{ $schedule->title }}</h3>
                    </a>
                </li>
                @endforeach
            </ul>
        </section>

        {{-- 5. ブログ --}}
        <section id="blog" class="w-[calc(100%-140px)] mx-auto mb-20">
        <h2 class="font-suse font-medium leading-none text-[clamp(20px,7vw,30px)]">
            Blog</h2>
        <div class="mt-4 text-right flex">
            <p class="relative">
                        <a href="{{ route('blogs.index') }}" class="w-full h-full px-[1.2em] py-[0.8em] rounded-full border border-black/20 text-[#002928] no-underline hover:underline inline-block text-center" hover:underline>
                            MORE
                        </a>
                    </p>
                    @if(Auth::user()->admin)
                    <p class="relative">
                    <a href="{{ route('blogs.create') }}" class="w-full h-full px-[1.2em] py-[0.8em] rounded-full border border-black/20 text-[#002928] no-underline hover:underline inline-block text-center ml-[10px]" hover:underline>
                    ＋新規作成
                     </a>
                </p>
            @endif
        </div>

            <div class="flex flex-wrap justify-center gap-6">
                @foreach($latestBlogs as $blogs)
                <div class="w-full sm:w-[48%] lg:w-[30%] bg-white rounded-xl shadow overflow-hidden">
                    <a href="{{ route('blogs.show' , $blogs->id) }}">
                        <div class="h-48 w-full overflow-hidden">
                            <img src="{{ asset('storage/' . $blogs->image_path) }}" alt="{{ $blogs->title }}" class="w-full h-full object-cover">
                        </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold">{{ $blogs->title }}</h3>
                        <p class="text-sm text-gray-500">{{ $blogs->date }}</p>
                    </a>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-4 text-right">
                <a href="{{ route('blogs.index') }}" class="text-blue-600" hover:underline>
                    過去のブログはこちら↗
                </a>
                @if(Auth::user()->admin)
                <a href="{{ route('blogs.create') }}" class="text-blue-600" hover:underline>
                    新規作成
                </a>
                @endif
            </div>
        </section>

        {{-- 6. ストーリー --}}
        <section id="story" class="w-[calc(100%-140px)] mx-auto mb-20">
        <h2 class="font-suse font-medium leading-none text-[clamp(20px,7vw,30px)]">
            Story</h2>
        </section>

        {{-- 7. MV一覧 --}}
        <section id="mv" class="w-[calc(100%-140px)] mx-auto mb-20">
        <div class="flex justify-between mb-4">

            <h2 class="text-2xl font-medium leading-none text-[clamp(20px,7vw,30px)]">
                MV</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach ($latestMVs as $mv)
                    <div class="bg-white shadow rounded p-4">
                    <iframe width="100%" height="215"
                            src="{{ $mv->url }}" frameborder="0"
                            allowfullscreen></iframe>
                    <p class="mt-2 font-semibold">{{ $mv->title }}</p>
                    </div>
                @endforeach
                </div>

            <div class="mt-4 text-right">
            <a href="{{ route('mv.index') }}" class="text-indigo-600 hover:underline">MV一覧はこちら</a>
            </div>
             @if(Auth::user()->admin)
                <a href="{{ route('mv.create') }}"
                    class="text-blue-600" hover:underline>
                    ＋MV追加
                </a>
            @endif

        </section>

        {{-- 8. お問い合わせ --}}
        <section id="contact" class="w-[calc(100%-140px)] mx-auto mb-20">
        <h2 class="font-suse font-medium leading-none text-[clamp(20px,7vw,30px)]">
            Contact</h2>
        </section>

    </section>
    </div>
</x-app-layout>
