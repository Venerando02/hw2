<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'utenti';
    public $timestamps = false;
    protected $primaryKey = 'id';

    public function articles()
    {
        return $this->hasMany("App\Models\Article", "utente");
    }

    public function players()
    {
        return $this->hasMany("App\Models\SoccerPlayer", "utente");
    }

    public function likes()
    {
        return $this->hasMany("App\Models\Like", 'utente');
    }
}

