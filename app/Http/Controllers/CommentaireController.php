<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commentaire;

class CommentaireController extends Controller
{
   public function store(Request $request)
{
    $request->validate([
        'alerte_id' => 'required|exists:alerts,id',
        'contenu' => 'required|string|max:1000',
    ]);

    Commentaire::create([
        'alerte_id' => $request->alerte_id,
        'auteur' => auth()->check() ? auth()->user()->name : 'Anonyme',
        'texte' => $request->contenu,
    ]);

    return redirect()->back()->with('success', 'Commentaire ajouté avec succès.');
}

}
