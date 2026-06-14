@extends('layouts.app', ['navColor' => 'bg-transparent'])

@section('content')
    <div class="relative z-20 max-w-7xl mx-auto sm:px-6 lg:px-8 pb-5">
       <p></p>
        <h2 class="font-bold leading-tight text-[20px] text-[#002928] mb-5">
            メールアドレス入力のご案内
        </h2>
       <p>ご連絡が可能なメールアドレスを入力してください。「CreamSODA OFFICIAL FAN CLUB「Ringo Jam」」
        よりメールをお送りいたします。<br>※重要なお知らせをお送りする場合があります。</p>
       <p class="mb-5 text-[#ff0000]">※iCloudをご利用の場合、iCloudメールのシステム状況により、
        受信が遅れる場合や届かない場合がございます。 GmailやYahoo等のフリーメールアドレスにてご登録いただくことを推奨いたします。</p>
        {{-- 自由事項 --}}

        <div class="mb-5">既にCreamSODA OFFICIAL FAN CLUB「CreamSODA」会員の方はご登録のメールアドレスを入力してください。
            <br>CreamSODA member IDをお持ちの方はご利用のメールアドレスでログインすると簡単にご利用いただけます。
        </div>

        <!-- Email Address -->
        <form action="{{ route('join.store') }}" method="post">
        @csrf
            <input type="email" name="email" placeholder="メールアドレス"
            class="w-full border border-gray-300 rounded-lg px-4 py-3 mb-6">

        <ul class="mb-5">
            <li>[登録する]をクリックするとCreamSODA member ID利用規約に同意したものとみなされます。</li>
            <li>既にCreamSODA member IDに登録済みのメールアドレスではご登録できません。</li>
            <li>ドメイン指定受信設定をされている方は、「CreamSODA.jp」ドメインを受信可能な設定にしてください。</li>
            <li>＜メールアドレス登録後メールが届かない方へ＞
            <br>エラー解除が必要な場合は、こちらから解除をお試しください。</li>
        </ul>

        {{-- メールアドレス登録 --}}
        <div class="flex justify-center">
            <button
                type="submit"
                class="bg-[#ff4500] text-white px-10 py-3 rounded-full">
                登録する
            </button>
            </div>

        </form>
    </div>
@endsection
