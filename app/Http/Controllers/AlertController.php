<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alert;
use App\Models\Image;
use App\Models\Category;
use Carbon\Carbon;
use App\Models\Projet;

class AlertController extends Controller
{
    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'quartier' => 'required|string|max:100',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'images.*' => 'nullable|image|max:2048'
        ]);

        $alert = Alert::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'category_id' => $validated['category_id'],
            'quartier' => $validated['quartier'],
            'latitude' => $validated['latitude'] ?? null,
            'longitude' => $validated['longitude'] ?? null,
            'user_id' => auth()->id(),
            'status' => 'ouverte', // ✅ utilisé 'status'
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('alerts', 'public');
                $alert->images()->create(['path' => $path]);
            }
        }

        return redirect()->back()->with('success', 'Alerte envoyée avec succès !');
    }

    public function mesAlertes()
    {
        $alertes = Alert::with(['images', 'category'])->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        $categories = Category::all();

        return view('commentsamarche', compact('alertes', 'categories'));
    }

    public function carte(Request $request)
    {
        $query = Alert::with(['commentaires.user', 'images', 'category', 'user'])
            ->whereNotNull('latitude')
            ->whereNotNull('longitude');


        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('quartier')) {
            $query->where('quartier', 'like', '%' . $request->quartier . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status); // ✅ 'status'
        }

        $alertes = Alert::with(['user', 'images', 'category'])
                ->latest()
                ->paginate(9);


         $projets = Projet::where('approuve', true)->latest()->paginate(6);
        // Format JSON pour la carte
     $alertesJs = $alertes->map(function ($a) {
    return [
        'id' => $a->id,
        'title' => $a->title,
        'description' => $a->description,
        'quartier' => $a->quartier,
        'statut' => $a->status, // 👈 clé corrigée ici
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

        // ✅ Statistiques avec 'status'
        $statistiques = [
            'total' => Alert::count(),
            'actives' => Alert::whereIn('status', ['ouverte', 'en_cours'])->count(),
            'resolues' => Alert::where('status', 'résolue')->count(),
            'mois' => Alert::whereMonth('created_at', Carbon::now()->month)->count(),
        ];
       return view('cartesdesalertes', compact('alertes', 'alertesJs', 'categories', 'quartiers', 'statistiques', 'projets'));

    }

    public function destroy($id)
    {
        $alerte = Alert::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        foreach ($alerte->images as $image) {
            \Storage::disk('public')->delete($image->path);
            $image->delete();
        }

        $alerte->delete();

        return redirect()->back()->with('success', 'Alerte supprimée avec succès.');
    }

    public function edit($id)
    {
        $alerte = Alert::where('user_id', auth()->id())->with('images')->findOrFail($id);
        $alertes = Alert::where('user_id', auth()->id())->orderBy('created_at', 'desc')->get();
        $categories = Category::all();
        return view('commentsamarche', compact('alerte', 'alertes', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $alerte = Alert::where('user_id', auth()->id())->findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'quartier' => 'required|string|max:100',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'images.*' => 'nullable|image|max:2048'
        ]);

        $alerte->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'category_id' => $validated['category_id'],
            'quartier' => $validated['quartier'],
            'latitude' => $validated['latitude'] ?? null,
            'longitude' => $validated['longitude'] ?? null,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('alerts', 'public');
                $alerte->images()->create(['path' => $path]);
            }
        }

        return redirect()->route('commentsamarche')->with('success', 'Alerte mise à jour avec succès !');
    }
public function show($id)
{
    $alerte = Alert::with(['user', 'category', 'images'])->findOrFail($id);
    return view('alertes.show', compact('alerte'));
}
  public function ajouterImage(Request $request, Alert $alerte)
    {
        // Vérifier que l'utilisateur est bien l'auteur de l'alerte
        if ($request->user()->id !== $alerte->user_id) {
            abort(403, "Non autorisé à modifier cette alerte.");
        }

        // Validation de l'image
        $validated = $request->validate([
            'image' => 'required|image|max:2048', // max 2Mo, tu peux ajuster
        ]);

        // Stocker l'image dans storage/app/public/alertes (créer le dossier si besoin)
        $chemin = $request->file('image')->store('alertes', 'public');

        // Enregistrer l'image dans la table images, liée à l'alerte
        $image = new Image();
        $image->alert_id = $alerte->id;
        $image->path = $chemin;
        $image->save();

        return back()->with('success', 'Image ajoutée avec succès.');
    }

}
