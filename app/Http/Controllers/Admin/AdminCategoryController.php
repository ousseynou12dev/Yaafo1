<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        Category::create(['name' => $request->name]);

        return back()->with('success', 'Catégorie ajoutée avec succès.');
    }

    public function update(Request $request, Category $category)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $category->update(['name' => $request->name]);

        return back()->with('success', 'Catégorie modifiée avec succès.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with('success', 'Catégorie supprimée avec succès.');
    }
}
