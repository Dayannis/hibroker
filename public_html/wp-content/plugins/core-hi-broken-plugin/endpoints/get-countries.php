<?php

$countries = $sp->buscarPais();

$result["content"] = array();
foreach ($countries as $key => $country)
{
    $result["content"][] = array(
        "id" => $country["idPais"], 
        "name" => ucwords($country["Nombre"])
    );
}