<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public static function getCurrentReward($user_id)
    {
        return Reward::where('user_id', $user_id)->whereYear('created_at', date('Y'))->whereMonth('created_at', date('m'))->first();
    }
}
