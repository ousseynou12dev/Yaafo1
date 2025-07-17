<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alert;
use Illuminate\Support\Str;

class HomeController extends Controller
{


public function index()
{
    $alertes = Alert::with(['images', 'category', 'user'])
        ->whereNotNull('latitude')
        ->whereNotNull('longitude')
        ->latest()
        ->take(10) // Tu peux ajuster le nombre
        ->get();

    $alertesJs = $alertes->map(function ($a) {
        return [
            'id' => $a->id,
            'title' => $a->title,
            'description' => Str::limit($a->description, 80),
            'quartier' => $a->quartier,
            'status' => $a->status,
            'latitude' => $a->latitude,
            'longitude' => $a->longitude,
        ];
    });

    return view('index', compact('alertes', 'alertesJs'));
}


    public function commentsamarche()
    {
        return view('commentsamarche');
    }

    public function cartesdesalertes()
    {
        return view('cartesdesalertes');
    }

    public function contact()
    {
        return view('contact');
    }
}
