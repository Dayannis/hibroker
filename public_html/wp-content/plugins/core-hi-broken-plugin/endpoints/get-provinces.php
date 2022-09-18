<?php

$provinces = $sp->buscarProvincia();
$result["content"] = array();
foreach ($provinces as $key => $province)
{
    $result["content"][] = array(
        "id" => $province["idProvincia"], 
        "name" => ucwords($province["Nombre"])
    );
}