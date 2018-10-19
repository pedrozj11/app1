<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>
    <body>
        <?php 
        
        $pregunta=array('¿Es un hombre?','¿Nació antes de 1500?','¿Tiene hijos?','¿Está vivo?', '¿Escribía poesía?', '¿Escribía novela?', '¿Escribía teatro?', '¿Murió de Cancer?');

        
    
        if($respuestas!=''){

            for($i=0; $i<sizeof($respuestas); $i++){
             
                /*echo $respuestas[$i];*/

            }
            
            echo '<p>' . $pregunta[sizeof($respuestas)-1] . '</p>';

            $respuestas=implode(',', $respuestas);
            
        }
        
        else{
            echo '<p>' . $pregunta[0] . '</p>';
        }
        ?>


        
        <form action="/juego" method="POST">
            @csrf
            
            <div class="form-group">

                <input type="text" name="almacenamiento" hidden value=<?php echo $respuestas  ?> >
                <input type="radio" name="respuesta" value="1" checked> Si <br>
                <input type="radio" name="respuesta" value="0" > No <br>
                <input type="submit">
            </div>
        </form>
        
    </body>
</html>