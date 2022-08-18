<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {
        //Modificar el request (slug sirve para cambiar los espacios por guiones)
        $request->request->add(['username'=> Str::slug($request->username)]);
        
        //not_in: obliga a que el usuario no pueda utilizar tal nombre que se le pase
        //in: obliga a que el usuario al momento de rellenar el campo deba tener el dato que se esta obligando a colocar 
        $this->validate($request,[
            'username'=> ['required','unique:users,username,'.auth()->user()->id,'min:3','max:20','not_in:editar-perfil'],
        ]);

        if ($request->imagen) {
            $imagen = $request->file('imagen');

            $nombreImagen = Str::uuid().'.'.$imagen->extension();

            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000,1000);
            
            $imagenPath = public_path('perfiles'). '/'. $nombreImagen;
            $imagenServidor->save($imagenPath);
        }

        //Guardar Cambios
        $usuario = User::find(auth()->user()->id);

        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;

        $usuario->save();

        //redireccionar
        
        return redirect()->route('post.index',$usuario->username);
    }
}
