<?php

global $wpdb;    
$result_query = $wpdb->get_results( "select now() as fecha");
$result["status"]["message"] = "Servicio de prueba, fecha actual: " . $result_query[0]->fecha . ".";
$result["content"] = "OK";