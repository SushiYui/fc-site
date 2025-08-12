<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $blogs = Blog::orderBy('created_at', 'desc')->paginate(10);

        // ③ カテゴリー絞り込み
        // 表示用：英語名 => 日本語名の対応
        $categoryMap = [
            'chiikawa' => 'ちいかわ',
            'hachiwari' => 'ハチワレ',
            'usagi' => 'うさぎ',
            'staff' => 'スタッフ',
        ];

        // 表示するリンク用：英語の配列
        $categories = array_keys($categoryMap);

        // ブログのクエリを作成
        $query = Blog::query()->with(['admin']); // 後で admin 関連を使いたいから with する

        // カテゴリ（投稿者）で絞り込み
        if ($request->has('category') && isset($categoryMap[$request->category])) {
            $adminName = $categoryMap[$request->category];

            $query->whereHas('admin', function ($q) use ($adminName) {
                $q->where('name', $adminName);
            });
        }
        return view('blogs.index', compact('blogs', 'categories', 'categoryMap'));
    }

    //
    public function create()
    {
        return view('blogs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'body' => 'nullable',
            'image' => 'nullable|image'
        ]);

        if ($request->hasFile('image')) {
            // 画像の保存先：storage/app/public/blogs 画像名をユーザーが指定する必要がないから今回はstoreメソッドを使う
            $path = $request->file('image')->store('blogs', 'public');
            $validated['image_path'] = $path;
        }

        $validated['user_id'] = auth()->id();
        Blog::create($validated);
        return redirect()->route('fanclub.home')->with('success', '投稿完了！');
    }

    public function show($id)
    {
        $blogItem = Blog::findOrFail($id);
            return view('blogs.show', compact('blogItem'));
    }

    public function update(Request $request, $id){
            $blogItem = Blog::findOrFail($id);

            Blog::where('id', $id)->update([
            'title'=> $request->blog_title,
            'body'=> $request->blog_body,
        ]);

         // 画像の更新処理
        if($request->hasFile('image_path')){

        $photo = $request->file('image_path')->getClientOriginalName();

        $photoName = pathinfo($photo, PATHINFO_FILENAME);

        $extension = $request->file('image_path')->getClientOriginalExtension();

        $newPhoto = $photoName . '_'. time() .'.' . $extension;

        Storage::disk('public')->putFileAs('blogs', $request->file('image_path'), $newPhoto);

        if($blogItem->image_path) {
            Storage::delete('blogs/' . $blogItem->image_path);
        }

        $blogItem->image_path ='blogs/' . $newPhoto;
        }

        $blogItem->save();


        return redirect()->route('blogs.show', ['id' => $id]);
    }

    public function destroy($id)
    {
        $blogItem = Blog::findOrFail($id);

        // 画像削除処理
        if ($blogItem->image_path) {
            Storage::disk('public')->delete($blogItem->image_path);
        }

        $blogItem->delete();
        return redirect()->route('blogs.create');
    }
}
