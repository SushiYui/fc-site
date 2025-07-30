<x-app-layout>
    <div class="space-y-8">

        {{-- 1. アーティスト写真 --}}
        <section id="artist-photos">
            <h2 class="text-xl font-bold">アーティスト写真</h2>
            {{-- スライドショー表示予定 --}}
        </section>

        {{-- 2. お知らせ --}}
        <section id="news">
            <h2 class="text-xl font-bold">お知らせ</h2>
            {{-- 直近3つ＋過去リンク --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($latestNews as $news)
                <div class="border rounded p-4 shadow">
                    <a href="{{ route('news.show' , $news->id) }}">
                        <p class="text-sm text-gray-500">{{ $news->published_at->format('Y.m.d') }}</p>
                        <h3 class="text-lg font-bold">{{ $news->title }}</h3>
                    </a>
                </div>
                @endforeach
            </div>

            <div class="mt-4 text-right">
                <a href="{{ route('news.index') }}" class="text-blue-600" hover:underline>
                    過去のお知らせはこちら↗
                </a>
                @if(Auth::user()->admin)
                <a href="{{ route('news.create') }}" class="text-blue-600" hover:underline>
                    新規作成
                </a>
                @endif
            </div>
        </section>

            {{-- 3. ライブ情報 --}}
            <section id="live-info" class="my-8">
            <h2 class="text-xl font-bold mb-4">ライブ情報</h2>

            <div class="flex flex-wrap justify-center gap-6">
                @foreach($latestLives as $latestLive)
                <div class="w-full sm:w-[48%] lg:w-[30%] bg-white rounded-xl shadow overflow-hidden">
                    <a href="{{ route('lives.show', $latestLive->id) }}">
                    <div class="h-48 w-full overflow-hidden">
                        <img src="{{ asset('storage/' . $latestLive->image_path) }}" alt="{{ $latestLive->title }}" class="w-full h-full object-cover">
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold">{{ $latestLive->title }}</h3>
                        <p class="text-sm text-gray-500">{{ $latestLive->date }}</p>
                    </div>
                    </a>
                </div>
                @endforeach
            </div>

            <div class="mt-6 text-right">
                <a href="{{ route('lives.index') }}" class="text-blue-600 hover:underline">
                過去のライブ情報はこちら↗
                </a>
            </div>

            @if(Auth::user()?->admin)
                <div class="mt-2 text-right">
                <a href="{{ route('lives.create') }}" class="text-blue-600 hover:underline">
                    ＋ライブ追加
                </a>
                </div>
            @endif
            </section>

            <p class="text-center text-gray-600 mt-8">現在予定されているライブはありません。</p>
                @if(Auth::user()->admin)
                <a href="{{ route('lives.create') }}"
                    class="text-blue-600" hover:underline>
                    ＋ライブ情報追加
                </a>
                @endif
        </div>

        </section>

        {{-- 4. カレンダー --}}
        <section id="schedule">
            <h2 class="text-xl font-bold">スケジュール</h2>
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
            <a href="{{ route('schedules.index') }}" class="text-blue-600" hover:underline>
                VIEW ALL↗
            </a>

        </section>

        {{-- 5. ブログ --}}
        <section id="blog">
            <h2 class="text-xl font-bold">Blog</h2>

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
        <section id="story">
            <h2 class="text-xl font-bold">ストーリー</h2>
        </section>

        {{-- 7. MV一覧 --}}
        <section id="mv">
            <h2 class="text-xl font-bold">MV一覧</h2>
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
        <section id="contact">
            <h2 class="text-xl font-bold">お問い合わせ</h2>
        </section>

    </div>
</x-app-layout>
