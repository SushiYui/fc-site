<x-app-layout>
    <div class="space-y-8">

    <div id="top" class="font-suse">
        {{-- 1. アーティスト写真 --}}
    <section id="section-hero" class="relative w-full bg-hero-bg">
        {{-- <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[100vh] h-[100vh] bg-[#DDFFA2] opacity-40 rounded-[800px] filter blur-[70px] z-0"></div> --}}
            <div class="relative z-10">
                <div class="relative w-full h-[100vh] bg-cover flex items-center justify-center">
                    <figure class="relative max-w-[1324px] w-full px-4">
                        <img class="w-full h-screen object-cover" src="{{ 'images/artist.png' }}" alt="lilac">
                    </figure>
                </div>
            </div>
    </section>


         {{-- 2. ライブ情報 --}}
    <section id="live-info" class="relative w-full bg-hero-bg -mt-[50px]"> {{-- ←ここで背景をつなげる --}}
     {{-- <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[100vh] h-[100vh] bg-[#DDFFA2] opacity-40 rounded-[800px] filter blur-[70px] z-0"></div> --}}

        <div class="swiper mySwiper relative mt-5 w-full">

            <div id="live-info" class="w-[calc(100%-140px)] mx-auto relative">

            {{-- 中央寄せコンテナ --}}

                @if($latestLives->isEmpty())
                <p class="text-center text-gray-600 mt-8">現在予定されているライブはありません。</p>
                @if(Auth::user()->admin)
                    <a href="{{ route('lives.create') }}"
                        class="text-blue-600" hover:underline>
                        ＋ライブ情報追加
                    </a>
                @endif

                @else
                {{-- スライダー（上に浮かせる） --}}
                <div class="swiper mySwiper relative w-full mt-5">
                    <div class="swiper-wrapper">
                        @foreach($latestLives as $latestLive)
                            <div class="swiper-slide p-4 flex justify-between items-center">
                                <a href="{{ route('lives.show', $latestLive->id) }}" class="block">
                                    <img src="{{ asset('storage/' . $latestLive->image_path) }}"
                                        alt="{{ $latestLive->title }}"
                                        class="w-full h-40 object-cover rounded-lg mb-2">
                                    <h3 class="text-lg font-semibold text-[#E9FEE1]">{{ $latestLive->title }}</h3>
                                    <p class="text-sm text-[#64860E]">{{ $latestLive->date }}</p>
                                </a>
                            </div>
                        @endforeach
                        </div>

                </section>

                {{-- ナビゲーション --}}
                    <div class="relative flex justify-center w-[200px] mx-auto my-10">
                        <div class="swiper-button-prev flex items-center justify-center w-[35px] h-[35px] rounded-full bg-[#1E4737] cursor-pointer transition duration-300 hover:bg-[#255946]"></div>
                        <div class="mx-s w-[70px] border-t border-dashed border-[#DDFFA2]-400"></div>
                        <div class="swiper-button-next flex items-center justify-center w-[35px] h-[35px] rounded-full bg-[#1E4737] cursor-pointer transition duration-300 hover:bg-[#255946]"></div>
                    </div>
                </div>


                <div class="flex justify-end w-[calc(100%-140px)] mx-auto">
                    <p class="relative">
                        <a href="{{ route('lives.index') }}" class="w-full h-full rounded-full border border-black/20 px-[1.2em] py-[0.8em] text-[#002928] no-underline hover:underline inline-flex justify-center items-center" hover:underline>
                            MORE<span class="dli-chevron-round-right ml-[0.8em] text-black"></span>
                        </a>
                    </p>
                    @if(Auth::user()->admin)
                    <p class="relative">
                    <a href="{{ route('lives.create') }}" class="w-full h-full px-[1.2em] py-[0.8em] rounded-full border border-black/20 text-[#002928] no-underline hover:underline inline-block text-center ml-[10px]" hover:underline>
                        ＋ 新規作成
                    </a>
                    </p>
                    @endif

                </div>

                @endif

    </div>




        {{-- 3. お知らせ --}}
        <section id="infoOfficial" class="w-[calc(100%-140px)] mx-auto my-20">
        <div class="flex justify-between mb-4">
        <h2 class="font-suse font-medium leading-none text-[clamp(20px,7vw,30px)]">
            News</h2>
                <div class="mt-4 text-right flex">
                    <p class="relative">
                        <a href="{{ route('news.index') }}" class="w-full h-full rounded-full border border-black/20 px-[1.2em] py-[0.8em] text-[#002928] no-underline hover:underline inline-flex justify-center items-center" hover:underline>
                            MORE<span class="dli-chevron-round-right ml-[0.8em] text-black"></span>
                        </a>
                    </p>
                    @if(Auth::user()->admin)
                    <p class="relative">
                    <a href="{{ route('news.create') }}" class="w-full h-full px-[1.2em] py-[0.8em] rounded-full border border-black/20 text-[#002928] no-underline hover:underline inline-block text-center ml-[10px]" hover:underline>
                        ＋ 新規作成
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
                                {{-- NEWバッジ --}}
                                {{-- @if($news->is_new)
                                    <span class="bg-[#002928] text-white text-[12px] py-[3px] px-[10px] rounded-tr-lg font-semibold">
                                        NEW
                                    </span>
                                @endif --}}
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>
                @endforeach
            </div>
        </section>


        {{-- 4. カレンダー --}}
        <section id="schedule" class="relative w-full bg-hero-bg py-20 mb-20 overflow-hidden">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[100vh] h-[100vh] bg-[#DDFFA2] opacity-40 rounded-[800px] filter blur-[70px] z-0"></div>

        <div class="relative w-[calc(100%-140px)] mx-auto z-10">
        <div class="flex justify-between mb-4">
            <h2 class="font-suse font-medium leading-none text-[clamp(20px,7vw,30px)] text-[#DDFFA2]">
            Schedule</h2>
                <div class="mt-4 text-right flex">
                    <p class="relative">
                        <a href="{{ route('schedules.index') }}" class="w-full h-full rounded-full text-[#DDFFA2] bg-[#1E4737] px-[1.2em] py-[0.8em] no-underline hover:underline inline-flex justify-center items-center" hover:underline>
                            MORE<span class="dli-chevron-round-right ml-[0.8em] text-[#DDFFA2]"></span>
                        </a>
                    </p>
                    @if(Auth::user()->admin)
                    <p class="relative">
                        <a href="{{ route('news.create') }}" class="w-full h-full px-[1.2em] py-[0.8em] rounded-full border border-black/20 no-underline hover:underline inline-block text-center ml-[10px] text-[#DDFFA2] bg-[#1E4737]" hover:underline>
                            ＋ 新規作成
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
                <li class="items-center">
                    <a href="{{ route('schedules.show' , $schedule->id) }}" class="inline-block p-4 w-full h-full rounded text-[#E9FEE1] bg-[#1E4737]">
                        <p class="text-sm">
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
        </div>
        </section>

        {{-- 7. MV一覧 --}}
        <section id="mv" class="w-[calc(100%-140px)] mx-auto mb-20">
        <div class="flex justify-between mb-4">

            <h2 class="font-suse font-medium leading-none text-[clamp(20px,7vw,30px)]">
                Video</h2>

                <div class="mt-4 text-right flex">
                    <p class="relative">
                        {{-- <a href="{{ route('mv.index') }}" class="w-full h-full px-[1.2em] py-[0.8em] rounded-full border border-black/20 text-[#002928] no-underline hover:underline inline-block text-center" hover:underline> --}}
                        <a href="{{ route('mv.index') }}" class="w-full h-full rounded-full border border-black/20 px-[1.2em] py-[0.8em] text-[#002928] no-underline hover:underline inline-flex justify-center items-center" hover:underline>
                            MORE<span class="dli-chevron-round-right ml-[0.8em] text-black"></span>
                        </a>
                        </p>
                    @if(Auth::user()->admin)
                    <p class="relative">
                        <a href="{{ route('mv.create') }}"
                            class="w-full h-full px-[1.2em] py-[0.8em] rounded-full border border-black/20 text-[#002928] no-underline hover:underline inline-block text-center ml-[10px]" hover:underline>
                            ＋ MV追加
                        </a>
                    </p>
                    @endif
                </div>
        </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach ($latestMVs as $mv)
                    <div class="p-4">
                    <iframe width="100%" height="215"
                            src="{{ $mv->url }}" frameborder="0"
                            allowfullscreen></iframe>
                    <p class="mt-2 text-sm text-[#64860E]">{{ $mv->category }}</p>
                    <p class="font-bold text-[#002928] text-[18px]">{{ $mv->title }}</p>
                        <p class="text-xs text-[#64860E]">
                            <span>{{ $date->format('Y') }}</span>
                            <span>{{ $date->format('m') }}</span>
                            <span>{{ $date->format('d') }}</span>
                            ({{ strtoupper($date->format('D')) }})
                        </p>
                    </div>
                @endforeach
                </div>

        </section>


     <div class="relative w-full bg-[#DDFFA2] py-20 mb-20 overflow-hidden">
        {{-- 6. 新規入会--}}
        <section id="story" class="w-[calc(100%-140px)] mx-auto mb-20 border-b border-black/20">
        <h2 class="font-suse font-medium leading-none text-[clamp(20px,7vw,30px)] text-[#002928]">
            Fan Club</h2>
                <div class="flex justify-center mb-6">
                    <img src="/images/fc_site_logo.png" alt="Fan Club Logo" class="w-40 h-auto">
                </div>
                <ul class="mt-4 text-center flex justify-center">
                    <li><a href="" class="bg-[#1E4737] rounded-[100px] mr-[30px] mb-[20px] px-12 py-3 text-[#DDFFA2] no-underline hover:underline inline-flex justify-center items-center w-[190px]" hover:underline>
                        新規入会<span class="dli-chevron-round-right ml-[0.8em]"></span></a></li>
                    <li><a href="" class="bg-[#1E4737] rounded-[100px] mr-[30px] mb-[20px] px-12 py-3 text-[#DDFFA2] no-underline hover:underline inline-flex justify-center items-center w-[190px]" hover:underline>
                        LOGIN<span class="dli-chevron-round-right ml-[0.8em]"></span></a></li>
                </ul>
        </section>


        {{-- 6. ストーリー --}}
        <section id="story" class="w-[calc(100%-140px)] mx-auto mb-20 border-b border-black/20">
        <h2 class="font-suse font-medium leading-none text-[clamp(20px,7vw,30px)] text-[#002928]">
            Story</h2>
        </section>


        {{-- JAM'S New Contents --}}
        <div class="relative py-[40px]">
        <h2 class="w-[calc(100%-140px)] mx-auto mb-5 font-medium leading-none text-[clamp(20px,7vw,30px)] text-[#002928]">
            JAM'S New Contents</h2>

        {{-- 7-1. MOVIE --}}
        <section id="MOVIE" class="w-[calc(100%-140px)] mx-auto mb-20">
        <div class="flex justify-between mb-4">
            <h2 class="font-suse font-medium leading-none text-[clamp(20px] text-[#64860E]">
                Mrs.MOVIE</h2>
            <div class="mt-4 text-right flex">
                <p class="relative">
                            <a href="" class="w-full h-full rounded-full border border-black/20 px-[1.2em] py-[0.8em] text-[#002928] no-underline hover:underline inline-flex justify-center items-center" hover:underline>
                                MORE<span class="dli-chevron-round-right ml-[0.8em] text-black"></span>
                            </a>
                        </p>
                        @if(Auth::user()->admin)
                        <p class="relative">
                        <a href="{{ route('blogs.create') }}" class="w-full h-full px-[1.2em] py-[0.8em] rounded-full border border-black/20 text-[#002928] no-underline hover:underline inline-block text-center ml-[10px]" hover:underline>
                        ＋ 新規作成
                        </a>
                    </p>
                @endif
            </div>

        </div>
        </section>

        {{-- 7-2. ブログ--}}
        <section id="blog" class="w-[calc(100%-140px)] mx-auto mb-20">
        <div class="flex justify-between mb-4">
            <h2 class="font-suse font-medium leading-none text-[20px] text-[#64860E]">
                Blog</h2>
            <div class="mt-4 text-right flex">
                <p class="relative">
                            <a href="{{ route('blogs.index') }}" class="w-full h-full rounded-full border border-black/20 px-[1.2em] py-[0.8em] text-[#002928] no-underline hover:underline inline-flex justify-center items-center" hover:underline>
                                MORE<span class="dli-chevron-round-right ml-[0.8em] text-black"></span>
                            </a>
                        </p>
                        @if(Auth::user()->admin)
                        <p class="relative">
                        <a href="{{ route('blogs.create') }}" class="w-full h-full px-[1.2em] py-[0.8em] rounded-full border border-black/20 text-[#002928] no-underline hover:underline inline-block text-center ml-[10px]" hover:underline>
                        ＋ 新規作成
                        </a>
                    </p>
                @endif
            </div>
        </div>

            <div class="flex flex-wrap justify-center gap-6">
                <div class="w-full sm:w-[48%] lg:w-[30%] bg-white rounded-xl shadow overflow-hidden">
                    <a href="{{ route('blogs.show' , $latestBlog->id) }}">
                        <div class="h-48 w-full overflow-hidden">
                            <img src="{{ asset('storage/' . $latestBlog->image_path) }}" alt="{{ $latestBlog->title }}" class="w-full h-full object-cover">
                        </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold">{{ $latestBlog->title }}</h3>
                        <p class="text-sm text-gray-500">{{ $latestBlog->date }}</p>
                    </a>
                    </div>
                </div>
            </div>
        </section>

        {{-- 7-3. GALLERY --}}
        <section id="GALLERY" class="w-[calc(100%-140px)] mx-auto mb-20">
        <div class="flex justify-between mb-4">
            <h2 class="font-suse font-medium leading-none text-[20px] text-[#64860E]">
                Mrs. GALLERY</h2>
            <div class="mt-4 text-right flex">
                <p class="relative">
                            <a href="" class="w-full h-full rounded-full border border-black/20 px-[1.2em] py-[0.8em] text-[#002928] no-underline hover:underline inline-flex justify-center items-center" hover:underline>
                                MORE<span class="dli-chevron-round-right ml-[0.8em] text-black"></span>
                            </a>
                        </p>
                        @if(Auth::user()->admin)
                        <p class="relative">
                        <a href="{{ route('blogs.create') }}" class="w-full h-full px-[1.2em] py-[0.8em] rounded-full border border-black/20 text-[#002928] no-underline hover:underline inline-block text-center ml-[10px]" hover:underline>
                        ＋ 新規作成
                        </a>
                    </p>
                @endif
            </div>


        </div>
        </section>

        </div>


        {{-- 8. お問い合わせ --}}
        <section id="contact" class="w-[calc(100%-140px)] mx-auto mb-20 border-b border-black/20">
        <h2 class="font-suse font-medium leading-none text-[clamp(20px,7vw,30px)] text-[#002928]">
            Contact</h2>
        </section>
    </div>

    </section>
    </div>
</x-app-layout>
