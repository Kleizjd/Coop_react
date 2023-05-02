<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Crypt;


class loginController extends Controller
{
  public function login(Request $request){

    try{
      $usuario = Usuario::where('cedula', $request->cedula)->exists();  
      if($usuario == 1) {
        $usuario = Usuario::select('cedula', 'nombre', 'contrasena')->where('cedula', $request->cedula)->get();
        $cadenaDesencriptada = Crypt::decryptString($usuario[0]->contrasena);
        if ($cadenaDesencriptada == $request->contrasena) {
          session([
            'nombre' => $usuario[0]->nombre,
            'cedula' => $usuario[0]->cedula 
          ]);
        }else{
          //Contraseña no coincide
          $request->session()->forget(['nombre', 'cedula']);
          return 2;
        }
      }else{
        $request->session()->forget(['nombre', 'cedula']);
        //Usuario no existe
        return $usuario = 0; 
      }
    }catch(\Exception $exception){
      return $exception->getMessage();
      //dd($exception->getMessage());
      //dd(get_class($exception));
      //return "error";
    }
  }

  public function logout(Request $request) {
    
    $request->session()->forget(['nombre', 'cedula']);
    return redirect('/');
  }
}
