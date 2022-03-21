<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function show($id) {
        $user = User::where('name', $id)-> first();
        return view('userProfile', ['user' => $user]);
    }
}
