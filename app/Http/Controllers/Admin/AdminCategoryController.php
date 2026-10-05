<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('type')->orderBy('name')->paginate(20);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'type' => 'required|in:genre,language,year,album,artist',
        ]);

        Category::create([
            'name' => $request->name,
            'type' => $request->type,
            'slug' => strtolower(str_replace(' ', '-', $request->name)),
            'description' => $request->description,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category added!');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'type' => 'required|in:genre,language,year,album,artist',
        ]);

        Category::findOrFail($id)->update([
            'name' => $request->name,
            'type' => $request->type,
            'slug' => strtolower(str_replace(' ', '-', $request->name)),
            'description' => $request->description,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated!');
    }

    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted.');
    }
}
