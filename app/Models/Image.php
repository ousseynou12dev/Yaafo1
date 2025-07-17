<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['alert_id', 'path'];

    public function alert()
    {
        return $this->belongsTo(Alert::class);
    }
    public function getUrlAttribute()
{
    return asset('storage/' . $this->path);
}

}
