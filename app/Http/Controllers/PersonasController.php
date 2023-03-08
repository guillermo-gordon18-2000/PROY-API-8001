<?php
namespace App\Http\Controllers;

namespace app\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Presonas;
use Laravel\Lumen\Routing\Controller;

class PersonasController extends Controller{


  public function index(){
    $datosPersonas = Presonas::all();

     return response()->json($datosPersonas);
  }

   
  public function guardar(Request $request){
   
    $datosPersonas = new Presonas;
      $datosPersonas->titulo = $request->titulo;
       $datosPersonas->imagen = $request->imagen; 
                  

        $datosPersonas->save();
          
       #return response()->json($request->input('titulo'));
    return response()->json($request);

  }


}