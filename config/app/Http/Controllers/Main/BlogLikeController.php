<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\BlogLike;
use Illuminate\Http\Request;

class BlogLikeController extends Controller
{
    //
    public function store(Request $request, Blog $blog){
        $user = Auth::user();

    if (!$user->hasLiked($blog->id)) {
        $blog->likes()->create(['user_id' => $user->id]);
    }

    return response()->json([
        'count' => BlogLike::where('like_blog_id', $blog->id)->count()
    ]);

    }

    public function destroy(Request $request){
        $user_id = Auth::id();
        $blog_id = $request->blog_id;

        BlogLike::where('user_id' , $user_id)
        ->where('blog_id' , $blog_id)
        ->delete();

        $likeCount = BlogLike::where('blog_id' , $blog_id)->count();

        return response()->json(['count' => $count]);
    }
}
