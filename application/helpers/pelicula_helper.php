<?php


//Convierte un texto plano a hash
if (!function_exists('type_movies_to_form')) {

    function type_movies_to_form($genero) {
        $aGenero = array();
        foreach ($genero as $key => $g) {
            $aGenero[$g->idGenero] = $g->nombre;
        }
        return $aGenero;
    }

}
