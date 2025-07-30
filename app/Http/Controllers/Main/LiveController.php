<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Live;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LiveController extends Controller
{
    public function index()
    {
        $lives = Live::orderBy('created_at', 'desc')->paginate(10);
        return view('lives.index', compact('lives'));
    }

    //
    public function create()
    {
        return view('live.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'date' =>'required|date',
            'place' => 'required',
            'ticket_info' => 'nullable',
            'image' => 'nullable|image'
        ]);

        if ($request->hasFile('image')) {
            // 画像の保存先：storage/app/public/lives 画像名をユーザーが指定する必要がないから今回はstoreメソッドを使う
            $path = $request->file('image')->store('lives', 'public');
            $validated['image_path'] = $path;
        }

        Live::create($validated);
        return redirect()->route('fanclub.home')->with('success', '投稿完了！');
    }

    public function show($id)
    {
        $liveItem = Live::findOrFail($id);
            return view('lives.show', compact('liveItem'));
    }

    public function update(Request $request, $id){
            $liveItem = Live::findOrFail($id);

            Live::where('id', $id)->update([
            'title'=> $request->live_title,
            'description'=> $request->live_description,
            'date'=> $request->live_date,
            'place'=> $request->live_place,
            'ticket_info'=> $request->ticket_info,
        ]);

         // 画像の更新処理
        if($request->hasFile('image_path')){

        $photo = $request->file('image_path')->getClientOriginalName();

        $photoName = pathinfo($photo, PATHINFO_FILENAME);

        $extension = $request->file('image_path')->getClientOriginalExtension();

        $newPhoto = $photoName . '_'. time() .'.' . $extension;

        Storage::disk('public')->putFileAs('lives', $request->file('image_path'), $newPhoto);

        if($liveItem->image_path) {
            Storage::delete('lives/' . $liveItem->image_path);
        }

        $liveItem->image_path ='lives/' . $newPhoto;
        }

        $liveItem->save();


        return redirect()->route('lives.show', ['id' => $id]);
    }

    public function destroy($id){
        Live::findOrFail($id)->delete();
        return redirect()->route('live.create');
    }

}
