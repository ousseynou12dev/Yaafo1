<?php
  namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    protected $fillable = [
        'titre',
        'description',
        'objectif',
        'montant_actuel',
        'approuve',
        'quartier',
        'image',
        'user_id',
        'alert_id',
    ];

   public function alert()
{
    return $this->belongsTo(Alert::class);
}
public function user()
{
    return $this->belongsTo(User::class);
}
public function getImageUrlAttribute()
{
    if ($this->image) {
        return asset('storage/' . $this->image);
    }

    return $this->alert?->images?->first()?->url ?? '/img/default.jpg';
}
// Retourne la somme des contributions reçues
public function getMontantActuelAttribute()
{
    return $this->recolte; // ta colonne 'recolte'
}

// Calcule le pourcentage d’avancement
public function getPourcentageAttribute()
{
    if ($this->objectif > 0) {
        return min(100, round(($this->montant_actuel / $this->objectif) * 100));
    }
    return 0;
}
public function contributions()
{
    return $this->hasMany(Contribution::class);
}

}
