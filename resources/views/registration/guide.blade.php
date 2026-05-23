{{-- resources/views/movie/index.blade.php --}}
@extends('layouts.app', ['navColor' => 'bg-transparent'])
    @section('page-bg')
    <div class="absolute inset-0 bg-[#006360cc] z-0"></div> {{-- 背景色 --}}

    <div class="absolute inset-0 overflow-hidden z-0 pointer-events-none">
        <div class="absolute w-[55vw] h-[55vw] right-[-10vw] top-[-5vw]
            rounded-[800px] bg-[#BCE670] opacity-30 blur-[70px]"></div>

        <div class="absolute w-[55vw] h-[55vw] left-[-10vw] top-[70vw]
            rounded-[800px] bg-[#A4CE7A] opacity-50 blur-[70px]"></div>
    </div>
    @endsection

@section('content')

{{-- 新規入会ページ --}}


                {{-- ページネーション --}}
                <div class="mt-6">
                    {{ $movies->links() }}
               </div>

        </div>
    </div>
@endsection
