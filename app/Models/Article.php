<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'lettura';
    protected $primaryKey = 'id_articolo';
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo("App\Models\User","utente");
    }
}
