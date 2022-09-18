<?php
    if(isset($_COOKIE['nombre'])){
        unset($_COOKIE['nombre']);
        unset($_COOKIE['idMediador']);
    }
    setcookie( 'nombre', null, 0);
    setcookie( 'idMediador', null, 0);  
    Redirect('http://www.hi-broker.com/login/', false);

    function Redirect($url, $permanent = false)
    {
        header('Location: ' . $url, true, $permanent ? 301 : 302);
        exit();
    }