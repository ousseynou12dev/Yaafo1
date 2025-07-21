<?php
namespace App\Http\Controllers;

use App\Models\Alert;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
   public function index()
{
    $userId = auth()->id();

    $alertesRecentes = Alert::where('user_id', $userId)
        ->latest()
        ->limit(10)
        ->with('images', 'projet')
        ->get();

    $alertesCount = Alert::where('user_id', $userId)->count();

    // Nombre total de photos sur toutes ses alertes
    $photosCount = \DB::table('images')
        ->join('alerts', 'images.alert_id', '=', 'alerts.id')
        ->where('alerts.user_id', $userId)
        ->count();

    // Nombre de projets liés à ses alertes
    $projetsCount = \App\Models\Projet::whereHas('alert', function ($q) use ($userId) {
        $q->where('user_id', $userId);
    })->count();

    return view('users.dashboard', compact('alertesRecentes', 'alertesCount', 'photosCount', 'projetsCount'));
}

}
