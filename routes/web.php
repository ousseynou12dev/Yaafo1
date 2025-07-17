<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AlertController;
use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\UserRegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjetController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminAlertController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\ProjetAdminController;

/*
|--------------------------------------------------------------------------
| Routes publiques accessibles à tous
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/cartesdesalertes', [AlertController::class, 'carte'])->name('cartes.alertes');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

// Affichage d'une alerte publique
Route::get('/alertes/{id}', [AlertController::class, 'show'])->name('alertes.show');

// Inscription utilisateur simple
Route::get('/userregister', [UserRegisterController::class, 'create'])->name('user.register');
Route::post('/userregister', [UserRegisterController::class, 'store'])->name('user.register.store');

// Projets publics
Route::get('/projets', [ProjetController::class, 'index'])->name('projets.index');
Route::get('/projets/{projet}', [ProjetController::class, 'show'])->name('projets.show');

/*
|--------------------------------------------------------------------------
| Routes protégées - Utilisateur connecté
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profil utilisateur
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Alertes utilisateur
    Route::get('/commentsamarche', [AlertController::class, 'mesAlertes'])->name('commentsamarche');
    Route::get('/alertes/create', [AlertController::class, 'create'])->name('alertes.create');
    Route::post('/alertes', [AlertController::class, 'store'])->name('alertes.store');
    Route::get('/alertes/{id}/edit', [AlertController::class, 'edit'])->name('alertes.edit');
    Route::put('/alertes/{id}', [AlertController::class, 'update'])->name('alertes.update');
    Route::delete('/alertes/{id}', [AlertController::class, 'destroy'])->name('alertes.destroy');
    Route::get('/alertes', [AlertController::class, 'mesAlertes'])->name('alertes.index');

    // Commentaires
    Route::post('/commentaires', [CommentaireController::class, 'store'])->name('commentaire.store');

    // Projets utilisateur
    Route::get('/projets/create', [ProjetController::class, 'create'])->name('projets.create');
    Route::post('/projets', [ProjetController::class, 'store'])->name('projets.store');

    // Contribution à un projet (POST formulaire)
    // Route GET pour afficher le formulaire
Route::get('/projets/{projet}/contribuer', [ProjetController::class, 'showContributionForm'])->name('projets.contribuer.form');

// Route POST pour envoyer la contribution
Route::post('/projets/{projet}/contribuer', [ProjetController::class, 'contribuer'])->name('projets.contribuer');
Route::post('/alertes/{alerte}/ajouter-image', [AlertController::class, 'ajouterImage'])->name('alertes.ajouterImage');
Route::get('/dashboard', [App\Http\Controllers\UserDashboardController::class, 'index'])->name('dashboard')->middleware('auth');

});

/*
|--------------------------------------------------------------------------
| Dashboard Admin (avec middleware isAdmin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'isAdmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Utilisateurs
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::patch('/users/{id}/toggle', [AdminUserController::class, 'toggleStatus'])->name('users.toggle');
    Route::delete('/users/{id}', [AdminUserController::class, 'destroy'])->name('users.destroy');

    // Alertes
    Route::get('/alertes', [AdminAlertController::class, 'index'])->name('alertes.index');
    Route::patch('/alertes/{id}/status/{status}', [AdminAlertController::class, 'updateStatus'])->name('alertes.updateStatus');
    Route::delete('/alertes/{id}', [AdminAlertController::class, 'destroy'])->name('alertes.destroy');

    // Catégories
    Route::get('/categories', [AdminCategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories', [AdminCategoryController::class, 'store'])->name('categories.store');
    Route::put('/categories/{category}', [AdminCategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [AdminCategoryController::class, 'destroy'])->name('categories.destroy');

    // Projets admin (CRUD sauf create/store manuel)
    Route::resource('projets', ProjetAdminController::class)->except(['create', 'store']);

    // Approuver un projet
    Route::post('projets/{projet}/approuver', [ProjetAdminController::class, 'approuver'])->name('projets.approuver');

    // Création via formulaire depuis alerte
    Route::get('projets/creer-depuis-alerte/{alert}', [ProjetAdminController::class, 'creerDepuisAlerte'])->name('projets.creerDepuisAlerte');
    Route::post('projets/creer-depuis-alerte/{alert}', [ProjetAdminController::class, 'storeDepuisAlerte'])->name('projets.storeDepuisAlerte');

    // Création rapide automatique depuis alerte
    Route::post('projets/creer-direct-depuis-alerte/{alert}', [ProjetAdminController::class, 'creerRapide'])->name('projets.creerDirectDepuisAlerte');

    // Edition d’un projet
    Route::get('projets/{projet}/edit', [ProjetAdminController::class, 'edit'])->name('projets.edit');
    Route::put('projets/{projet}', [ProjetAdminController::class, 'update'])->name('projets.update');

    // Paramètres admin
    Route::get('/parametres', fn () => view('admin.parametres'))->name('parametres');
});

/*
|--------------------------------------------------------------------------
| Routes d'authentification Laravel Breeze
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
