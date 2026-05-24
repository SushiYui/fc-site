@extends('layouts.app', ['navColor' => 'bg-transparent'])

{{-- 背景デザイン --}}
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
       <p></p>
        <h2 class="font-bold leading-tight text-[20px] text-[#002928] mb-5">
            ご入会案内
        </h2>

        <div class="mt-4 flex justify-center">
            <a href="{{ route('join.email') }}" class="bg-[#1E4737] rounded-[100px] mr-[30px]
            mb-[20px] px-12 py-3 text-[#E2FF91] no-underline hover:underline inline-flex justify-center items-center" hover:underline>
            新規入会はこちら<span class="dli-chevron-round-right ml-[0.8em]"></span></a>
        </div>

    </div>
@endsection
