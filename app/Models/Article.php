<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function access()
    {
        return $this->belongsToMany('App\Models\User')->withTimestamps()->using('App\Models\Article_user');
    }

    public function valoration()
    {
        return $this->belongsToMany('App\Models\Valoration');
    }
        public function image()
    {
        return $this->belongsTo('App\Models\Image');
    }

}