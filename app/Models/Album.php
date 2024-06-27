<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $table = 'albums';
    protected $primaryKey = 'id';
    public $keyType = 'string';
    public $timestamps = false;

    public function likes()
    {
        return $this->hasMany("App\Models\Like", 'album');
    }
}
