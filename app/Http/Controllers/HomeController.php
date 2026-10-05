<?php

namespace App\Http\Controllers;

use App\Models\Music;
use App\Models\Video;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Get 12 latest music items for rich home carousel
        $latestMusic = Music::orderBy('created_at', 'desc')->take(12)->get();

        // Get 12 latest videos for rich video section
        $latestVideos = Video::orderBy('created_at', 'desc')->take(12)->get();

        return view('home', compact('latestMusic', 'latestVideos'));
    }
}
