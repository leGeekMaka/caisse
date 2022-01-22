<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function authentication(Request $request){

        $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);
        $user = User::where('name',$request->name)->first();

        if (is_null($user))
            return redirect()->route('login')->with('message','pas d\'utilisateur trouvé');


        if ($request->name != $user->name || Hash::check($request->password, $user->password))
            return redirect()->route('login','error','mot de passe ou nom incorrect');

        if ($request->name === $user->name && Hash::check($request->password, $user->password))
            return redirect('home');

    }
}
