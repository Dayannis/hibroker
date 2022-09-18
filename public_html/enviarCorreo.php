<?php
error_reporting(0);
require_once("sp.php"); 
$sp = new Sp();

$producto = $_GET["producto"];

    $result = $sp->traerAmbitoTerritorial($producto);
    if($row = $result->num_rows > 0)
        while($res = $result->fetch_row())
            $ambito= $res[0];
    
    $result = $sp->traerTrayectoria($producto);
    if($row = $result->num_rows > 0)
        while($res = $result->fetch_row())
            $trayectoria= $res[0];
            
     

    $sp->enviarCorreo($_GET["code"],$_GET["nombre"],$_GET["email"],$_GET["descripcion"],$_GET["categoria"],$_GET["asegurados"],$_GET["mensual"],$_GET["telefono"],$_GET["moneda"],$ambito,$trayectoria,$_GET["ruta"],$_GET["url"],$producto,$_GET["correo"], $_GET["anual"],$_GET["nombrepdf"]);



?>

<CENTER><button class="" onclick="window.history.back();">Volver al PDF</button></CENTER>