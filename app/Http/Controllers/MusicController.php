<?php

namespace App\Http\Controllers;

use App\Models\Music;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MusicController extends Controller
{
    // All music with filters
    public function index(Request $request)
    {
        $query = Music::query();

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

        $music = $query->orderBy('created_at', 'desc')->paginate(12);

        $genres    = Music::distinct()->pluck('genre');
        $years     = Music::distinct()->pluck('year')->sortDesc();
        $languages = Music::distinct()->pluck('language');

        return view('music.index', compact('music', 'genres', 'years', 'languages'));
    }

    // Single music detail
    public function show($id)
    {
        $music   = Music::findOrFail($id);
        $reviews = Review::where('item_type', 'music')
                         ->where('item_id', $id)
                         ->with('user')
                         ->orderBy('created_at', 'desc')
                         ->get();

        $userReview = null;
        if (Auth::check()) {
            $userReview = Review::where('item_type', 'music')
                                ->where('item_id', $id)
                                ->where('user_id', Auth::id())
                                ->first();
        }

        $related = Music::where('genre', $music->genre)
                        ->where('id', '!=', $id)
                        ->take(4)->get();

        return view('music.show', compact('music', 'reviews', 'userReview', 'related'));
    }
}
