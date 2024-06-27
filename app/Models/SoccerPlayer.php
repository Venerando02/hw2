<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SoccerPlayer extends Model
{
    protected $table = 'giocatori_preferiti';
    public $timestamps = false;
    protected $primaryKey = 'giocatore';

    public function user()
    {
        return $this->belongsTo("App\Models\User", "utente");
    }
}
