<?php

namespace App\Http\Controllers;

use App\Models\Music;
use App\Models\Video;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query    = $request->input('q', '');
        $artist   = $request->input('artist', '');
        $album    = $request->input('album', '');
        $year     = $request->input('year', '');
        $type     = $request->input('type', 'all'); // all, music, video

        $musicResults = collect();
        $videoResults = collect();

        if ($type === 'all' || $type === 'music') {
            $mq = Music::query();
            if ($query)  $mq->where('title', 'like', "%$query%");
            if ($artist) $mq->where('artist', 'like', "%$artist%");
            if ($album)  $mq->where('album', 'like', "%$album%");
            if ($year)   $mq->where('year', $year);
            $musicResults = $mq->get();
        }

        if ($type === 'all' || $type === 'video') {
            $vq = Video::query();
            if ($query)  $vq->where('title', 'like', "%$query%");
            if ($artist) $vq->where('artist', 'like', "%$artist%");
            if ($album)  $vq->where('album', 'like', "%$album%");
            if ($year)   $vq->where('year', $year);
            $videoResults = $vq->get();
        }

        return view('search', compact('musicResults', 'videoResults', 'query', 'artist', 'album', 'year', 'type'));
    }
}
