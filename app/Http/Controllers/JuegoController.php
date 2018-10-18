<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JuegoController extends Controller
{
   public function preguntar(Request $request){
       
        $query="PARTE COMUN";

       $respuestas= explode(",",$request->input('almacenamiento'));
       


       array_push($respuestas, $request->input('respuesta'));


       if(sizeof($respuestas)==5){


            if(respuestas[0]==1){

                $query.="";
            
            }
            
            if(respuestas[1]==1){

                $query.="";
            
            }

            
            if(respuestas[2]==1){

                $query.="";
            
            }

            
            if(respuestas[3]==1){

                $query.="";
            
            }

            
            if(respuestas[4]==1){

                $query.="";
            
            }

        /* HACER QUERY  SPARQL*/ 

        if(COUNT($respuesta)==1)

       }

       
       
        
       return view('juego', ['respuestas' => $respuestas]);

   }


   public function finalizarJuego(){

    
    return view('finJuego');

   }
}
