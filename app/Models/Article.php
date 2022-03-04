<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    public function users() {
        return $this->belongsTo('App\Models\User');
    }

    public function access() {
        return $this->belongsToMany('App\Models\User');
    }
}
