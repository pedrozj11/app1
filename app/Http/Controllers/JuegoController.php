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

                    $query.=" ?item wdt:P569 ?fechanacim. FILTER((YEAR(?fechanacim)) <= 1500)";
                   
                }

                else{

                    $query.=" ?item wdt:P569 ?fechanacim. FILTER((YEAR(?fechanacim)) > 1500)";

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

                    $query.="FILTER(NOT EXISTS{?item wdt:P570 ?muerte}) FILTER(NOT EXISTS{?item wdt:P20 ?lmuerte})";
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


        $resultado=file_get_contents( $endpointUrl . '?format=json&query=' . urlencode($query . $endquery)  );

       $resultadoF= json_decode($resultado);

        /* HACER QUERY  SPARQL*/ 
        if(sizeof($resultadoF->results->bindings)>5 && sizeof($resultadoF->results->bindings)!=0){ 

            echo '<div class="w-100 d-flex justify-content-center   "><div class=" w-25 d-flex flex-column justify-content-center aling-items-center"> <p class="text-center">' . "¿Tu autor se llama " . $resultadoF->results->bindings[0]->itemLabel->value . "?".'</p>' . '<a href="/fin-juego" class="btn btn-success">' . "Correcto " .'</a> </div></div>';
            
        };


       }

    /*SIGUIENTES 3 PREGUNTAS */


    if(sizeof($respuestas)==11){

        for ($i=1; $i <= 10; $i++) {
        

            
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

                    $query.=" ?item wdt:P569 ?fechanacim. FILTER((YEAR(?fechanacim)) <= 1500)";
                   
                }

                else{

                    $query.=" ?item wdt:P569 ?fechanacim. FILTER((YEAR(?fechanacim)) > 1500)";

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

                    $query.="FILTER(NOT EXISTS{?item wdt:P570 ?muerte}) FILTER(NOT EXISTS{?item wdt:P20 ?lmuerte})";
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
            
            
            /* ESCRIBÍA NOVELA? */

            if($i==6){

                if ($respuestas[6]==1){

                    $query.="?item wdt:P106 wd:Q6625963. ";
                
                }

                else{

                    $query.=" FILTER(NOT EXISTS{?item wdt:P106 wd:Q6625963})";

                }
            
            
            }

            /* ESCRIBIA TEATRO */
            if($i==7){

                if ($respuestas[7]==1){

                    $query.=" ?item wdt:P106 wd:Q214917. ";
                
                }

                else{

                    $query.=" FILTER(NOT EXISTS{?item wdt:P106 wd:Q214917})";

                }
            
            
            }

            /** ERA CRISTIANO */
            if($i==8){

                if ($respuestas[8]==1){

                    $query.="?item wdt:P140 wd:Q5043. ";
                
                }

                else{

                    $query.=" FILTER(NOT EXISTS{?item wdt:P140 wd:Q5043}) ";

                }
            
            
            }

            /** TENIA HERMANOS */

            if($i==9){

                if ($respuestas[9]==1){

                    $query.=" ?item wdt:P3373 ?hermanos. ";
                
                }

                else{

                    $query.=" FILTER(NOT EXISTS{?item wdt:P3373 ?hermanos})";

                }
            
            
            }

            if($i==10){

                if ($respuestas[10]==1){

                    $query.="?item wdt:P26 ?esposa. ";
                
                }

                else{

                    $query.=" SFILTER(NOT EXISTS{?item wdt:P26 ?esposa}) ";

                }
            
            
            }

        }


        $resultado=file_get_contents( $endpointUrl . '?format=json&query=' . urlencode($query . $endquery)  );
        $resultadoF2= json_decode($resultado);
        /* HACER QUERY  SPARQL*/ 
        
        if($resultadoF2!=NULL && $resultadoF2->results!=NULL && sizeof($resultadoF2->results->bindings)<5 && sizeof($resultadoF2->results->bindings)!=0 ){ 

            echo '<div class="w-100 d-flex justify-content-center   "><div class=" w-25 d-flex flex-column justify-content-center aling-items-center"> <p class="text-center">' . "¿Tu autor se llama " . $resultadoF2->results->bindings[0]->itemLabel->value . "?".'</p>' . '<a href="/fin-juego" class="btn btn-success">' . "Correcto " .'</a> </div></div>';
            echo '<div class="w-100 d-flex justify-content-center   "><div class=" w-25 d-flex flex-column justify-content-center aling-items-center"> <a href="/fin-juego-malo" class="btn btn-success" style="margin-top: 20px;"> No es ese  </a> </div></div>';
            
        }

        else{

            return view ('finJuegoMalo');
        }


        

    }
           
        
       return view('juego', ['respuestas' => $respuestas]);

   }


   public function finalizarJuego(){

    
    return view('finJuego');

   }
}
