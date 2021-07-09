<?php

if (!function_exists('hashPassword')) {

    function hashPassword($plainPassword){ // convierte el texto plano del password en un hash
        return password_hash($plainPassword, PASSWORD_DEFAULT); //esta es una funcion de php para transformar un string a un hash
    }

    function verificarHashedPassword($plainPassword, $hashPassword){ // compara los password
        return password_verify($plainPassword, $hashPassword)? true : false; //esta es una funcion de php para verificar passwords
    }
}