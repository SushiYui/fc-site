<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Live;
use App\Models\MV;
use App\Models\Schedule;
use App\Models\Blog;
use App\Models\Movie;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FanclubController extends Controller
{
    public function index()
    {

        $latestNews = News::orderBy('published_at', 'desc')->take(4)->get();
        $latestLives = Live::latest('date')->take(3)->get();
        $latestMVs = MV::orderBy('created_at', 'desc')->take(2)->get();
        $latestSchedules = Schedule::orderBy('date', 'desc')->take(3)->get();
        $latestBlog = Blog::orderBy('created_at', 'desc')->first();
        $latestMovies = Movie::orderBy('created_at', 'desc')->take(4)->get();
        $latestGalleys = gallery::orderBy('created_at', 'desc')->first();
        // dd($latestLives);
        return view('fanclub.home', compact('latestNews','latestLives', 'latestMVs', 'latestSchedules', 'latestBlog','latestMovies', 'latestGalleys'));
    }

}
