{{-- resources/views/blogs/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            アーティストブログ一覧
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                @if(session('success'))
                    <div class="mb-4 text-green-600">
                        {{ session('success') }}
                    </div>
                @endif

            <div class="flex flex-wrap gap-2">
                @foreach($categories as $category)
                    <a href="{{ route('blogs.index', ['category' => $category]) }}"
                    class="px-4 py-1 border rounded bg-gray-100 hover:bg-gray-200 text-sm {{ request('category') === $category ? 'bg-blue-200' : '' }}">
                    {{ $categoryMap[$category] }}
                    </a>
                @endforeach
            </div>


                @foreach($blogs as $blog)
                    <div class="mb-8 border-b pb-4">
                        {{-- 画像 --}}
                        @if($blog->image_path)
                            <img src="{{ asset('storage/' . $blog->image_path) }}" alt="ブログ画像" class="w-full max-w-md mb-4 rounded-xl">
                        @endif

                        {{-- タイトル --}}
                        <h3 class="text-2xl font-bold text-gray-900">{{ $blog->title }}</h3>

                        {{-- 投稿日 --}}
                        <p class="text-sm text-gray-500">{{ $blog->created_at->format('Y年m月d日') }}</p>

                        {{-- 詳細ページリンク --}}
                        <a href="{{ route('blogs.show', $blog->id) }}" class="inline-block mt-2 text-blue-500 hover:underline">
                            続きを読む
                        </a>

                        {{-- いいね機能 --}}
                        @if(Auth::check() && Auth::user()->hasLiked($blog->id))
                            <p class="m-0">
                            <i class="fas fa-heart text-red-500 cursor-pointer un_like_btn" blog_id="{{ $blog->id }}"></i>
                                <span class="like_counts{{ $blog->id }}">{{ $blog->likes->count() }}</span>
                            </p>
                        @else
                            <p class="m-0">
                            <i class="far fa-heart text-gray-500 cursor-pointer like_btn" blog_id="{{ $blog->id }}"></i>
                                <span class="like_counts{{ $blog->id }}">{{ $blog->likes->count() }}</span>
                            </p>
                        @endif
                    </div>
                @endforeach

                {{-- ページネーション --}}
                <div class="mt-6">
                    {{ $blogs->links() }}
                </div>

            </div>
        </div>
    </div>

{{-- いいね機能の非同期処理 --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).on('click', '.like_btn', function (e) {
        e.preventDefault();

        var blog_id = $(this).attr('blog_id');
        var $heart = $(this);
        var $countSpan = $('.like_counts' + blog_id);
        var currentCount = Number($countSpan.text());

        // ハートを即時で切り替え（視覚効果）
        $heart.toggleClass('fas far');
        $heart.removeClass('like_btn').addClass('un_like_btn');

        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            method: "POST",
            url: "/blogs/" + blog_id + "/like",
            data: {
                blog_id: blog_id
            },
        })
        .done(function (res) {
            console.log(res);
            // res.count がサーバーから返ってくる想定
            $countSpan.text(res.count);
        })
        .fail(function (res) {
            console.log('fail');
        });
    });

    // 「いいね解除」ボタン用（必要なら）
    $(document).on('click', '.un_like_btn', function (e) {
        e.preventDefault();

        var blog_id = $(this).attr('blog_id');
        var $heart = $(this);
        var $countSpan = $('.like_counts' + blog_id);
        var currentCount = Number($countSpan.text());

        $heart.toggleClass('fas far');
        $heart.removeClass('un_like_btn').addClass('like_btn');

        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            method: "DELETE",
            url: "/blogs/" + blog_id + "/like",
            data: {
                blog_id: blog_id
            },
        })
        .done(function (res) {
            console.log(res);
            $countSpan.text(res.count);
        })
        .fail(function (res) {
            console.log('fail');
        });
    });
    </script>
</x-app-layout>
