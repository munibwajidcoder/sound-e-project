<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    // All videos with filters
    public function index(Request $request)
    {
        $query = Video::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('artist', 'like', '%' . $search . '%')
                  ->orWhere('album', 'like', '%' . $search . '%')
                  ->orWhere('genre', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('language')) {
            $query->where('language', $request->language);
        }
        if ($request->filled('genre')) {
            $query->where('genre', $request->genre);
        }
        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }
        if ($request->filled('artist')) {
            $query->where('artist', 'like', '%' . $request->artist . '%');
        }
        if ($request->filled('album')) {
            $query->where('album', 'like', '%' . $request->album . '%');
        }

        $videos = $query->orderBy('created_at', 'desc')->paginate(12)->withQueryString();

        $genres    = Video::whereNotNull('genre')->where('genre', '!=', '')->distinct()->pluck('genre');
        $years     = Video::whereNotNull('year')->where('year', '!=', '')->distinct()->pluck('year')->sortDesc();
        $languages = Video::whereNotNull('language')->where('language', '!=', '')->distinct()->pluck('language');

        $totalVideos = Video::count();
        $totalViews  = Video::sum('views');
        $featuredVideo = Video::orderBy('views', 'desc')->first();

        return view('video.index', compact('videos', 'genres', 'years', 'languages', 'totalVideos', 'totalViews', 'featuredVideo'));
    }

    // Single video detail
    public function show($id)
    {
        $video   = Video::findOrFail($id);
        $reviews = Review::where('item_type', 'video')
                         ->where('item_id', $id)
                         ->with('user')
                         ->orderBy('created_at', 'desc')
                         ->get();

        $userReview = null;
        if (Auth::check()) {
            $userReview = Review::where('item_type', 'video')
                                ->where('item_id', $id)
                                ->where('user_id', Auth::id())
                                ->first();
        }

        $related = Video::where('genre', $video->genre)
                        ->where('id', '!=', $id)
                        ->take(4)->get();

        return view('video.show', compact('video', 'reviews', 'userReview', 'related'));
    }
}
