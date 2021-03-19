<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    protected $fillable = [
        'description', 'etats', 'date_debut_traitement','date_fin_traitement',
        'delete','user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
