<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DemandeConge extends Model
{
    protected $fillable = [
        'user_id', 
        'start_date', 
        'nombre_jrs',      // remplacer end_date
        'reason', 
        'status', 
        'type',
        'remplacement_id'  // nouvelle clé étrangère
    ];

    // Relation vers l'utilisateur demandeur
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    // Relation vers l'utilisateur remplaçant
    public function remplacement(): BelongsTo {
        return $this->belongsTo(User::class, 'remplacement_id');
    }
}
