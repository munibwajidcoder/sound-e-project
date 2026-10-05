<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Music;
use App\Models\Video;
use App\Models\User;
use App\Models\Review;
use App\Models\Category;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalMusic    = Music::count();
        $totalVideos   = Video::count();
        $totalUsers    = User::where('role', 'user')->count();
        $totalReviews  = Review::count();
        $totalCategories = Category::count();
        $recentUsers   = User::where('role', 'user')->orderBy('created_at', 'desc')->take(5)->get();
        $recentReviews = Review::with('user')->orderBy('created_at', 'desc')->take(5)->get();

        return view('admin.dashboard', compact(
            'totalMusic', 'totalVideos', 'totalUsers',
            'totalReviews', 'totalCategories', 'recentUsers', 'recentReviews'
        ));
    }
}
