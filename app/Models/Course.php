<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'picture',
        'short_description',
        'description',
        'topic_id',
        'is_premium',
        'level'
    ];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    public function prerequisites()
    {
        return $this->hasMany(Prerequisite::class);
    }

    public function trainers()
    {
        return $this->belongsToMany(Trainer::class);
    }

    public function tutorials()
    {
        return $this->hasManyThrough(Tutorial::class, Section::class);
    }


    public function getPremiumLabel()
    {
        return $this->is_premium ? 'Premium' : 'Gratuit';
    }

    /* c'est la methode appelée automatiquement par laravel lorsqu'on récupère l'attribut is_premium
    public function getIsPremiumAttribute()
    {
        $totalTutorials = $this->tutorials()->count();
        
        $premiumTutorials = $this->tutorials()->where('is_premium', true)->count();

        return $totalTutorials === $premiumTutorials;
    }*/

    public function getLevelLabel()
    {
        switch ($this->level) {
            case 'debutant':
                return 'Débutant';
                break;
            case 'intermediaire':
                return 'Intermédiaire';
                break;
            default:
                return 'Avancé';
        }
    }
}
