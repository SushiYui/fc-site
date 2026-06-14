@extends('layouts.app', ['navColor' => 'bg-transparent'])

@section('content')
    <div class="relative z-20 max-w-7xl mx-auto sm:px-6 lg:px-8 pb-5">

        <p class="mb-3 text-center text-[#005e3c] text-[25px] font-bold">送信完了</p>
        <p class="text-center">入力されたメールアドレスにメールを送付しました。ご確認ください。</p>

        <div class="mt-4 flex justify-center">
            <a href="{{ route('join.guide') }}" class="bg-[#1E4737] rounded-[100px] mr-[30px]
            mb-[20px] px-12 py-3 text-[#E2FF91] no-underline hover:underline inline-flex justify-center items-center">
            新規入会ページへ戻る<span class="dli-chevron-round-right ml-[0.8em]"></span></a>
        </div>

    </div>
@endsection
