<?php

require_once("sp.php"); 
$sp = new Sp();

if(isset($_POST)){
	if(isset($_POST["usuario"]) && !empty($_POST["usuario"]) 
        && isset($_POST["clave"]) && !empty($_POST["clave"])){
			
			$usuario = $_POST["usuario"];
			$pass = $_POST["clave"];
			
			$user = $sp->buscarUser($usuario,$pass);
                      
            @session_start();
			$_SESSION['usuarios'] ="";
			$_SESSION['usuarios'] = $user;
			
			$productosResult ='';
          $productosResult .= '<br><br>';
          $productosResult .= '<div style="overflow-x:auto;">';

          $productosResult .= '<div class="table-responsive visible-lg align="center">';
          $productosResult .= '<table class="table hidden-md-down" width="100%">';
          $productosResult .= '<thead>';
          $productosResult .= '<tr class="table-result">';
          $productosResult .= '<th>ASEGURADORA</th>';
          $productosResult .= '<th>PRECIO MENSUAL (' .$currency .')</th>';
          $productosResult .= '<th>PRECIO ANUAL ('. $currency .')</th>';
          $productosResult .= '<th>COPAGO</th>';
          $productosResult .= '<th>PRODUCTO</th>';
          $productosResult .= '<th>DESCRIPCI&Oacute;N</th>';
          $productosResult .= '<th></th>';
          $productosResult .= '</tr>';
          $productosResult .= '</thead>';
          
                  
		if(@mysqli_num_rows($user)>0){
                   
                       foreach ($user as $key => $value) { 
                       $t= $value["id"]."-".$value["idUsuario"];
                       $nombreList[$t]= "";
                
                 }
				 
				 $p =0 ;
                       foreach ($user as $key => $value) { 
                            
                               
                                $nombreList[$t]= $value["idUsuario"];
                                
                            }
                            $p++;
                       }
		 
	}
}
		
		//$_SESSION['user'] = $userResult;
		@header("Location: http://hi-broker.com/resultLog/");


?>

