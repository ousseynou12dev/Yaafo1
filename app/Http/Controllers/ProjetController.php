<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Alert;
use App\Models\Category;
use Carbon\Carbon;
use App\Models\Contribution;
class ProjetController extends Controller
{
    // Afficher tous les projets approuvés (page publique)
    public function index()
    {
        $projets = Projet::where('approuve', true)->latest()->paginate(6);
        return view('cartesdesalertes', compact('projets'));
    }

    // Afficher le formulaire création projet
    public function create()
    {
        return view('projets.create');
    }

    // Enregistrer un nouveau projet

public function store(Request $request)
{
    $request->validate([
        'titre' => 'required|string|max:255',
        'description' => 'required|string',
        'objectif' => 'required|numeric|min:0',
        'quartier' => 'nullable|string|max:255',
        'image' => 'nullable|image|max:2048',
    ]);

    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('projets', 'public');
    }

    Projet::create([
        'titre' => $request->titre,
        'description' => $request->description,
        'objectif' => $request->objectif,
        'quartier' => $request->quartier,
        'image' => $imagePath,
        'user_id' => Auth::id(),
    ]);

    // 🔁 Préparer les variables nécessaires à cartesdesalertes.blade.php
    $alertes = Alert::with(['commentaires.user', 'images', 'category', 'user'])
        ->whereNotNull('latitude')
        ->whereNotNull('longitude')
        ->latest()
        ->get();

    $projets = Projet::where('approuve', true)->latest()->paginate(6);

    $alertesJs = $alertes->map(function ($a) {
        return [
            'id' => $a->id,
            'title' => $a->title,
            'description' => $a->description,
            'quartier' => $a->quartier,
            'statut' => $a->status,
            'latitude' => $a->latitude,
            'longitude' => $a->longitude,
            'created_at' => $a->created_at,
            'images' => $a->images->map(fn ($img) => ['path' => asset('storage/' . $img->path)]),
            'category' => [
                'id' => $a->category?->id ?? null,
                'name' => $a->category?->nom ?? 'Non catégorisée',
            ],
            'auteur' => $a->user->name ?? 'Anonyme',
            'commentaires' => $a->commentaires->map(fn($c) => [
                'contenu' => $c->contenu,
                'auteur' => $c->user->name ?? 'Anonyme',
                'date' => $c->created_at->format('d/m/Y'),
            ]),
        ];
    });

    $categories = Category::all();
    $quartiers = Alert::select('quartier')->distinct()->whereNotNull('quartier')->pluck('quartier');
    $statistiques = [
        'total' => Alert::count(),
        'actives' => Alert::whereIn('status', ['ouverte', 'en_cours'])->count(),
        'resolues' => Alert::where('status', 'résolue')->count(),
        'mois' => Alert::whereMonth('created_at', Carbon::now()->month)->count(),
    ];

    return view('cartesdesalertes', compact(
        'alertes', 'alertesJs', 'categories', 'quartiers', 'statistiques', 'projets'
    ))->with('success', 'Projet soumis pour validation.');
}

    // Afficher un projet spécifique
  public function show(Projet $projet)
{
    if (!$projet->approuve) {
        abort(404);
    }

    // Récupérer tous les projets approuvés AVEC leur alerte associée
    $projets = Projet::with('alert')
        ->where('approuve', true)
        ->whereHas('alert', function ($q) {
            $q->whereNotNull('latitude')->whereNotNull('longitude');
        })
        ->get();

    $projet->load('alert.images'); // 👈 charge les images de l'alerte liée
return view('projets.show1', compact('projet', 'projets'));

}

// ProjetController.php


public function carteProjets()
{
    $projets = Projet::select('id', 'titre', 'description', 'objectif', 'montant_actuel', 'latitude', 'longitude')->get();

    return view('projets.show1', compact('projets'));
}
public function storeContribution(Request $request, Projet $projet)
    {
        $request->validate([
            'montant' => 'required|numeric|min:500',
        ]);

        // Incrémente la colonne 'recolte' du projet
        $projet->increment('recolte', $request->montant);

        return back()->with('success', 'Merci pour votre contribution de ' . $request->montant . ' F CFA !');
    }
    public function showContributionForm(Projet $projet)
{
    return view('projets.contribuer', compact('projet'));
}


public function contribuer(Request $request, Projet $projet)
{
    $request->validate([
        'montant' => 'required|integer|min:500',
    ]);

    Contribution::create([
        'projet_id' => $projet->id,
        'user_id' => auth()->id(),
        'montant' => $request->montant,
    ]);

    $projet->increment('recolte', $request->montant);

    return back()->with('success', 'Merci pour votre contribution !');
}
}
