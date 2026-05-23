# fc-site
★ログイン
下記内容で管理者としてログイン可能
メールアドレス：test@example.com
パスワード：password

★2025/11/21（金）
<MOVIEコンテンツ>
・動画を保存する際にエラーが発生していたため、解消。
released_atカラムがないのに登録しようとしていた。
・index.bladeのデザインを整える。

<レポートコンテンツ>
index.bladeを編集中。カテゴリーボタンにALLを追加。
デザインを整える。完了していないため引き続き編集予定。

------------------------------------------------------------
★2025/11/25（火）
<レポートコンテンツ>
・カテゴリーボタンの編集。選択中かどうかで背景色の色を変更する。
・一覧ページに表示される各コンテンツのデザインを整える。
次回⇒いいねボタンの編集とカウントがされていないので調整。

------------------------------------------------------------
★2025/11/26（水）
<全ページのヘッダー>
・@extends('layouts.app')と@section('content')、@endsectionを追記。
layout/app.blade.phpがじかに適用される仕組みになっていたため、
各々のページで編集できるように修正。

------------------------------------------------------------
★2025/11/28（金）
<JAM'S New Contents>
・headerとmainの背景を一体化させる。
REPORTページしか調整していないので、次回他コンテンツも適用させる。

------------------------------------------------------------
★2025/12/30（火）
・MOVIE.indexページのhederとbodyの背景を一体化させる。
・最新MOVIEは上部に１つだけ拡張して表示して、
それ以外は下部『MORE MOVIE』に一覧で表示する。
・gallery.indexページのhederとbodyの背景を一体化させる。
・次回はmv.indexページのレイアウト作成。
　→hederとbodyの背景を一体化
　→カテゴリーごとに絞り込みが出来るようにする
　→1ページに表示できるのは10動画のみ。超えた場合は次のページに移る。

------------------------------------------------------------
★2026/1/12（月）
・新規入会ページ作成
・問題点
home.blade.phpで新規入会ボタンをクリックしてもTOPページ更新されるだけ。

-----------------------------------------------------------------
★2026/1/31（土）
・新規入会ページの修正
　→web.phpで下記に修正。
    Route::get('/', function () {
        return view('home');
    })->name('home');
    →app/Providers/RouteServiceProvider.phpを開いて
    　public const HOME = '/dashboard';
    上記内容を修正”予定”
■まとめ（ここ覚えておこ！）
    web.php は正しい
    キャッシュ or Breezeの自動制御が原因
    artisan clear 系で9割解決
    RouteServiceProvider も見る

-----------------------------------------------------------------
★2026/2/15（日）
■php artisan serveでログインページを日表示するのではなく、
　home.blade.phpへ飛ぶようにしたい。

【原因】navigation.blade.phpに下記コードあり。
　{{ Auth::user()->name }}
未ログイン時にAuth::user() は null。
Breezeは未ログインで auth 前提UIを読むと
内部で認証チェックが走って → login へリダイレクトされる。

→layouts\app.blade.phpに下記記載あり。
　 @include('layouts.navigation', ['navColor' => $navColor ?? null])
→こうする！
@auth
    @include('layouts.navigation', ['navColor' => $navColor ?? null])
@endauth
これで未ログイン時は navigation 自体読まれない。

■表示したいホーム画面はcontroller経由して遷移する！
×　NG
　Route::get('/', function () {
    return view('fanclub.home');
});

○　OK
Route::get('/', [FanclubController::class, 'index'])->name('home');

-----------------------------------------------------------------
★2026/2/17（火）
・php artisan serveしたときにエラーあり。
　表示不可のため、解消方法検索。
エラー：Attempt to read property "admin" on null
原因：Auth::user() が null（＝ログインしてない） なのに->adminを読み込もうとした。
修正版：@auth は「ログインしている時だけ」の意味。
@auth
    @if(Auth::user()->admin)
        ...
    @endif
@endauth
・消えたheaderを取り戻す。

-----------------------------------------------------------------
★2026/2/23（月）
・registrationフォルダーの作成
・次回：controllerとbladeの中身を作成

-----------------------------------------------------------------

★2026/5/23（土）
TOP⇒「新規入会」⇒FC紹介ページ（guide.blade.php）
⇒「入会はこちら」⇒メールアドレス入力ページ⇒メール送信
⇒メール内リンククリック⇒本登録フォーム（名前・住所など入力）

・ルートにjoinフォルダに飛ぶルート作成
・joinフォルダにemail、guide、registerのbladeを作成

【次回！】
・controller作成！
・画面遷移確認！
-----------------------------------------------------------------
