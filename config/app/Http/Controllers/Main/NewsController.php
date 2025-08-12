<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::orderBy('published_at', 'desc')->paginate(10);
        return view('news.index', compact('news'));
    }

    public function show($id)
    {
        $newsItem = News::findOrFail($id);
        return view('news.show', compact('newsItem'));
    }

    public function update(Request $request, $id){
            $newsItem = News::findOrFail($id);
            
            News::where('id', $id)->update([
            'news_title'=> $request->news_title,
            'body'=> $request->body,
        ]);
        return redirect()->route('news.index', ['id' => $request->news_id]);
    }

    public function destroy($id){
        News::findOrFail($id)->delete();
        return redirect()->route('news.index');
    }
}
