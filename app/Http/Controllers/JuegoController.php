<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JuegoController extends Controller
{
   public function preguntar(Request $request){
       
        $query="PARTE COMUN";
        $respuestas= explode(",",$request->input('almacenamiento'));
        
        array_push($respuestas, $request->input('respuesta'));


        /* PRIMERAS 5 PREGUNTAS*/

       if(sizeof($respuestas)==5){


            if($i==0){

                if(respuestas[0]==1){

                    $query.="";
                   
                }

                else{

                    $query.="";

                }
               
            
            }

            if($i==1){

                if(respuestas[1]==1){

                    $query.="";
                   
                }

                else{

                    $query.="";

                }
               
            
            }

            if($i==2){

                if(respuestas[2]==1){

                    $query.="";
                   
                }

                else{

                    $query.="";

                }
               
            
            }
            

            if($i==3){

                if(respuestas[3]==1){

                    $query.="";
                }

                else{

                    $query.="";

                }
               
            
            }
            

            if($i==4){

                if(respuestas[4]==1){

                    $query.="";
                   
                }

                else{

                    $query.="";

                }
               
            
            }
            
                    
        /* HACER QUERY  SPARQL*/ 

        if(COUNT($respuesta)==1){

            return view('finJuego', ['bool'=>'ganaste']);

        }

       }

    /*SIGUIENTES 3 PREGUNTAS */


    if(sizeof($respuestas)==8){

        for ($i=5; $i < 7; $i++) {
            
            if($i==5){

                if(respuestas[5]==1){

                    $query.="";
                
                }

                else{

                    $query.="";

                }
            
            
            }

            if($i==6){

                if(respuestas[6]==1){

                    $query.="";
                
                }

                else{

                    $query.="";

                }
            
            
            }

            if($i==7){

                if(respuestas[7]==1){

                    $query.="";
                
                }

                else{

                    $query.="";

                }
            
            
            }
        }
        if(COUNT($respuesta)==1){

            return view('finJuego', ['bool'=>'ganaste']);

        }
        
       
    }
           
        
       return view('juego', ['respuestas' => $respuestas]);

   }


   public function finalizarJuego(){

    
    return view('finJuego');

   }
}
