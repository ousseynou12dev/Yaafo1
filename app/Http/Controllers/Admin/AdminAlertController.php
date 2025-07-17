<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alert;
use App\Models\Projet;
use Illuminate\Http\Request;

class AdminAlertController extends Controller
{
   public function __construct()
{
    $this->middleware('auth');
    $this->middleware('isAdmin')->except('index');
}


 public function index(Request $request)
{
    $user = auth()->user();

    // ✅ Redirection si ce n'est pas un admin
    if ($user->role !== 'admin') {
        return redirect()->route('user.dashboard');
    }

    // 🔍 Recherche par mot-clé dans le titre ou description
    $query = Alert::query();

    if ($request->filled('search')) {
        $query->where(function ($q) use ($request) {
            $q->where('title', 'like', '%' . $request->search . '%')
              ->orWhere('description', 'like', '%' . $request->search . '%');
        });
    }

    $alertesRecentes = $query->latest()->limit(10)->get();

    // 📊 Statistiques globales (utilisées dans les cartes)
    $alertesCount = Alert::count();
    $usersCount = \App\Models\User::count();
    $categoriesCount = \App\Models\Category::count();

    // 📅 Données du graphique des 7 derniers jours
    $dates = collect(range(6, 0))->map(function ($daysAgo) {
        return now()->subDays($daysAgo)->format('d/m');
    });

    $valideesData = [];
    $rejeteesData = [];
    $attenteData = [];

    foreach ($dates as $date) {
        $day = \Carbon\Carbon::createFromFormat('d/m', $date)->setYear(now()->year);

        $valideesData[] = Alert::whereDate('created_at', $day)->where('status', 'validée')->count();
        $rejeteesData[] = Alert::whereDate('created_at', $day)->where('status', 'rejetée')->count();
        $attenteData[]  = Alert::whereDate('created_at', $day)->whereNull('status')->count();
    }

    return view('admin.dashboard', compact(
        'alertesRecentes',
        'alertesCount',
        'usersCount',
        'categoriesCount',
        'dates',
        'valideesData',
        'rejeteesData',
        'attenteData'
    ));
}



    public function updateStatus($id, $status)
    {
        $alerte = Alert::findOrFail($id);
        $alerte->status = $status;
        $alerte->save();

        // Créer le projet automatiquement si résolue et pas encore de projet
        if ($status === 'résolue' && !Projet::where('alert_id', $alerte->id)->exists()) {
            Projet::create([
                'titre' => $alerte->title,
                'description' => $alerte->description,
                'quartier' => $alerte->quartier,
                'objectif' => 500000, // valeur par défaut
                'user_id' => $alerte->user_id,
                'alert_id' => $alerte->id,
                'approuve' => true,
            ]);
        }

        return back()->with('success', 'Statut mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $alerte = Alert::findOrFail($id);

        foreach ($alerte->images as $image) {
            if (\Storage::exists($image->path)) {
                \Storage::delete($image->path);
            }
            $image->delete();
        }

        $alerte->delete();

        return back()->with('success', 'Alerte supprimée avec succès.');
    }
}
