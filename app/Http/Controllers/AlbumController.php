<?php

namespace App\Http\Controllers;

use App\Models\Music;
use App\Models\Category;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index(Request $request)
    {
        $albumCategories = Category::where('type', 'album')->get();
        
        $query = Music::select(
            'album',
            \DB::raw('count(*) as track_count'),
            \DB::raw('MAX(cover_image) as cover'),
            \DB::raw('MAX(artist) as artist'),
            \DB::raw('MAX(genre) as genre'),
            \DB::raw('MAX(language) as language')
        )
        ->whereNotNull('album')
        ->where('album', '!=', '');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('album', 'like', '%' . $search . '%')
                  ->orWhere('artist', 'like', '%' . $search . '%')
                  ->orWhere('genre', 'like', '%' . $search . '%');
            });
        }

        $albums = $query->groupBy('album')->paginate(12)->withQueryString();

        $totalAlbums = Music::whereNotNull('album')->where('album', '!=', '')->distinct('album')->count('album');
        $totalTracks = Music::whereNotNull('album')->where('album', '!=', '')->count();

        return view('albums.index', compact('albums', 'albumCategories', 'totalAlbums', 'totalTracks'));
    }

    public function show($albumName)
    {
        $tracks = Music::where('album', $albumName)->get();
        return view('albums.show', compact('albumName', 'tracks'));
    }
}
