{{-- resources/views/movie/index.blade.php --}}
<x-app-layout>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                @if(session('success'))
                    <div class="mb-4 text-green-600">
                        {{ session('success') }}
                    </div>
                @endif

                    @foreach ($movies as $movie)
                        <div class="bg-white rounded-xl shadow p-4">
                        <div class="aspect-w-16 aspect-h-9 mb-3">
                            <iframe class="w-full h-full"
                                    src="{{ $movie->url }}"
                                    frameborder="0"
                                    allowfullscreen></iframe>
                        </div>
                        <h3 class="text-lg font-bold mb-1">{{ $movie->title }}</h3>
                        </div>

                        {{-- いいね機能 --}}
                        @if(Auth::check() && Auth::user()->hasLiked($movie->id))
                            <p class="m-0">
                            <i class="fas fa-heart text-red-500 cursor-pointer un_like_btn" movie="{{ $movie->id }}"></i>
                                <span class="like_counts{{ $movie->id }}">{{ $movie->likes->count() }}</span>
                            </p>
                        @else
                            <p class="m-0">
                            <i class="far fa-heart text-gray-500 cursor-pointer like_btn" movie="{{ $movie->id }}"></i>
                                <span class="like_counts{{ $movie->id }}">{{ $movie->likes->count() }}</span>
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

        var blog_id = $(this).attr('movie');
        var $heart = $(this);
        var $countSpan = $('.like_counts' + movie_id);
        var currentCount = Number($countSpan.text());

        // ハートを即時で切り替え（視覚効果）
        $heart.toggleClass('fas far');
        $heart.removeClass('like_btn').addClass('un_like_btn');

        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            method: "POST",
            url: "/blogs/" + movie_id + "/like",
            data: {
                movie_id: movie_id
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

        var movie_id = $(this).attr('movie_id');
        var $heart = $(this);
        var $countSpan = $('.like_counts' + movie_id);
        var currentCount = Number($countSpan.text());

        $heart.toggleClass('fas far');
        $heart.removeClass('un_like_btn').addClass('like_btn');

        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            method: "DELETE",
            url: "/movie/" + movie_id + "/like",
            data: {
                movie_id: movie_id
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
