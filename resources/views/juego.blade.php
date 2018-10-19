<!DOCTYPE html>
<html  lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>WareSearch</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="css/design.css">
        
    </head>
    <body class="" style="padding-top: 70px; padding-bottom: 120px;">
        <?php 
        
        $pregunta=array('¿Es un hombre?','¿Nació antes de 1500?','¿Tiene hijos?','¿Está vivo?', '¿Escribía poesía?', '¿Escribía novela?', '¿Escribía teatro?', '¿Es/Era cristiano?','¿Tiene/tenía hermanos?','¿Tiene tenía Esposo/esposa?','sd');

        
    
        if($respuestas!=''){

            for($i=0; $i<sizeof($respuestas); $i++){
             
                /*echo $respuestas[$i];*/

            }
            
        
           
            
        }
        
        else{
     
        }
        ?>

   

        <div class="w-100 h-100 d-flex justify-content-center align-items-center ">

        <form action="/juego" class="form" @php if($respuestas!='' && sizeof($respuestas)==11) { echo  "style=' display: none;'"; } else{  echo  "style='min-width: 400px'";}; @endphp method="POST" >
            @csrf

                  <h2 style="margin-bottom: 20px;" class="text-center">

                        @php
                            if($respuestas!=''){

                                echo  $pregunta[sizeof($respuestas)-1] ;
                    
                                $respuestas=implode(',', $respuestas);
                                
                            }

                            else{
                                echo  $pregunta[0];
                            }
                        @endphp

                    </h2>
                    <input type="text" name="almacenamiento" hidden value=<?php echo $respuestas  ?> >
                    <div class="inputGroup">
                        <input type="radio"  id="radio1" name="respuesta" value="1" checked>
                        <label for="radio1">Yes</label>
                    </div>
                    <div class="inputGroup">
                            <input type="radio" id="radio2"  name="respuesta" value="0" >
                    <label for="radio2">No</label>
                    </div>
                    <div class="d-flex w-100 justify-content-end" style="margin-top: 20px">
                        <input type="submit" class="btn btn-success w-25">
                    </div>
              </form>
            </div>
    </body>
</html>