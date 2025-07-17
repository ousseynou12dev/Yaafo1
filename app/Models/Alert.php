<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'title', 'description', 'category', 'status','image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
      public function commentaires()
    {
        return $this->hasMany(Commentaire::class, 'alerte_id');
    }
    public function category()
{
    return $this->belongsTo(Category::class);
}
public function images()
{
    return $this->hasMany(\App\Models\Image::class);
}
public function projet()
{
    return $this->hasOne(\App\Models\Projet::class);
}


}

