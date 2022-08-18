<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    //

    public function store(User $user)
    {
        //se puede utilizar create pero cuando es una tabla pibote de mucho a muchos se recomienda attach (cuando se relacionan las mismas tablas 
        //en este caso usuario_id(quien recibe el seguir) follower_id que hacer referencia a usuario_id el cual esta enviando el seguir)

        $user->followers()->attach(auth()->user()->id);

        return back();
    }

    public function destroy(User $user)
    {
        $user->followers()->detach(auth()->user()->id);

        return back();
    }
}
