<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Indice_Principal;
use App\Models\Indice_Secundario;
use App\Models\Indice_Tercero;
use App\Models\Indice_Cuarto;
use App\Models\Indice_Quinto;
use DateTime;
use Response;

class adminController extends Controller
{

  function index(){

    $indice_principales = Indice_Principal::select('id', 'consecutivo', 'titulo')
      ->orderBy('consecutivo', 'ASC')
      ->where('estado', 1)
      ->get();

    return view('welcome', compact('indice_principales'));
  }

  function indice_principal($id){
    $indice_principales = Indice_Principal::select('id', 'consecutivo', 'titulo')
      ->orderBy('consecutivo', 'ASC')
      ->where('estado', 1)
      ->where('año', $id)
      ->get();

    return Response::json($indice_principales);
  }
  
  function form_uno(Request $request){
    
    $indice_principal = new Indice_Principal;
    
    $fecha_actual = new DateTime();

    $indice_principal->año         = $request->año;
    $indice_principal->consecutivo = $request->consecutivo;
    $indice_principal->titulo      = $request->titulo;
    $indice_principal->usuario     = $request->usuario;
    $indice_principal->estado      = 1;
    $indice_principal->created_at  = $fecha_actual->format('Y-m-d H:i:s');
    
    if($indice_principal->save()){
      return Response::json($indice_principal);
    }
  }

  function form_uno_update(Request $request, $id){

    $indice_principal = Indice_Principal::where('id', $id)
      ->update([
        'consecutivo' => $request->consecutivo, 
        'titulo' => $request->titulo, 
        'usuario' => $request->usuario
      ]);

    if ($indice_principal == true) {
      return Response::json($request);
    }
  }

  function form_uno_eliminar(Request $request, $id){
    
    $indice_principal = Indice_Principal::where('id', $id)
    ->update([
      'estado' => 0
    ]);

    if ($indice_principal == true) {
      return Response::json($request);
    }
  }

  ////Sub Indice
  function registro_subindice(Request $request, $id){
    $arreglo = explode(",", $id);
    
    $tipo        = $arreglo[0];
    $id_indice   = $arreglo[1];
    $consecutivo = $arreglo[2];
    $titulo_cons = $arreglo[3];
    return view('registro_subindice', compact('tipo', 'id_indice', 'consecutivo', 'titulo_cons'));
  }

  function editar_subindice($id){
  
    $arreglo = explode(",", $id);

    if ($arreglo[0] == 2) {
      $indice = Indice_Secundario::select('id', 'id_ind_prim', 'consecutivo', 'tipo', 'titulo', 'contenido', 'usuario', 'estado')
        ->where('estado', 1)
        ->where('id', $arreglo[1])
        ->get();
    }

    if ($arreglo[0] == 3) {
      $indice = Indice_Tercero::select('id', 'id_ind_sec', 'consecutivo', 'titulo', 'contenido', 'usuario', 'estado')
        ->where('estado', 1)
        ->where('id', $arreglo[1])
        ->get();
    }

    if ($arreglo[0] == 4) {
      $indice = Indice_Cuarto::select('id', 'id_ind_ter', 'consecutivo', 'titulo', 'contenido', 'usuario', 'estado')
        ->where('estado', 1)
        ->where('id', $arreglo[1])
        ->get();
    }

    if ($arreglo[0] == 5) {
      $indice = Indice_Quinto::select('id', 'id_ind_cua', 'consecutivo', 'titulo', 'contenido', 'usuario', 'estado')
        ->where('estado', 1)
        ->where('id', $arreglo[1])
        ->get();
    }

    $tipo = $arreglo[0];

    return view('editar_subindice', compact('indice', 'tipo'));
  }

  function update_subindice(Request $request, $id){

    $arreglo = explode(",", $id); 

    if($arreglo[0] == 2){
      $indice = Indice_Secundario::where('id', $arreglo[1])
        ->update([
          'tipo'      => $request->tipo,
          'titulo'    => $request->titulo, 
          'contenido' => $request->contenido, 
          'usuario'   => $request->usuario,
        ]);
    }

    if($arreglo[0] == 3){
      $indice = Indice_Tercero::where('id', $arreglo[1])
        ->update([
          'titulo'    => $request->titulo, 
          'contenido' => $request->contenido, 
          'usuario'   => $request->usuario,
        ]);
    }

    if($arreglo[0] == 4){
      $indice = Indice_Cuarto::where('id', $arreglo[1])
        ->update([
          'titulo'    => $request->titulo, 
          'contenido' => $request->contenido, 
          'usuario'   => $request->usuario,
        ]);
    }

    if($arreglo[0] == 5){
      $indice = Indice_Quinto::where('id', $arreglo[1])
        ->update([
          'titulo'    => $request->titulo, 
          'contenido' => $request->contenido, 
          'usuario'   => $request->usuario,
        ]);
    }

    if ($indice == true) {
      return Response::json($request);
    }
  }

  function eliminar_subindice(Request $request, $id){

    $arreglo = explode(",", $id); 

    if ($arreglo[0] == 2) {
      $indice = Indice_Secundario::where('id', $arreglo[1])
        ->update([
          'usuario' => Session()->get('cedula'),
          'estado'  => 0
        ]);
    }

    if ($arreglo[0] == 3) {
      $indice = Indice_Tercero::where('id', $arreglo[1])
        ->update([
          'usuario' => Session()->get('cedula'),
          'estado'  => 0
        ]);
    }

    if ($arreglo[0] == 4) {
      $indice = Indice_Cuarto::where('id', $arreglo[1])
        ->update([
          'usuario' => Session()->get('cedula'),
          'estado'  => 0
        ]);
    }

    if ($arreglo[0] == 5) {
      $indice = Indice_Quinto::where('id', $arreglo[1])
        ->update([
          'usuario' => Session()->get('cedula'),
          'estado'  => 0
        ]);
    }

    if ($indice == true) {
      return Response::json($request);
    }
  }

