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


        <div class="mb-[120px]">
            <div>
                <p class="mx-auto my-20 pb-10 text-[15px] text-[#005e3c] border-b border-black/20 text-center">
                CreamSODA FAN CLUB「喫茶店」では、会員限定コンテンツやライブチケット先行など、
                特別な体験をお届けします。</p>
            </div>

            {{-- MOVIE --}}
            <div class="pb-10 mt-[10px] px-[7%] py-[10%] bg-[#006360] mb-5 rounded-[20px]">
                <h3 class="mb-5 font-bold leading-tight text-[25px] text-[#FFFFFF] text-center">喫茶店MOVIE</h3>
                <p class="text-[15px] text-[#FFFFFF] text-center">ここでしか見られないメンバートークや<br>ライブの舞台裏映像などを配信！</p>
            </div>

            {{-- MOMENT --}}
            <div class="pb-10 mt-[10px] px-[7%] py-[10%] bg-[#006360] mb-5 rounded-[20px]">
                <h3 class="mb-5 font-bold leading-tight text-[25px] text-[#FFFFFF] text-center">喫茶店MOMENT</h3>
                <p class="text-[15px] text-[#FFFFFF] text-center">24時間限定で、メンバーの今をお届け！</p>
            </div>

            {{-- REPORT --}}
            <div class="pb-10 mt-[10px] px-[7%] py-[10%] bg-[#006360] mb-5 rounded-[20px]">
                <h3 class="mb-5 font-bold leading-tight text-[25px] text-[#FFFFFF] text-center">喫茶店REPORT</h3>
                <p class="text-[15px] text-[#FFFFFF] text-center">ライブ後のメンバーの感想や<br>スタッフから見たメンバーの様子などレポートで配信！</p>
            </div>

            {{-- GALLERY --}}
            <div class="pb-10 mt-[10px] px-[7%] py-[10%] bg-[#006360] mb-5 rounded-[20px]">
                <h3 class="mb-5 font-bold leading-tight text-[25px] text-[#FFFFFF] text-center">喫茶店GALLERY</h3>
                <p class="text-[15px] text-[#FFFFFF] text-center">『喫茶店』限定で<br>SNSに上がらない写真をお届け！</p>
            </div>
        </div>

        <div class="mb-[100px]">
        {{-- TICKET --}}
            <div class="mb-10">
                <div class=""><p class="mb-3 text-center text-[#005e3c] text-[25px] font-bold">
                    TICKET</p></div>
                <p class="text-center">ライブやイベントに<br>最速先行申し込みが出来ます！
                <span class="text-[13px]"><br>※対象外となる公演もございます。</span></p>
            </div>
        {{-- LIVE --}}
            <div class="mb-10">
                <div class=""><p class="mb-3 text-center text-[#005e3c] text-[25px] font-bold">
                    LIVE</p></div>
                <p class="text-center">会員限定で<br>ライブやイベントを開催します！
            </div>
        {{-- GOODS --}}
            <div class="mb-10">
                <div class=""><p class="mb-3 text-center text-[#005e3c] text-[25px] font-bold">
                    GOODS</p></div>
                <p class="text-center">会員限定のGOODS販売や<br>ライブGOODSの先行販売を実施！
            </div>
        {{-- BIRTHDAY --}}
            <div class="mb-10">
                <div class=""><p class="mb-3 text-center text-[#005e3c] text-[25px] font-bold">
                    Birthday</p></div>
                <p class="text-center">Birthday月にお祝いメッセージ配信！<br>オリジナルポストカードを送付！
                    <br>メンバーがお誕生日をお祝いします！
            </div>

        </div>

        {{-- POINT --}}
         <div class="pb-10 px-[7%] py-[10%] bg-[#006360] mb-[100px] rounded-[20px]">
                <h3 class="mb-5 font-bold leading-tight text-[25px] text-[#FFFFFF] text-center">MEMBER'S POINT<br>喫茶店POINT</h3>
                <p class="text-[15px] text-[#FFFFFF] text-center">貯めたポイントで様々な特典が受けられます！
                <br>POINTは会員でいる限り永久不滅！</p>
            <div class="flex justify-center mt-8">
            <a href="" class="bg-[#FFFFFF] rounded-[100px]
            mb-[20px] px-12 py-3 no-underline hover:underline inline-flex items-center" hover:underline>
            POINTについて<span class="dli-chevron-round-right"></span></a>
            </div>
        </div>

        <div class="mb-[100px]">
            <h3 class="mb-5 font-bold leading-tight text-[25px]  text-center">CreamSODA Official Fan Club
                <br>喫茶店では</h3>
            <p class="text-[25px] text-center font-bold">★年会費コース/月会費コース★
            <br>2種類のお支払方法を選択できます。</p>
        </div>

        {{-- 入会特典 --}}
         <div class="pb-10 px-[7%] py-[10%] bg-[#006360] mb-[100px] rounded-[20px]">
                <h3 class="mb-5 font-bold leading-tight text-[25px] text-[#FFFFFF] text-center">年会費コースのご案内</h3>
                <ul>
                    <li class="text-[#FFFFFF]">★MEMBERSカードを発行します。<br>※申し込み完了後、翌月末に発送を予定しています。<li>
                    <li class="text-[#FFFFFF]">★年会費コース限定でピンバッジをプレゼント。</li>
                    <li class="text-[#FFFFFF]">★入会特典で100POINTをGET。</li>
                    <li class="text-[#FFFFFF]">★月会費コースよりも先行してイベントに応募できる場合があります。</li>
                </ul>
        </div>

        {{-- お支払方法 --}}
         <div class="pb-10 px-[7%] py-[10%] bg-[#FFFFFF] mb-[100px] rounded-[20px]">
            {{-- 年会費コース --}}
            <div class="mb-5">
                <h3 class="mb-5 font-bold leading-tight text-[25px] text-center">年会費コース</h3>
                    <div class="flex gap-2 mb-2">
                        <div class="p-[20px] border rounded-[20px] bg-[#daece5] text-center w-full">
                        <p class="block w-[140px] mx-auto bg-[#006b45] text-white text-center font-bold rounded-full py-1">
                                入会金</p>
                            <p class="mt-3 font-bold text-2xl">1,000円(税込み)</p>
                        </div>
                        <div class="p-[20px] border rounded-[20px] bg-[#daece5] text-center w-full">
                        <p class="block w-[140px] mx-auto bg-[#006b45] text-white text-center font-bold rounded-full py-1">
                                年会費</p>
                            <p class="mt-3 font-bold text-2xl">5,000円(税込み)</p>
                        </div>
                    </div>
                    <div class="mb-2 p-[20px] border rounded-[20px] bg-[#daece5] text-center">
                        <p class="block w-[140px] mx-auto bg-[#006b45] text-white text-center font-bold rounded-full py-1">
                            会員期間</p>
                        <p class="mt-3 font-bold text-[18px]">
                            ご入会月を含む12か月<br>
                            <span class="text-[13px]">※2026年5月30日にご入会の場合、会員期間は2027年4月30日まで。</span></p>
                    </div>
                    <div class="p-[20px] border rounded-[20px] bg-[#daece5]">
                        <p class="block w-[140px] mx-auto bg-[#006b45] text-white text-center font-bold rounded-full py-1">
                            お支払方法</p>
                        <ul class="w-fit mx-auto mt-3 font-bold leading-loose list-disc">
                            <li>クレジットカード支払い</li>
                            <li>コンビニ支払い</li>
                        </ul>
                        <p class="mt-3 text-[13px]">※クレジットカード支払いの場合は自動毛族となります。
                            自動継続を停止したい場合は、<span>会員期限の20日までに </span>「マイページ」から
                            ご自身で設定してください。期限を過ぎますと自動継続となりますのでご注意ください。
                            <br>※コンビニ支払手数料300円(税込み)
                        </p>
                    </div>
            </div>
            {{-- 月会費コース --}}
            <div>
                <h3 class="mb-5 font-bold leading-tight text-[25px] text-center">月会費コース</h3>
                    <div class="mb-2 p-[20px] border rounded-[20px] bg-[#daece5] text-center">
                        <p class="block w-[140px] mx-auto bg-[#006b45] text-white text-center font-bold rounded-full py-1">
                            月会費</p>
                        <p class="mt-3 font-bold text-2xl">550円(税込み)</p>
                    </div>
                    <div class="p-[20px] border rounded-[20px] bg-[#daece5]">
                        <p class="block w-[140px] mx-auto bg-[#006b45] text-white text-center font-bold rounded-full py-1">
                            お支払方法</p>
                        <ul class="w-fit mx-auto mt-3 font-bold leading-loose list-disc">
                            <li>クレジットカード支払い</li>
                            <li>d払い</li>
                            <li>auかんたん決済</li>
                            <li>ソフトバンクまとめて支払い</li>
                        </ul>

                    </div>
            </div>
        </div>



    </div>
@endsection
