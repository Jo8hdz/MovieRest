<?php

//Convierte la contraseña en un hash
if (!function_exists('hashPassword')) {
    function hashPassword($plainPassword){ // convierte el texto plano del password en un hash
        return password_hash($plainPassword, PASSWORD_DEFAULT); //esta es una funcion de php para transformar un string a un hash
    }
}

// verifica el hash
if (!function_exists('verifyHashedPassword')) {
    function verifyHashedPassword($plainPassword, $hashPassword) {  // compara los password
        return password_verify($plainPassword, $hashPassword) ? TRUE : FALSE; //esta es una funcion de php para verificar passwords
    }
}

// Verifica si el usuario esta autenticado
if (!function_exists('isLoggedIn')) {
    function isLoggedIn(){ // verifica si el usuario esta en una sesion 
        $CI = & get_instance();
		$idUsuario= $CI->session->userdata('user_id');
		if (!isset($idUsuario)) {
			return false;
		}
		return true;
	}    
}

// Verifica si el usuario esta autenticado y redirecciona
if (!function_exists('verifyAuth')) {
    function verifyAuth() {
        if (!isLoggedIn()) {
            redirect("/login");
        }
    }
}