  ///////
  function form_dos(Request $request, $id){
    $fecha_actual = new DateTime();

    if($id == 1){
      $indice_secundario = new Indice_Secundario;
      
      $indice_secundario->id_ind_prim = $request->id_ind;
      $indice_secundario->consecutivo = $request->cons_ind.$request->consecutivo;
      $indice_secundario->tipo        = $request->tipo;
      $indice_secundario->titulo      = $request->titulo;
      $indice_secundario->contenido   = $request->contenido;
      $indice_secundario->usuario     = $request->usuario;
      $indice_secundario->estado      = 1;
      $indice_secundario->created_at  = $fecha_actual->format('Y-m-d H:i:s');
      if($indice_secundario->save()){
        return Response::json($indice_secundario);
      }
    }

    if($id == 2){
      $indice_tercero = new Indice_Tercero;

      $indice_tercero->id_ind_sec  = $request->id_ind;
      $indice_tercero->consecutivo = $request->cons_ind.$request->consecutivo;
      $indice_tercero->titulo      = $request->titulo;
      $indice_tercero->contenido   = $request->contenido;
      $indice_tercero->usuario     = $request->usuario;
      $indice_tercero->estado      = 1;
      $indice_tercero->created_at  = $fecha_actual->format('Y-m-d H:i:s');
      if($indice_tercero->save()){
        return Response::json($indice_tercero);
      }
    }

    if($id == 3){
      $indice_cuarto = new Indice_Cuarto;

      $indice_cuarto->id_ind_ter  = $request->id_ind;
      $indice_cuarto->consecutivo = $request->cons_ind.$request->consecutivo;
      $indice_cuarto->titulo      = $request->titulo;
      $indice_cuarto->contenido   = $request->contenido;
      $indice_cuarto->usuario     = $request->usuario;
      $indice_cuarto->estado      = 1;
      $indice_cuarto->created_at  = $fecha_actual->format('Y-m-d H:i:s');
      if($indice_cuarto->save()){
        return Response::json($indice_cuarto);
      }
    }

    if($id == 4){
      $indice_quinto = new Indice_Quinto;

      $indice_quinto->id_ind_cua  = $request->id_ind;
      $indice_quinto->consecutivo = $request->cons_ind.$request->consecutivo;
      $indice_quinto->titulo      = $request->titulo;
      $indice_quinto->contenido   = $request->contenido;
      $indice_quinto->usuario     = $request->usuario;
      $indice_quinto->estado      = 1;
      $indice_quinto->created_at  = $fecha_actual->format('Y-m-d H:i:s');
      if($indice_quinto->save()){
        return Response::json($indice_quinto);
      }
    }
  }

  //modificado
  function index_subindice($id){

    $arreglo = explode(",", $id);

    $indice_secundario = Indice_Secundario::select('id', 'id_ind_prim', 'consecutivo', 'titulo', 'usuario')
      ->where('estado', 1)
      ->where('id_ind_prim', $arreglo[0])
      ->where('tipo', $arreglo[1])
      ->orderByRaw('LENGTH(consecutivo) asc')->orderBy('consecutivo', 'asc')
      ->get();

    return Response::json($indice_secundario);
  }

  function index_subindice_tres($id){
    $indice_tercero = Indice_Tercero::select('id', 'id_ind_sec', 'consecutivo', 'titulo', 'usuario')
      ->where('estado', 1)
      ->where('id_ind_sec', $id)
      ->orderByRaw('LENGTH(consecutivo) ASC')
      ->orderBy('consecutivo', 'ASC')
      ->get();

    return Response::json($indice_tercero);
  }

  function index_subindice_cuatro($id){
    $indice_tercero = Indice_Cuarto::select('id', 'id_ind_ter', 'consecutivo', 'titulo', 'usuario')
      ->where('estado', 1)
      ->where('id_ind_ter', $id)
      ->orderByRaw('LENGTH(consecutivo) ASC')
      ->get();

    return Response::json($indice_tercero);
  }

  function index_subindice_cinco($id){
    $indice_quinto = Indice_Quinto::select('id', 'id_ind_cua', 'consecutivo', 'titulo', 'usuario')
      ->where('estado', 1)
      ->where('id_ind_cua', $id)
      ->orderByRaw('LENGTH(consecutivo) ASC')
      ->get();

    return Response::json($indice_quinto);
  }

  function doc_subind_dos($id){

    $arreglo = explode(",", $id);
    if($arreglo[0] == 2){
      $documento = Indice_Secundario::select('id', 'id_ind_prim', 'consecutivo', 'titulo', 'contenido', 'usuario')
      ->where('estado', 1)
      ->where('id', $arreglo[1])
      ->get();
    }

    if($arreglo[0] == 3){
      $documento = Indice_Tercero::select('id', 'id_ind_sec', 'consecutivo', 'titulo', 'contenido', 'usuario')
      ->where('estado', 1)
      ->where('id', $arreglo[1])
      ->get();
    }

    if($arreglo[0] == 4){
      $documento = Indice_Cuarto::select('id', 'id_ind_ter', 'consecutivo', 'titulo', 'contenido', 'usuario')
      ->where('estado', 1)
      ->where('id', $arreglo[1])
      ->get();
    }

    if($arreglo[0] == 5){
      $documento = Indice_Quinto::select('id', 'id_ind_cua', 'consecutivo', 'titulo', 'contenido', 'usuario')
      ->where('estado', 1)
      ->where('id', $arreglo[1])
      ->get();
    }

    return Response::json($documento);
  }
}
