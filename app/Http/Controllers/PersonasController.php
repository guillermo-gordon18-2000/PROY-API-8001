<?php
namespace App\Http\Controllers;

namespace app\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Presonas;
use Laravel\Lumen\Routing\Controller;

use Carbon\Carbon;
use PhpParser\Node\Stmt\Return_;

class PersonasController extends Controller{


  public function index(){
    $datosPersonas = Presonas::all();

     return response()->json($datosPersonas);
  }


  public function guardar(Request $request){

    $datosPersonas = new Presonas;

      if($request->hasFile('imagen')){

             $nombreArchivosOriginal= $request->file('imagen')->getClientOriginalName();

             $nuevoNombre=Carbon::now()->timestamp."_".$nombreArchivosOriginal;

             $carpetaDestino = './upload/';
             $request->file('imagen')->move($carpetaDestino , $nuevoNombre);
             $datosPersonas->titulo = $request->titulo;
             $datosPersonas->imagen = ltrim($carpetaDestino,'.').$nuevoNombre;


             $datosPersonas->save();
     }



       #return response()->json($request->input('titulo'));
    return response()->json($nuevoNombre);

  }

  public function ver($id){


      $datosPersonas = new Presonas;
       $datosEncontrados =$datosPersonas->find($id);
       return response()->json($datosEncontrados);




  }

    public function eliminar($id){

            $datosPersonas = Presonas::find($id);

                    if($datosPersonas){
                      $rutaArchivo = base_path('public').$datosPersonas->imagen;
                                          if(file_exists($rutaArchivo)){
                                                    unlink($rutaArchivo);
                                           }
                          $datosPersonas->delete();
                     }


                                  return response()->json("Registro Borrado");

               }


                  public function actualizar(Request $request,$id){
                      $datosPersonas = Presonas::find($id);

                           if($request->hasFile('imagen')){

                          if($datosPersonas){
                               $rutaArchivo=base_path('public').$datosPersonas->imagen;
                                 if (file_exists($rutaArchivo)) {
                                        unlink($rutaArchivo);

                                 }


                                    $datosPersonas->delete();


                          }

                                     $nombreArchivosOriginal= $request->file('imagen')->getClientOriginalName();
                                     $nuevoNombre=Carbon::now()->timestamp."_".$nombreArchivosOriginal;
                                     $carpetaDestino = './upload/';
                                     $request->file('imagen')->move($carpetaDestino , $nuevoNombre);
                                     $datosPersonas->titulo = $request->titulo;
                                     $datosPersonas->imagen = ltrim($carpetaDestino,'.').$nuevoNombre;
                                     $datosPersonas->save();
                           }



                         if ($request->input('titulo')) {
                             $datosPersonas->titulo=$request->input('titulo');
                         }


                           $datosPersonas->save();

                          return response()->json("Datos actualizado");

                 }

}
