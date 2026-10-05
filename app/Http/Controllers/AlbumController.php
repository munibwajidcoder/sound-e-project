<?php

namespace App\Http\Controllers;

use App\Models\Music;
use App\Models\Category;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index()
    {
        // Get all unique albums from music and category tables
        $albumCategories = Category::where('type', 'album')->get();
        
        // Group music by album name
        $albums = Music::select('album', \DB::raw('count(*) as track_count'), \DB::raw('MAX(cover_image) as cover'))
            ->whereNotNull('album')
            ->where('album', '!=', '')
            ->groupBy('album')
            ->paginate(12);

        return view('albums.index', compact('albums', 'albumCategories'));
    }

    public function show($albumName)
    {
        $tracks = Music::where('album', $albumName)->get();
        return view('albums.show', compact('albumName', 'tracks'));
    }
}
