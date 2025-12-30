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

        <h1 class="font-bold leading-tight text-[25px] text-white my-5">
            PHOTO GALLERY
        </h1>

        @if(session('success'))
            <div class="mb-4 text-green-600">
                {{ session('success') }}
            </div>
        @endif

        @foreach($gallerys as $gallery)
            <div class="mb-8 pb-4">
                {{-- 画像 --}}
                <img src="{{ asset('storage/' . $gallery->image_path) }}" alt="うさぎ画像" class="w-full max-w-md mb-4 rounded-xl">
                {{-- 投稿日 --}}
                <p class="text-[15px] text-white">{{ $gallery->created_at->format('Y年m月d日') }}</p>

            </div>
        @endforeach

                {{-- ページネーション --}}
                <div class="mt-6">
                    {{ $gallerys->links() }}
                </div>

    </div>
@endsection
