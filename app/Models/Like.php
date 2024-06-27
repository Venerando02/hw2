<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';
    protected $primaryKey = 'id_like';
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo("App\Models\User", "utente");
    }

    public function album()
    {
        return $this->belongsTo("App\Models\Album", "album");
    }
}
