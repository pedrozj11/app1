<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JuegoController extends Controller
{
   public function preguntar(Request $request){
       
        $query="SELECT DISTINCT ?item ?itemLabel ?fechanacim ?genero ?muerte ?lmuerteLabel WHERE {
            SERVICE wikibase:label { bd:serviceParam wikibase:language \"[AUTO_LANGUAGE],en\". }
            ?item wdt:P106 ?ocupacion.
            ?ocupacion wdt:P279 ?ocupaciones.
            VALUES (?ocupaciones) {
              (wd:Q36180)
              (wd:Q49757)
              (wd:Q6625963)
              (wd:Q214917)
            }
          }
          ";
        $respuestas= explode(",",$request->input('almacenamiento'));
        
        array_push($respuestas, $request->input('respuesta'));


        /* PRIMERAS 5 PREGUNTAS*/

       if(sizeof($respuestas)==5){


            if($i==0){
                /* TIENE QUE SER HOMBRE = SI */
                if(respuestas[0]==1){

                    $query.=" ?item wdt:P21 wd:Q6581097.";
                   
                }

                else{

                    $query.=" ?item wdt:P21 wd:Q6581072.";

                }
               
            
            }

            /* ¿Nació antes del 1500 o en el 1500? */

            if($i==1){

                if(respuestas[1]==1){

                    $query.=" ?item wdt:P569 ?fechanacim.
                    FILTER((YEAR(?fechanacim)) <= 1500)";
                   
                }

                else{

                    $query.=" ?item wdt:P569 ?fechanacim.
                    FILTER((YEAR(?fechanacim)) > 1500)";

                }
               
            
            }

            /* EN QUE PAÍS NACIÓ? */

            if($i==2){

                if(respuestas[2]==1){

                    $query.="";
                   
                }

                else{

                    $query.="";

                }
               
            
            }
            
            /* ESTÁ VIVO? */

            if($i==3){

                if(respuestas[3]==1){

                    $query.="FILTER(NOT EXISTS{?item wdt:P570 ?muerte})
                    FILTER(NOT EXISTS{?item wdt:P20 ?lmuerte})";
                }

                else{
                        /* NO SE SABE SI ESTÁ BIEN */
                    $query.=" ?item wdt:P20 ?lmuerte.";

                }
               
            
            }
            
           /* ESBRIBÍA POESÍA? */ 
            if($i==4){

                if(respuestas[4]==1){

                    $query.="?item wdt:P106 wd:Q49757.";
                   
                }

                else{

                    $query.="FILTER(NOT EXISTS{?item wdt:P106 wd:Q49757})";

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
            
            
            /* ESCRIBÍA NOVELA? */

            if($i==5){

                if(respuestas[5]==1){

                    $query.="?item wdt:P106 wd:Q6625963.";
                
                }

                else{

                    $query.="FILTER(NOT EXISTS{?item wdt:P106 wd:Q6625963})";

                }
            
            
            }

            if($i==6){

                if(respuestas[6]==1){

                    $query.=" ?item wdt:P106 wd:Q487596.";
                
                }

                else{

                    $query.="FILTER(NOT EXISTS{?item wdt:P106 wd:Q487596})";

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
