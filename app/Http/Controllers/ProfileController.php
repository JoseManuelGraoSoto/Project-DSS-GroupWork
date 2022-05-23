<?php

namespace App\Http\Controllers;

use App\Models\Article;
use DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Valoration;
use App\Models\Article_user;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{

    public function updateProfileFormulary(Request $request)
    {
        $user = Auth::user();

        $valorations = Valoration::where('user_id', $user->id)->get();
        $numValorations = $valorations->count();
        $articleAccess = Article_user::where('user_id', $user->id)->get();
        $numArticleAccess = $articleAccess->count();
        return view('common.profile', ['user' => $user, 'numValorations' => $numValorations, 'numArticleAccess' => $numArticleAccess]);
    }

    public function updateProfile(Request $request)
    {

        $validator = null;
        if (empty($request->input('email')) && empty($request->input('telephone')) && empty($request->input('password'))) {
            if (empty($request->input('name'))) {
                $user = User::find($request->input('user_id'));
                return redirect()->route('profile', ['user' => $user]);
            } else {
                $user = User::find($request->input('user_id'));
                $user->name = $request->input('name');
                $user->save();
                return redirect()->route('profile', ['user' => $user]);
            }
        } else if (empty($request->input('email')) && empty($request->input('telephone'))) {
            $validator = Validator::make($request->all(), [
                'password' => [Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()],
            ]);
        } else if (empty($request->input('email')) && empty($request->input('password'))) {
            $validator = Validator::make($request->all(), [
                'telephone' => 'regex:/([0-9]){3,3}([ ]){1,1}([0-9]){3,3}([ ]){1,1}([0-9]){3,3}/'
            ]);
        } else if (empty($request->input('telephone')) && empty($request->input('password'))) {
            $validator = Validator::make($request->all(), [
                'email' => 'email',
            ]);
        } else if (empty($request->input('email'))) {
            $validator = Validator::make($request->all(), [
                'password' => [Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()],
                'telephone' => 'regex:/([0-9]){3,3}([ ]){1,1}([0-9]){3,3}([ ]){1,1}([0-9]){3,3}/'
            ]);
        } else if (empty($request->input('password'))) {
            $validator = Validator::make($request->all(), [
                'email' => 'email',
                'telephone' => 'regex:/([0-9]){3,3}([ ]){1,1}([0-9]){3,3}([ ]){1,1}([0-9]){3,3}/'
            ]);
        } else if (empty($request->input('telephone'))) {
            $validator = Validator::make($request->all(), [
                'email' => 'email',
                'password' => [Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()],
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'email' => 'email',
                'password' => [Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()],
                'telephone' => 'regex:/([0-9]){3,3}([ ]){1,1}([0-9]){3,3}([ ]){1,1}([0-9]){3,3}/'
            ]);
        }

        if ($validator->fails()) {
            return redirect(route('profile'))
                ->withErrors($validator)
                ->withInput();
        }

        $inputs = $validator->validated();
        $new_user = User::find($request->input('user_id'));
        if (!empty($request->input('name'))) {
            $new_user->name = $request->input('name');
        }
        if (!empty($request->input('email'))) {
            $new_user->email = $inputs['email'];
        }
        if (!empty($request->input('password'))) {
            $new_user->password = Hash::make($inputs['password']);
        }
        if (!empty($request->input('telephone'))) {
            $new_user->telephone = $inputs['telephone'];
        }
        $new_user->save();
        $user = User::find($request->input('user_id'));
        return redirect()->route('profile', ['user' => $user]);
    }
}
