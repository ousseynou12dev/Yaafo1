<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
protected $fillable = ['alerte_id', 'auteur', 'texte', 'user_id'];

    public function alerte()
    {
        return $this->belongsTo(Alert::class, 'alerte_id');
    }
      public function user()
    {
        return $this->belongsTo(User::class);
    }
}
