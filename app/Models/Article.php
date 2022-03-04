<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    public function user() {
        // Product tiene la clave ajena 'category_id'
        return $this->belongsTo('App\Models\User');
    }
}
