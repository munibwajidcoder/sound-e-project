<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Music;
use Illuminate\Http\Request;

class AdminMusicController extends Controller
{
    public function index()
    {
        $music = Music::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.music.index', compact('music'));
    }

    public function create()
    {
        return view('admin.music.create');
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

        $data = $request->except(['_token', 'cover_image_file', 'audio_file']);
        $data['is_new'] = true;

        // Handle cover image upload
        if ($request->hasFile('cover_image_file')) {
            $file = $request->file('cover_image_file');
            $name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $name);
            $data['cover_image'] = $name;
        }

        // Handle audio upload
        if ($request->hasFile('audio_file')) {
            $file = $request->file('audio_file');
            $name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('audio'), $name);
            $data['audio_url'] = $name;
        }

        Music::create($data);

        return redirect()->route('admin.music.index')->with('success', 'Music track added successfully!');
    }

    public function edit($id)
    {
        $music = Music::findOrFail($id);
        return view('admin.music.edit', compact('music'));
    }

    public function update(Request $request, $id)
    {
        $music = Music::findOrFail($id);

        $request->validate([
            'title'    => 'required|string|max:200',
            'artist'   => 'required|string|max:200',
            'year'     => 'required|integer|min:1900|max:2030',
            'genre'    => 'required|string',
            'language' => 'required|in:Regional,English',
        ]);

        $data = $request->except(['_token', '_method', 'cover_image_file', 'audio_file']);

        if ($request->hasFile('cover_image_file')) {
            $file = $request->file('cover_image_file');
            $name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $name);
            $data['cover_image'] = $name;
        }

        if ($request->hasFile('audio_file')) {
            $file = $request->file('audio_file');
            $name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('audio'), $name);
            $data['audio_url'] = $name;
        }

        $music->update($data);

        return redirect()->route('admin.music.index')->with('success', 'Music track updated!');
    }

    public function destroy($id)
    {
        Music::findOrFail($id)->delete();
        return redirect()->route('admin.music.index')->with('success', 'Music track deleted.');
    }
}
