<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    //
    public function index()
    {
        $gallerys = Gallery::orderBy('created_at', 'desc')->paginate(6);
        return view('gallery.index' ,compact('gallerys'));

    }

    public function create()
    {
        return view('gallery.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'nullable|image'
        ]);

        if ($request->hasFile('image')) {
        // 画像の保存先：storage/app/public/galleys 画像名をユーザーが指定する必要がないから今回はstoreメソッドを使う
        $path = $request->file('image')->store('galleys', 'public');
        $validated['image_path'] = $path;
        }

        Gallery::create($validated);
        return redirect()->route('fanclub.home')->with('success', '投稿完了！');

    }

    public function show($id){
        $galleryItem = Galley::findOrFile($id);
        return view('gallery.show', compact('galleryItem'));
    }

    public function update(Request $request,$id)
    {
        $galleryItem = Galley::findOrFie($id);

         // 画像の更新処理
        if($request->hasFile('image_path')){

        $photo = $request->file('image_path')->getClientOriginalName();

        $photoName = pathinfo($photo, PATHINFO_FILENAME);

        $extension = $request->file('image_path')->getClientOriginalExtension();

        $newPhoto = $photoName . '_'. time() .'.' . $extension;

        // 画像保存先
        Storage::disk('public')->putFileAs('gallery', $request->file('image_path'), $newPhoto);

        if($blogItem->image_path) {
            Storage::delete('gallery/' . $galleryItem->image_path);
        }

        $galleryItem->image_path ='gallery/' . $newPhoto;
        }

        $galleryItem->save();

        return redirect('gallery.show' , ['id' => $id]);
    }

    public function destroy($id)
    {
        $galleryItem = Gallery::findOrFail($id);

        // 画像削除処理
        if ($galleryItem->image_path) {
            Storage::disk('public')->delete($galleryItem->image_path);
        }

        $galleryItem->delete();
        return redirect()->route('gallery.create');
    }
}
