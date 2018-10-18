<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JuegoController extends Controller
{
   public function preguntar(){





    return view('juego');

   }


   public function finalizarJuego(){

    
    return view('finJuego');

   }
}
