<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class AdminVideoController extends Controller
{
    public function index()
    {
        $videos = Video::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.video.index', compact('videos'));
    }

    public function create()
    {
        return view('admin.video.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'    => 'required|string|max:200',
            'artist'   => 'required|string|max:200',
            'year'     => 'required|integer|min:1900|max:2030',
            'genre'    => 'required|string',
            'language' => 'required|in:Regional,English',
        ]);

        $data = $request->except(['_token', 'thumbnail_file']);
        $data['is_new'] = true;

        if ($request->hasFile('thumbnail_file')) {
            $file = $request->file('thumbnail_file');
            $name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $name);
            $data['thumbnail'] = $name;
        }

        Video::create($data);

        return redirect()->route('admin.video.index')->with('success', 'Video added successfully!');
    }

    public function edit($id)
    {
        $video = Video::findOrFail($id);
        return view('admin.video.edit', compact('video'));
    }

    public function update(Request $request, $id)
    {
        $video = Video::findOrFail($id);

        $request->validate([
            'title'    => 'required|string|max:200',
            'artist'   => 'required|string|max:200',
            'year'     => 'required|integer|min:1900|max:2030',
            'genre'    => 'required|string',
            'language' => 'required|in:Regional,English',
        ]);

        $data = $request->except(['_token', '_method', 'thumbnail_file']);

        if ($request->hasFile('thumbnail_file')) {
            $file = $request->file('thumbnail_file');
            $name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $name);
            $data['thumbnail'] = $name;
        }

        $video->update($data);

        return redirect()->route('admin.video.index')->with('success', 'Video updated!');
    }

    public function destroy($id)
    {
        Video::findOrFail($id)->delete();
        return redirect()->route('admin.video.index')->with('success', 'Video deleted.');
    }
}
