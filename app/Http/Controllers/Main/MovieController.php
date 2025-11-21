<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    //
    public function index()
    {
        $movies=Movie::orderBy('released_at','desc')->paginate(6);
        return view('movies.index', compact('movies'));
    }

    public function create()
    {
        return view('movies.create');
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'released_at' => 'required|date|before_or_equal:today',
            'video' => 'required|file|mimetypes:video/mp4,video/quicktime,video/x-msvideo',
        ]);

        $path = $request->file('video')->store('public/movies');

        $validated['video_path'] = $path;

        Movie::create($validated);
        return redirect()->route('fanclub.home')->with('success', '投稿完了！');
    }

    public function show($id)
    {
        $movieItem = Movie::findOrFail($id);
        return view('movies.show', compact('movieItem'));
    }

    public function update(Request $request, $id)
    {
        $movieItem = Movie::findOrFil($id);

        Movie::where('id', $id)->update([
            'title'=> $request->movie_title,
            'url'=> $request->movie_url,
            'released_at'=> $request->released_at,
        ]);

        return redirect()->route('movies.show', ['id' => request->movie_id]);
    }

    public function destroy($id){
        $movieItem= Movie::findOrFile($id);
        return redirect()->route('movie.create');
    }
}
