{{-- resources/views/blogs/index.blade.php --}}
@extends('layouts.app', ['navColor' => 'bg-transparent'])

@section('page-bg')
<div class="absolute inset-0 bg-[#72c32fcc] z-0"></div> {{-- 背景色 --}}

<div class="absolute inset-0 overflow-hidden z-0 pointer-events-none">
    <div class="absolute w-[55vw] h-[55vw] right-[-10vw] top-[-5vw]
        rounded-[800px] bg-[#BCE670] opacity-80 blur-[70px]"></div>

    <div class="absolute w-[55vw] h-[55vw] left-[-10vw] top-[10vw]
        rounded-[800px] bg-[#A4CE7A] opacity-80 blur-[70px]"></div>
</div>
@endsection

@section('content')
<div class="relative z-20 max-w-7xl mx-auto sm:px-6 lg:px-8 pb-5">

        <h1 class="report-title font-semibold leading-tight text-gray-800 my-5">
            Mrs.REPORT</h1>


            @if (session('success'))
                <div class="mb-4 text-green-600">
                    {{ session('success') }}
                </div>
            @endif

            {{-- カテゴリー --}}
            <div class="flex flex-wrap justify-center gap-2 my-2">
                {{-- ALLボタン --}}
                <a href="{{ route('blogs.index') }}"
                    class="px-[2.5em] py-[1em] rounded-full text-[12px] transition border border-[rgba(221,255,162,0.8)]
                    {{ request('category') ? 'bg-[#DDFFA2] text-[#1E4737]' : 'bg-[#1E4737] text-[#DDFFA2]' }}">
                    All
                </a>

                {{-- 各カテゴリーボタン --}}
                @foreach ($categories as $category)
                    <a href="{{ route('blogs.index', ['category' => $category]) }}"
                        class="px-[2.5em] py-[1em] rounded-full text-[12px] transition border border-[rgba(221,255,162,0.8)]
                        {{ request('category') === $category
                            ? // 選択中かそうでないかで文字色や背景色が変わる
                            'bg-[#1E4737] text-[#DDFFA2]'
                            : 'bg-[#DDFFA2] text-[#1E4737]' }}">
                        {{ $categoryMap[$category] }}
                    </a>
                @endforeach
            </div>

            {{-- ブログ記事一覧 --}}
            <div class=""></div>
            @foreach ($blogs as $blog)
                <ul class="w-full mb-5">

                    <li class="mb-[20px]">
                    {{-- 詳細ページリンク --}}
                        <a href="{{ route('blogs.show', $blog->id) }}"
                            class="block relative p-5 bg-[#1f916acc] text-[#002928] rounded-lg hover:bg-[#1f916a] transition">

                            {{-- 画像 --}}
                            @if ($blog->image_path)
                                <img src="{{ asset('storage/' . $blog->image_path) }}" alt="ブログ画像"
                                    class="w-full max-w-md mb-4 rounded-xl">
                            @endif

                            {{-- タイトル --}}
                            <h3 class="text-[14px] font-bold text-white mt-[1em] mb-[0.8em]">{{ $blog->title }}</h3>

                            {{-- 投稿日 --}}
                            <p class="text-[11px] font-bold text-[#DDFFA2]">{{ $blog->created_at->format('Y年m月d日') }}</p>


                        {{-- いいね機能 --}}
                        @if (Auth::check() && Auth::user()->hasLiked($blog->id))
                            <p class="m-0">
                                <i class="fas fa-heart text-red-500 cursor-pointer un_like_btn"
                                    blog_id="{{ $blog->id }}"></i>
                                <span class="like_counts{{ $blog->id }}">{{ $blog->likes->count() }}</span>
                            </p>
                        @else
                            <p class="m-0">
                                <i class="far fa-heart text-gray-500 cursor-pointer like_btn"
                                    blog_id="{{ $blog->id }}"></i>
                                <span class="like_counts{{ $blog->id }}">{{ $blog->likes->count() }}</span>
                            </p>
                        @endif
                        </a>
                    </li>
                </ul>
            @endforeach

            {{-- ページネーション --}}
            <div class="mt-6">
                {{ $blogs->links() }}
            </div>

        </div>

    {{-- いいね機能の非同期処理 --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).on('click', '.like_btn', function(e) {
            e.preventDefault();

            var blog_id = $(this).attr('blog_id');
            var $heart = $(this);
            var $countSpan = $('.like_counts' + blog_id);
            var currentCount = Number($countSpan.text());

            // ハートを即時で切り替え（視覚効果）
            $heart.toggleClass('fas far');
            $heart.removeClass('like_btn').addClass('un_like_btn');

            $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: "POST",
                    url: "/blogs/" + blog_id + "/like",
                    data: {
                        blog_id: blog_id
                    },
                })
                .done(function(res) {
                    console.log(res);
                    // res.count がサーバーから返ってくる想定
                    $countSpan.text(res.count);
                })
                .fail(function(res) {
                    console.log('fail');
                });
        });

        // 「いいね解除」ボタン用（必要なら）
        $(document).on('click', '.un_like_btn', function(e) {
            e.preventDefault();

            var blog_id = $(this).attr('blog_id');
            var $heart = $(this);
            var $countSpan = $('.like_counts' + blog_id);
            var currentCount = Number($countSpan.text());

            $heart.toggleClass('fas far');
            $heart.removeClass('un_like_btn').addClass('like_btn');

            $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: "DELETE",
                    url: "/blogs/" + blog_id + "/like",
                    data: {
                        blog_id: blog_id
                    },
                })
                .done(function(res) {
                    console.log(res);
                    $countSpan.text(res.count);
                })
                .fail(function(res) {
                    console.log('fail');
                });
        });
    </script>
</div>

@endsection
