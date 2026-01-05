<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\MV;
use Illuminate\Http\Request;

class MVController extends Controller
{
    public function index(Request $request)
    {
        $selectedMvCategory = $request->input('category');

        $mvs = MV::when($selectedMvCategory, function($query, $selectedMvCategory){
            $query->where('category', $selectedMvCategory);
        })
        ->orderBy('released_at', 'desc')->paginate(6);

        // カテゴリー絞り込み
        $category = $request->input('category');
        if ($category) {
                $mvs->where('category', $category);
            }

        $categories = ['MV', 'LIVE', 'DOCUMENTARY', 'COMMENTARY', 'TEASER'];

        return view('mv.index', compact('mvs', 'categories', 'selectedMvCategory'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mv.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'url' => 'required|url|max:255',
            'released_at' => 'required|date|before_or_equal:today',
        ]);

        MV::create($validated);
        return redirect()->route('fanclub.home')->with('success', '投稿完了！');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $mvItem = MV::FindOrFail($id);
        return view('mv.show', compact('mvItem'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $mvItem = MV::findOrFail($id);

        MV::where('id', $id)->update([
            'title'=> $request->mv_title,
            'category'=> $request->mv_category,
            'url'=> $request->mv_url,
            'released_at'=> $request->released_at,
        ]);
        return redirect()->route('mv.show', ['id' => $request->mv_id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $mvItem = MV::findOrFail($id);
        return redirect()->route('mv.create');
    }
}
