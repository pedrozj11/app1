<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JuegoController extends Controller
{
   public function preguntar(Request $request){
       

        $endpointUrl = 'https://query.wikidata.org/sparql';

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
          
          ";

          $endquery="}
          LIMIT 20";
        
        $respuestas= explode(",",$request->input('almacenamiento'));
        
        array_push($respuestas, $request->input('respuesta'));


        /* PRIMERAS 5 PREGUNTAS*/

       if(sizeof($respuestas)==6){

        for ($i=1; $i <= 5 ; $i++) { 

            echo $respuestas[$i] .  '<br>';

            if($i==1){
                /* TIENE QUE SER HOMBRE = SI */
                if($respuestas[1]==1){

                    $query.=" ?item wdt:P21 wd:Q6581097.";
                   
                }

                else{

                    $query.=" ?item wdt:P21 wd:Q6581072.";

                }
               
            
            }

            /* ¿Nació antes del 1500 o en el 1500? */

            if($i==2){

                if ($respuestas[2]==1){

                    $query.=" ?item wdt:P569 ?fechanacim.
                    FILTER((YEAR(?fechanacim)) <= 1500)";
                   
                }

                else{

                    $query.=" ?item wdt:P569 ?fechanacim.
                    FILTER((YEAR(?fechanacim)) > 1500)";

                }
               
            
            }

            /* TIENE HIJOS? */

            if($i==3){

                if ($respuestas[3]==1){

                    $query.="?item wdt:P40 ?hijos.";
                   
                }

                else{

                    $query.="FILTER(NOT EXISTS{?item wdt:P40 ?hijos})";

                }
               
            
            }
            
            /* ESTÁ VIVO? */

            if($i==4){

                if ($respuestas[4]==1){

                    $query.="FILTER(NOT EXISTS{?item wdt:P570 ?muerte})
                    FILTER(NOT EXISTS{?item wdt:P20 ?lmuerte})";
                }

                else{
                        /* NO SE SABE SI ESTÁ BIEN */
                    $query.=" ?item wdt:P20 ?lmuerte.";

                }
               
            
            }
            
           /* ESBRIBÍA POESÍA? */ 
            if($i==5){

                if ($respuestas[5]==1){

                    $query.="?item wdt:P106 wd:Q49757.";
                   
                }

                else{

                    $query.="FILTER(NOT EXISTS{?item wdt:P106 wd:Q49757})";

                }
               
            
            }
            
               
            
        }

        echo $query . $endquery;

        $resultado=file_get_contents( $endpointUrl . '?format=json&query=' . urlencode($query . $endquery)  );

        echo $resultado;
        /* HACER QUERY  SPARQL*/ 

        /*if(sizeof($resultado)<10){

            return view('finJuego', ['bool'=>'ganaste']);

        }
*/
       }

    /*SIGUIENTES 3 PREGUNTAS */


    if(sizeof($respuestas)==8){

        for ($i=5; $i < 7; $i++) {
            
            
            /* ESCRIBÍA NOVELA? */

            if($i==5){

                if ($respuestas[5]==1){

                    $query.="?item wdt:P106 wd:Q6625963.";
                
                }

                else{

                    $query.="FILTER(NOT EXISTS{?item wdt:P106 wd:Q6625963})";

                }
            
            
            }

            if($i==6){

                if ($respuestas[6]==1){

                    $query.=" ?item wdt:P106 wd:Q487596.";
                
                }

                else{

                    $query.="FILTER(NOT EXISTS{?item wdt:P106 wd:Q487596})";

                }
            
            
            }

            if($i==7){

                if ($respuestas[7]==1){

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
