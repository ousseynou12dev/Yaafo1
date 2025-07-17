<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Projet;
use App\Models\Alert;
use Illuminate\Http\Request;

class ProjetAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isAdmin');
    }

    /**
     * Affiche tous les projets issus d’alertes validées
     */
   public function index()
{
    // paginate(10) : retourne un LengthAwarePaginator, PAS une Collection simple
    $projets = Projet::with('user')
        ->whereNotNull('alert_id')
        ->latest()
        ->paginate(10);

    return view('admin.projets.index', compact('projets'));
}


    /**
     * Affiche le détail d’un projet
     */
   public function show(Projet $projet)
{
    $projet->load(['contributions.user']); // ← charge les contributions et leurs utilisateurs

    return view('admin.projets.show', compact('projet'));
}


    /**
     * Approuver un projet
     */
    public function approuver(Request $request, Projet $projet)
    {
        $projet->approuve = true;
        $projet->save();

        return redirect()->route('admin.projets.show', $projet)
            ->with('success', 'Projet approuvé avec succès.');
    }

    /**
     * Supprime un projet
     */
    public function destroy(Projet $projet)
    {
        $projet->delete();
        return redirect()->route('admin.projets.index')
            ->with('success', 'Projet supprimé.');
    }

    /**
     * Affiche le formulaire de création de projet depuis une alerte validée
     */
    public function creerDepuisAlerte(Alert $alert)
    {
        if ($alert->status !== 'validée') {
            return back()->with('error', 'Cette alerte n’a pas encore été validée.');
        }

        if ($alert->projet) {
            return back()->with('error', 'Un projet existe déjà pour cette alerte.');
        }

        return view('admin.projets.create', compact('alert'));
    }

    /**
     * Enregistre un projet à partir d’une alerte
     */
  public function storeDepuisAlerte(Request $request, Alert $alert)
{
    $request->validate([
        'objectif' => 'required|numeric|min:1000',
    ]);

    // Vérifier qu'un projet n'existe pas déjà pour cette alerte
    if ($alert->projet) {
        return back()->with('error', 'Un projet existe déjà pour cette alerte.');
    }

    Projet::create([
        'titre' => $alert->title ?? 'Projet issu de l\'alerte',
        'description' => $alert->description,
        'quartier' => $alert->quartier,
        'objectif' => $request->objectif,
        'user_id' => $alert->user_id,
        'alert_id' => $alert->id,
        'approuve' => true,
    ]);

    return redirect()->route('admin.dashboard')
        ->with('success', 'Projet créé avec succès à partir de l’alerte.');
}


    /**
     * Édite un projet existant
     */
    public function edit(Projet $projet)
    {
        return view('admin.projets.create', compact('projet'));
    }

    /**
     * Met à jour un projet existant
     */
    public function update(Request $request, Projet $projet)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'objectif' => 'required|numeric|min:1000',
        ]);

        $projet->update([
            'titre' => $request->titre,
            'description' => $request->description,
            'objectif' => $request->objectif,
        ]);

        return redirect()->route('admin.projets.index')
            ->with('success', 'Projet mis à jour avec succès.');
    }

    /**
     * Création rapide depuis bouton dashboard admin
     */
    public function creerRapide(Request $request)
    {
        $request->validate([
            'alert_id' => 'required|exists:alerts,id',
            'objectif' => 'required|numeric|min:1000',
        ]);

        $alerte = Alert::findOrFail($request->alert_id);

        // Vérifier si un projet existe déjà pour cette alerte
        if ($alerte->projet) {
            return back()->with('error', 'Un projet existe déjà pour cette alerte.');
        }

        Projet::create([
            'alert_id' => $request->alert_id,
            'objectif' => $request->objectif,
            'user_id' => $alerte->user_id,
            'titre' => 'Projet issu de l\'alerte',
            'description' => $alerte->description,
            'quartier' => $alerte->quartier,
            'approuve' => true,
        ]);

        return back()->with('success', 'Projet créé avec succès.');
    }
}
