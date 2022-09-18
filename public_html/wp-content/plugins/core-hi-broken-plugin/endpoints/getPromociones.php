<?php

$promociones = $sp->buscarPromociones();
$result["content"] = array();
foreach ($promociones as $key => $promociones)
{
    $result["content"][] = array(
        "id" => $promo["id"], 
        "name" => ucwords($promo["nombre"],
        "tipoPromo" => ucwords($promo["idTipoPromocion"]),
        "valorAplicable" => $promo["valorAplicable"])
    );
}