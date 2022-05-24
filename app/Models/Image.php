<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model {
    use HasFactory;

    protected $fillable = ['nombre', 'extension', 'tamaño'];

    public function article()
    {
        return $this->belongsTo('App\Models\Article');
    }
}