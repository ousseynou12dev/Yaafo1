<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    // Méthode pour récupérer toutes les catégories
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }
}
