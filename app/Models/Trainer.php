<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Trainer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
        'description',
        'photo',
        'github',
        'linkedin',
        'twitter',
        'website',
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    /** ces sont les vraies fonctions getter/setter de la photo mais actuellement
     * j'ai utilisé faker pour générer des fausses url d'image qui fonctionne bien
    public function setPhotoAttribute($value)
    {
        // Supprimer l'ancienne photo si elle existe
        if ($this->attributes['photo'] ?? false) {
            Storage::disk('public')->delete($this->attributes['photo']);
        }

        // Enregistrer la nouvelle photo
        if ($value) {
            $path = $value->store('assets/trainers', 'public');
            $this->attributes['photo'] = $path;
        }
    }

    
    public function getPhotoAttribute()
    {
        return Storage::url($this->attributes['photo']);
    }
    */
}
