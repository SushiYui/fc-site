{{-- resources/views/blogs/show.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            ブログ詳細
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto py-8">
        {{-- 表示モード --}}
        <div id="view-mode" class="space-y-4">
            <h3 class="text-2xl font-bold">{{ $blogItem->title }}</h3>
            <p class="text-gray-600">{{ $blogItem->body }}</p>
            @if ($blogItem->image_path)
                <img src="{{ asset('storage/' . $blogItem->image_path) }}" alt="ブログ画像" class="w-full max-w-md">
            @endif
        </div>

        {{-- 編集モード（初期は非表示） --}}
        <form id="edit-form" action="{{ route('blogs.update', ['id' => $blogItem->id]) }}" method="POST" enctype="multipart/form-data" class="space-y-4 hidden">
            @csrf
            @method('PUT')

            <div>
                <label for="blog_title" class="block text-sm font-medium text-gray-700">タイトル</label>
                <input type="text" name="blog_title" id="blog_title" value="{{ $blogItem->title }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div>
                <label for="blog_body" class="block text-sm font-medium text-gray-700">本文</label>
                <textarea name="blog_body" id="blog_body" rows="5"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ $blogItem->body }}</textarea>
            </div>

            <div>
                <label for="image_path" class="block text-sm font-medium text-gray-700">画像</label>
                <input type="file" name="image_path" id="image_path"
                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                           file:rounded-md file:border-0 file:text-sm file:font-semibold
                           file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
            </div>

            <div>
                <button type="submit"
                    class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition">
                    保存する
                </button>
                <button type="button" id="cancel-edit"
                    class="ml-4 px-4 py-2 bg-gray-400 text-white rounded-md hover:bg-gray-500 transition">
                    キャンセル
                </button>
            </div>
        </form>

        {{-- 編集・削除ボタン（管理者だけ） --}}
        @php
            $adminNames = ['ちいかわ', 'ウサギ', 'スタッフ'];
        @endphp

        @if(in_array(Auth::user()->name, $adminNames))
            <div class="mt-6 text-right space-x-2">
                <button id="edit-toggle"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                    編集
                </button>

                <form action="{{ route('blogs.destroy', ['id' => $blogItem->id]) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        onclick="return confirm('本当に削除しますか？')"
                        class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition">
                        削除
                    </button>
                </form>
            </div>
        @endif
    </div>

    {{-- jQuery読み込み（必要なら） --}}
    @push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @endpush

    {{-- 編集切り替えスクリプト --}}
    <script>
        $(document).ready(function () {
            $('#edit-toggle').click(function () {
                $('#view-mode').hide();
                $('#edit-form').removeClass('hidden');
            });

            $('#cancel-edit').click(function () {
                $('#edit-form').addClass('hidden');
                $('#view-mode').show();
            });
        });
    </script>
</x-app-layout>
