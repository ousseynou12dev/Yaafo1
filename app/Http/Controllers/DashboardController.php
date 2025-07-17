<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Alert;
use App\Models\User;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Générer les 7 derniers jours
        $dates = collect(range(6, 0))->map(function ($i) {
            return Carbon::now()->subDays($i)->format('Y-m-d');
        });

        // Créer les datasets pour chaque statut
        $valideesData = [];
        $rejeteesData = [];
        $attenteData = [];

        foreach ($dates as $date) {
            $valideesData[] = Alert::whereDate('created_at', $date)->where('status', 'validée')->count();
            $rejeteesData[] = Alert::whereDate('created_at', $date)->where('status', 'rejetée')->count();
            $attenteData[] = Alert::whereDate('created_at', $date)->where('status', 'en attente')->count();
        }

        // Dernières alertes avec recherche optionnelle
        $search = $request->input('search');
        $alertesRecentes = Alert::query()
            ->when($search, fn ($query) => $query->where('title', 'like', "%$search%"))
            ->latest()
            ->with('user')
            ->take(5)
            ->get();

        return view('admin.dashboard', [
            'alertesCount' => Alert::count(),
            'usersCount' => User::count(),
            'categoriesCount' => Category::count(),
            'alertesRecentes' => $alertesRecentes,
            'nouveauxUtilisateurs' => User::latest()->take(5)->get(),
            'dates' => $dates,
            'valideesData' => $valideesData,
            'rejeteesData' => $rejeteesData,
            'attenteData' => $attenteData,
        ]);
    }
}
