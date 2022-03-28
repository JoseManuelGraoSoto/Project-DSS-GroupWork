<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
