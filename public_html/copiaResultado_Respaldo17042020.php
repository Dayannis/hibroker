<?php

require_once("sp.php"); 
$sp = new Sp();
$datos_correctos=0;
$MAX_EDAD=75;
$MIN_EDAD=18;
$edades = "";
$mayor = 0;
$menor = 0;
$check = true;
$prueba = 0;
$edadPersonaMayor = "";


//ENVIE POR LO MENOS UN DATO
if(isset($_POST)){
  $valido=0;
  $mensaje_error="";
  //VALIDAR LA EXISTENCIA DE TODOS LOS DATOS 
  if(isset($_POST["pais"]) && !empty($_POST["pais"]) 
  && isset($_POST["nombres"]) && !empty($_POST["nombres"])
  && isset($_POST["apellidos"]) && !empty($_POST["apellidos"])
  && isset($_POST["fecha_nac"]) && !empty($_POST["fecha_nac"])
  && isset($_POST["movil"]) && !empty($_POST["movil"])
  && isset($_POST["email"]) && !empty($_POST["email"])
  && isset($_POST["cant_familiares"])
  && isset($_POST["categoria"]) && !empty($_POST["categoria"])){

    if(count($_POST["cant_familiares"])>0){

      for($i=0; $i<=6; $i++){
        

        if(isset($_POST["fechanac"][$i]) && !empty($_POST["fechanac"][$i])){
        
	          $edadPersonaMayor = $sp->CalculaEdad($sp->limpiarFechaNac($_POST["fechanac"][$i]));
	          //echo "edadPersonaMayor ".$edadPersonaMayor ."<br>";
	          if($edadPersonaMayor >= $MAX_EDAD){
	          //echo "mayor ".$mayor ."<br>";
	            $mayor = 1;
	            $edades .= $edadPersonaMayor  . " ,";
	          }   
          
          $fecha_nac_bene[$i]= $sp->limpiarFechaNac($_POST["fechanac"][$i]);

          //echo "aquii".$_POST["fechanac"][$i]." ".$fecha_nac_bene[$i]."<br>";

          $valido++;
        }else{
          $fecha_nac_bene[$i]= '';
          
        }
      }


      if($_POST["cant_familiares"] == $valido){ 
        $datos_correctos=1;
      }else{
        $datos_correctos=0;
        $mensaje_error="Ha ocurrido un error en la recolecci&oacute;n de datos de los beneficiarios";
      }
    }

  }else{
    $datos_correctos=0;
    $mensaje_error="Ha ocurrido un error en la recepci&oacute;n de los datos, valide nuevamente que todos los datos esten correctos";
    header("location:javascript://history.go(-1)");
  }
}else{
  $datos_correctos=0;
  $mensaje_error="Ha ocurrido un error en la recepci&oacute;n de los datos, debe completar todos los campos requeridos";
}

if($datos_correctos==1){
  /********************************LIMPIAR DATOS DE ENTRADA************************************/
  $pais = $sp->limpiarId($_POST["pais"]);

  if(isset($_POST["provincia"]) && !empty($_POST["provincia"])){
    $provincia = $sp->limpiarId($_POST["provincia"]);
    
  }else{
    $provincia = '';
  }
  $nombres = $sp->limpiarNombre($_POST["nombres"]);
  $apellidos = $sp->limpiarNombre($_POST["apellidos"]);
  $fecha_nac = $sp->limpiarFechaNac($_POST["fecha_nac"]);
  $movil = $_POST["movil"];
  $pais = $_POST["pais"];
  $currency ="€";
  if($pais==2){ $currency ="$";}

  $categoria = $_POST["categoria"];
  $email = $sp->limpiarCorreo($_POST["email"]);
  $cant_familiares = $sp->limpiarNumero($_POST["cant_familiares"]);
  
  
  $tomador = 0;
  if(isset($_POST["tomador"]) && !empty($_POST["tomador"])){
    
    $fecha_tomador = $fecha_nac;
    $tomador = 1;
    $edadTmp = $sp->CalculaEdad($sp->limpiarFechaNac($fecha_tomador));
    $prueba = $edadTmp;
   
    if($edadTmp >= $MAX_EDAD){    
      $mayor = 1;
      $edades .= $edadTmp  . " ,";      
    }
    else if($edadTmp >= $MIN_EDAD)
             $check = false;          
    else if($edadTmp < $MIN_EDAD && $check===true)
            $menor = 1;    

  }else{
    $fecha_tomador = $fecha_nac;
    $edadTmp2 = $sp->CalculaEdad($sp->limpiarFechaNac($fecha_tomador ));
    
    if($edadTmp2 < $MIN_EDAD)
      $menor = 1;
    $fecha_tomador ='';
    $tomador='';
  }
  
  //Insert de consulta realizada
 
  $sp->addConsulta($pais, $provincia, $_POST["nombres"], $_POST["apellidos"], $fecha_tomador, $movil, $email, $cant_familiares, $tomador);

  /*****************************INVOCAR EL SP DE PRODUCTOS************************************/
  $productos =  $sp->buscarProductosNew($categoria,$pais,$provincia,$fecha_tomador,$fecha_nac_bene[0],$fecha_nac_bene[1],$fecha_nac_bene[2],$fecha_nac_bene[3],$fecha_nac_bene[4],$fecha_nac_bene[5]);

  @session_start();
  $_SESSION['productos'] ="";

  $_SESSION['nombres'] = $_POST["nombres"];
  $_SESSION['apellidos'] = $_POST["apellidos"];
  $_SESSION['productos'] = $productos;
  $_SESSION['nombre_provincia'] = $_POST["nombre_provincia"];
  $_SESSION['nombre_pais'] = $_POST["nombre_pais"];

 
  $productosResult ='<div class="mobileHide">';
  $productosResult .= '<br><br>';
  $productosResult .= '<div style="overflow-x:auto;">';

  //$productosResult .= '<div class="table-responsive visible-lg align="center">';
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
  $productosResult .= '<tbody>';
  $productosResult .= '<tr>';



  function array_envia($array) { 
    $tmp = serialize($array); 
    $tmp = urlencode($tmp); 
    return $tmp; 
  } 

  $totalPrimaMensual =0;
  $totalPrimaAnual =0;
  
  //var_dump($edadPersonaMayor);
  
  if(@mysqli_num_rows($productos)>0 && $menor == 0 ){
   
    $sumMensual = 0;
    $sumAnual = 0;
    $existe = false;
    $edadTmp = 0;
    $edadTmp1 = 0;
    $nroPersonas= 0;
    
   
   if($tomador){
     $edadesList = array($sp->CalculaEdad($sp->limpiarFechaNac($_POST["fecha_nac"])), $sp->CalculaEdad($sp->limpiarFechaNac($_POST["fechanac"][0])), $sp->CalculaEdad($sp->limpiarFechaNac($_POST["fechanac"][1])), $sp->CalculaEdad($sp->limpiarFechaNac($_POST["fechanac"][2])), $sp->CalculaEdad($sp->limpiarFechaNac($_POST["fechanac"][3])), $sp->CalculaEdad($sp->limpiarFechaNac($_POST["fechanac"][4])), $sp->CalculaEdad($sp->limpiarFechaNac($_POST["fechanac"][5])));}
    else{
    
     $edadesList = array($sp->CalculaEdad($sp->CalculaEdad($sp->limpiarFechaNac($_POST["fechanac"][0])), $sp->CalculaEdad($sp->limpiarFechaNac($_POST["fechanac"][1])), $sp->CalculaEdad($sp->limpiarFechaNac($_POST["fechanac"][2])), $sp->CalculaEdad($sp->limpiarFechaNac($_POST["fechanac"][3])), $sp->CalculaEdad($sp->limpiarFechaNac($_POST["fechanac"][4])), $sp->CalculaEdad($sp->limpiarFechaNac($_POST["fechanac"][5]))));
     
     }
     
    foreach ($productos as $key => $value) { 
      $t= $value["idProducto"]."-".$value["idPlan"];
      $productosList[$t]= 0;
      $mensualList[$t]= 0;
      $mensualTomadorList[$t]= 0;
      $anualList[$t]= 0;
      $nombreList[$t]= "";
      $descripcionList[$t]= "";
      $copagoList[$t]= "";
    }

    $cantidadFam = $_POST["cant_familiares"];
   
    if(count($_POST["cant_familiares"])>0){
    
    if ($tomador <> "")
    {
      //var_dump($edadPersonaMayor);
      if(empty($edadPersonaMayor))
      {
     // echo "con tomador edadpersonamaryorArray " . $edadPersonaMayor."<br>";
      $cantidadFam = $cantidadFam + 1;
    
      for($i=0; $i<$cantidadFam; $i++)
      {          
        if($edadesList[$i] >= 0)
        {
           $num = $edadesList[$i];
           $nroPersonas=$nroPersonas+1;
          
          $p =0 ;
          foreach ($productos as $key => $value)
          { 
            
            if (($value["edadDesde"] <= $num) && ($num <= $value["edadHasta"])) 
            {
              $sumMensual = 0;
              $sumAnual = 0;
              $t= $value["idProducto"]."-".$value["idPlan"];
              $prod = $value["idProducto"];
              $auxiliar = $auxiliar . $prod . ",";
              $productosList[$t] =  $productosList[$t] + 1;
              $arrayDatos = array($num,$auxiliar,$nroPersonas);
              $find = $arrayDatos[1];
              if($i ==0){
	       $mensualTomadorList[$t]=$value["mensual"];
	       }
              $mensualList[$t] =  $mensualList[$t] + $value["mensual"];
              $anualList[$t] =  $anualList[$t] + $value["anual"];
              $nombreList[$t]= $value["nombre"];
              $descripcionList[$t]= $value["descripcion"];
              $copagoList[$t]= $value["copago"];
           
            $p++;
           }
          }          
         }       
        }
      }
      else
      {
        $mayor==1;
      }
    }   
    else
    {
    //////////////////////////////////////////////////***SIN TOMADOR AHORA***///////////////////////////////////////////////////////////////////////
    
     if(!empty($edadPersonaMayor))//Comprobamos que venga el mayor porque el tomador no es afiliado
     {
      //echo "mayor " . $mayor ."<br>";
      //echo "cantidadFam " . $cantidadFam ."<br>";
      
          //echo "count" . $c."<br>";
          //Si hay un sin tomador si se puede consultar y la cantidad de familiares debe ser solo uno que es el abuelo
          //ó
          //Si es un grupo familiar sin abuelos
        //si es una abuelo y trae mas de un afiliado sin tomador no podemos incluirlo en el grupo familiar 
        if (($mayor == 1 && $cantidadFam == 1) || ($mayor == 0 && $cantidadFam >= 1))
       {
       //echo "entre" ."<br>";     
       for($i=0; $i<$cantidadFam; $i++){ 
        if($edadesList[$i] >= 0){
           $num = $edadesList[$i];
          $numeroEdad= $sp->CalculaEdad($num);
          //echo "num" . $num."<br>"; 
          //echo "numeroEdad" . $numeroEdad."<br>"; 
          $nroPersonas=$nroPersonas+1;
         //echo "edaddesde" . $value["edadDesde"]."<br>"; 
                   
          $p =0 ;
          foreach ($productos as $key => $value) { 
          if (($value["edadDesde"] <= $numeroEdad) && ($numeroEdad <= $value["edadHasta"])) 
          {
          
              $sumMensual = 0;
              $sumAnual = 0;
              $t= $value["idProducto"]."-".$value["idPlan"];
              $prod = $value["idProducto"];
              $auxiliar = $auxiliar . $prod . ",";
              $productosList[$t] =  $productosList[$t] + 1;
              $arrayDatos = array($num,$auxiliar,$nroPersonas);
              $mensualTomadorList[$t]= 0;
              $mensualList[$t] =  $mensualList[$t] + $value["mensual"];
              $anualList[$t] =  $anualList[$t] + $value["anual"];
              $nombreList[$t]= $value["nombre"];
              $descripcionList[$t]= $value["descripcion"];
              $copagoList[$t]= $value["copago"];
           
            $p++;
            
            }            
          }       
         }        
        }
       }
       else{
        $mayor==1;
       }
      } 
      else
      {
        $mayor==1;
      }
    }    
  }
      
   
    if(empty($edadPersonaMayor))
    {      
    foreach ($productosList as $key => $value) 
    { 

        $productosResult .= '<tr>'; 
        $productosResult .= '<td><img src='.  $sp->obtenerImagen($nombreList[$key]).' width="80%"></td>';
        
        $totalPrimaMensual += $mensualList[$key];
        $totalPrimaAnual += $anualList[$key] ;
        $productosResult .= '<td><font color="orange"><b>' . number_format($mensualList[$key], 2, ',', '.') .'</b></font></td>';
        $productosResult .= '<td><font color="orange"><b>'. number_format($anualList[$key], 2, ',', '.') .'</b></font></td>';
        $productosResult .= '<td align="center">' .$copagoList[$key] .'</td>';
        $productosResult .= '<td align="center">' .$nombreList[$key] .'</td>';
        $productosResult .= '<td>' . $descripcionList[$key] . '</td>';
        $productosResult .= '<td>';

        $productosResult .= '<form action="http://hi-broker.com/cotizacionPDF.php" method="post" target="_blank">';
        $productosResult .= '<input type="hidden" name="producto" value="'. $nombreList[$key] .'">';
        $productosResult .= '<input type="hidden" name="anual" value="'. $anualList[$key] .'">';
        $productosResult .= '<input type="hidden" name="mensual" value="'. $mensualTomadorList[$key] .'">';
        $productosResult .= '<input type="hidden" name="nombre" value="'. $nombreList[$key] .'">';
        $productosResult .= ' <input type="hidden" name="nombre_provincia" value="'. $_POST["nombre_provincia"] .'">';
        $productosResult .= '<input type="hidden" name="nombre_pais" value="'. $_POST["nombre_pais"] .'">';
        $productosResult .= '<input type="hidden" name="productosList" value="'. base64_encode(serialize($productosList)) .'">'; 
        $productosResult .= '<input type="hidden" name="mensualList" value="'. base64_encode(serialize($mensualList)) .'">';
        $productosResult .= '<input type="hidden" name="codigoProducto" value="'. $key .'">';
        $array = array_envia($fecha_nac_bene); 
        $productosResult .= '<input type="hidden" name="tomador" value="'. $tomador .'">';
        $productosResult .= '<input type="hidden" name="pais" value="'. $pais .'">';
        $productosResult .= '<input type="hidden" name="provincia" value="'. $provincia .'">';
        $productosResult .= '<input type="hidden" name="nombres" value="'. $nombres .'">';
        $productosResult .= '<input type="hidden" name="apellidos" value="'. $apellidos .'">';
        $productosResult .= '<input type="hidden" name="fecha_nac" value="'. $fecha_nac.'">';
        $productosResult .= '<input type="hidden" name="movil" value="'. $movil .'">';
        $productosResult .= '<input type="hidden" name="email" value="'. $email .'">';
        $productosResult .= '<input type="hidden" name="categoria" value="'. $categoria .'">';

        $productosResult .= '<input type="hidden" name="cant_familiares" value="'. $cant_familiares .'">';
        $productosResult .= '<input type="hidden" name="fecha_nac_bene" value="'. $array .'">';
        $randomNum = substr(str_shuffle("0123456789"), 0, 5);
        $productosResult .='<input type="hidden" name="numero_cotizacion" value="'.  $randomNum .'">';

        //$productosResult .='<input type="hidden" name="numero_cotizacion" value="'.  date('Ymd-His') .'">';

        $productosResult .='<div class="flex">';
        $productosResult .='<input type="submit" id="btn1" class="buton-hb btn-rounded img view" value="" title="VER COTIZACIÓN" name="button1" />';
        $productosResult .='<input type="submit" id="btn2" class="buton-hb btn-rounded img download" value="" title="DESCARGAR SOLICITUD" name="button2" />';
        $productosResult .='<input type="submit" id="btn3" class="buton-hb btn-rounded img see" value="" title="CUADRO MÉDICO" name="button3" />';
        $productosResult .= '</div>';
        $productosResult .='</form>';

        $productosResult .='</div></td>';
        $productosResult .='</tr>';       
    
      
     }
    }
    else
    {
    
    //var_dump($edadPersonaMayor);
    //echo "cantidadFam " . $cantidadFam ."<br>";  
    //echo "mayor  " . $mayor ."<br>";
    if (($tomador == "" && $mayor == 1 && $cantidadFam == 1) || ($tomador <> "" && $mayor == 0 && $cantidadFamn >= 1))
    {
    //echo "entre if 2" ."<br>";  
    foreach ($productosList as $key => $value) 
    { 

        $productosResult .= '<tr>'; 
        $productosResult .= '<td><img src='.  $sp->obtenerImagen($nombreList[$key]).' width="80%"></td>';
        
        $totalPrimaMensual += $mensualList[$key];
        $totalPrimaAnual += $anualList[$key] ;
        $productosResult .= '<td><font color="orange"><b>' . number_format($mensualList[$key], 2, ',', '.') .'</b></font></td>';
        $productosResult .= '<td><font color="orange"><b>'. number_format($anualList[$key], 2, ',', '.') .'</b></font></td>';
        $productosResult .= '<td align="center">' .$copagoList[$key] .'</td>';
        $productosResult .= '<td align="center">' .$nombreList[$key] .'</td>';
        $productosResult .= '<td>' . $descripcionList[$key] . '</td>';
        $productosResult .= '<td>';

        $productosResult .= '<form action="http://hi-broker.com/cotizacionPDF.php" method="post" target="_blank">';
        $productosResult .= '<input type="hidden" name="producto" value="'. $nombreList[$key] .'">';
        $productosResult .= '<input type="hidden" name="anual" value="'. $anualList[$key] .'">';
        $productosResult .= '<input type="hidden" name="mensual" value="'. $mensualTomadorList[$key] .'">';
        $productosResult .= '<input type="hidden" name="nombre" value="'. $nombreList[$key] .'">';
        $productosResult .= ' <input type="hidden" name="nombre_provincia" value="'. $_POST["nombre_provincia"] .'">';
        $productosResult .= '<input type="hidden" name="nombre_pais" value="'. $_POST["nombre_pais"] .'">';
        $productosResult .= '<input type="hidden" name="productosList" value="'. base64_encode(serialize($productosList)) .'">'; 
        $productosResult .= '<input type="hidden" name="mensualList" value="'. base64_encode(serialize($mensualList)) .'">';
        $productosResult .= '<input type="hidden" name="codigoProducto" value="'. $key .'">';
        $array = array_envia($fecha_nac_bene); 
        $productosResult .= '<input type="hidden" name="tomador" value="'. $tomador .'">';
        $productosResult .= '<input type="hidden" name="pais" value="'. $pais .'">';
        $productosResult .= '<input type="hidden" name="provincia" value="'. $provincia .'">';
        $productosResult .= '<input type="hidden" name="nombres" value="'. $nombres .'">';
        $productosResult .= '<input type="hidden" name="apellidos" value="'. $apellidos .'">';
        $productosResult .= '<input type="hidden" name="fecha_nac" value="'. $fecha_nac.'">';
        $productosResult .= '<input type="hidden" name="movil" value="'. $movil .'">';
        $productosResult .= '<input type="hidden" name="email" value="'. $email .'">';
        $productosResult .= '<input type="hidden" name="categoria" value="'. $categoria .'">';

        $productosResult .= '<input type="hidden" name="cant_familiares" value="'. $cant_familiares .'">';
        $productosResult .= '<input type="hidden" name="fecha_nac_bene" value="'. $array .'">';
        $randomNum = substr(str_shuffle("0123456789"), 0, 5);
        $productosResult .='<input type="hidden" name="numero_cotizacion" value="'.  $randomNum .'">';

        //$productosResult .='<input type="hidden" name="numero_cotizacion" value="'.  date('Ymd-His') .'">';

        $productosResult .='<div class="flex">';
        $productosResult .='<input type="submit" id="btn1" class="buton-hb btn-rounded img view" value="" title="VER COTIZACIÓN" name="button1" />';
        $productosResult .='<input type="submit" id="btn2" class="buton-hb btn-rounded img download" value="" title="DESCARGAR SOLICITUD" name="button2" />';
        $productosResult .='<input type="submit" id="btn3" class="buton-hb btn-rounded img see" value="" title="CUADRO MÉDICO" name="button3" />';
        $productosResult .= '</div>';
        $productosResult .='</form>';

        $productosResult .='</div></td>';
        $productosResult .='</tr>';       

     
      
     }
    
    }else{
        $mayor == 1;
    	
       }
    }
  }else{

    if($mayor==1){
      $productosResult .='<tr><td colspan=5><center><font color="red">No existen productos que contemplen la edad(es) de: ' . $edades. ' debe realizar esta cotizaci&oacute;n individualmente</font></center></td></tr>';
    }else{
      if($menor == 1)
        $productosResult .='<tr><td colspan=5><center><font color="red">El tomador debe ser mayor de edad</font></center></td></tr>';
      else
        $productosResult .='<tr><td colspan=5><center><font color="red">No hay productos disponibles</font></center></td></tr>';
    }
  }
 
  if($tomador <> "" && $mayor==1 && !empty($edadPersonaMayor)){
  
      $productosResult .='<tr><td colspan=5><center><font color="red">No existen productos que contemplen la edad(es) de: ' . $edades. ' debe realizar esta cotizaci&oacute;n individualmente</font></center></td></tr>';
      }
      
      


  $productosResult .='</tr>';
  $productosResult .='</tbody>';
  $productosResult .='</table>';
  $productosResult .='<br>';
  $productosResult .='<center><button onclick=window.location.href="http://hi-broker.com/home">Realizar otra consulta</button></center>';
  $productosResult .='</div>';
  $productosResult .= '</div>';
  
  $_SESSION['productos'] = $productosResult;
  
  //*******************************************************************************MOVIL*************************************************************************************
  if(@mysqli_num_rows($productos)>0 && $menor == 0){
 
    $sumMensual = 0;
    $sumAnual = 0;
    $existe = false;
    $edadTmp = 0;
    $edadTmp1 = 0;
    $nroPersonas= 0;
  
    if($tomador){
     $edadesList = array($sp->CalculaEdad($sp->limpiarFechaNac($_POST["fecha_nac"])), $sp->CalculaEdad($sp->limpiarFechaNac($_POST["fechanac"][0])), $sp->CalculaEdad($sp->limpiarFechaNac($_POST["fechanac"][1])), $sp->CalculaEdad($sp->limpiarFechaNac($_POST["fechanac"][2])), $sp->CalculaEdad($sp->limpiarFechaNac($_POST["fechanac"][3])), $sp->CalculaEdad($sp->limpiarFechaNac($_POST["fechanac"][4])), $sp->CalculaEdad($sp->limpiarFechaNac($_POST["fechanac"][5])));}
    else{
    
     $edadesList = array($sp->CalculaEdad($sp->CalculaEdad($sp->limpiarFechaNac($_POST["fechanac"][0])), $sp->CalculaEdad($sp->limpiarFechaNac($_POST["fechanac"][1])), $sp->CalculaEdad($sp->limpiarFechaNac($_POST["fechanac"][2])), $sp->CalculaEdad($sp->limpiarFechaNac($_POST["fechanac"][3])), $sp->CalculaEdad($sp->limpiarFechaNac($_POST["fechanac"][4])), $sp->CalculaEdad($sp->limpiarFechaNac($_POST["fechanac"][5]))));
     }

    foreach ($productos as $key => $value) { 
      $t= $value["idProducto"]."-".$value["idPlan"];
      $productosList[$t]= 0;
      $mensualList[$t]= 0;
      $mensualTomadorList[$t]= 0;
      $anualList[$t]= 0;
      $nombreList[$t]= "";
      $descripcionList[$t]= "";
      $copagoList[$t]= "";
    }


    $cantidadFam = $_POST["cant_familiares"];
 
   if(count($_POST["cant_familiares"])>0){
    
    if ($tomador <> "")
    {
      
      if(empty($edadPersonaMayor))
     {
     
      $cantidadFam = $cantidadFam + 1;
    
      for($i=0; $i<$cantidadFam; $i++)
      {          
        if($edadesList[$i] >= 0)
        {
           $num = $edadesList[$i];
           $nroPersonas=$nroPersonas+1;
          
          $p =0 ;
          foreach ($productos as $key => $value)
          { 
            
            if (($value["edadDesde"] <= $num) && ($num <= $value["edadHasta"])) 
            {
              $sumMensual = 0;
              $sumAnual = 0;
              $t= $value["idProducto"]."-".$value["idPlan"];
              $prod = $value["idProducto"];
              $auxiliar = $auxiliar . $prod . ",";
              $productosList[$t] =  $productosList[$t] + 1;
              $arrayDatos = array($num,$auxiliar,$nroPersonas);
              $find = $arrayDatos[1];
              if($i ==0){
	       $mensualTomadorList[$t]=$value["mensual"];
	       }
              $mensualList[$t] =  $mensualList[$t] + $value["mensual"];
              $anualList[$t] =  $anualList[$t] + $value["anual"];
              $nombreList[$t]= $value["nombre"];
              $descripcionList[$t]= $value["descripcion"];
              $copagoList[$t]= $value["copago"];
           
            $p++;
           }
          }          
         }       
        }
      }
      else
      {
        $mayor==1;
      }
    }   
    else
    {
    ////////////////////////////////////////////////////////////////***SIN TOMADOR AHORA***////////////////////////////////////////////////////////////////////////////
    
     if(!empty($edadPersonaMayor))//Comprobamos que venga el mayor porque el tomador no es afiliado
     {      
          //Si hay un sin tomador si se puede consultar y la cantidad de familiares debe ser solo uno que es el abuelo
          //ó
          //Si es un grupo familiar sin abuelos
        //si es una abuelo y trae mas de un afiliado sin tomador no podemos incluirlo en el grupo familiar 
        if (($mayor == 1 && $cantidadFam == 1) || ($mayor == 0 && $cantidadFam >= 1))
       {
          
       for($i=0; $i<$cantidadFam; $i++){ 
        if($edadesList[$i] >= 0){
           $num = $edadesList[$i];
          $numeroEdad= $sp->CalculaEdad($num);
          $nroPersonas=$nroPersonas+1;
                
          $p =0 ;
          foreach ($productos as $key => $value) { 
          if (($value["edadDesde"] <= $numeroEdad) && ($numeroEdad <= $value["edadHasta"])) 
          {
          
              $sumMensual = 0;
              $sumAnual = 0;
              $t= $value["idProducto"]."-".$value["idPlan"];
              $prod = $value["idProducto"];
              $auxiliar = $auxiliar . $prod . ",";
              $productosList[$t] =  $productosList[$t] + 1;
              $arrayDatos = array($num,$auxiliar,$nroPersonas);
              $mensualTomadorList[$t]= 0;
              $mensualList[$t] =  $mensualList[$t] + $value["mensual"];
              $anualList[$t] =  $anualList[$t] + $value["anual"];
              $nombreList[$t]= $value["nombre"];
              $descripcionList[$t]= $value["descripcion"];
              $copagoList[$t]= $value["copago"];
           
            $p++;
            
            }            
          }       
         }        
        }
       }
       else{
        $mayor==1;
       }
      } 
      else
      {
        $mayor==1;
      }
    }    
  }
   

    $productosResult2 ='</br></br>';
    $productosResult2 .='<div class="mobileShow">';
    $productosResult2 .='<div class="mobileShow wpb_wrapper">';

    if(empty($edadPersonaMayor))
    {
    foreach ($productosList as $key => $value) { 
     
     
        
        $productosResult2 .='<div class="mobileShow">';
        $productosResult2 .='<div id="sc_price" class="sc_price color_style_default sc_price_default">';
        $productosResult2 .='<div class="sc_price_content sc_item_content">';
        $productosResult2 .='<div class="sc_price_item sc_price_item_default">';


        $productosResult2 .='<div class="price-body">';
        $productosResult2 .='<div class="sc_price_item_details">';
        $productosResult2 .='<b>ASEGURADORA: </b><br><img src='.  $sp->obtenerImagen($nombreList[$key]).' width="100px"><br>';
        $productosResult2 .='<b>PRODUCTO: </b>'.	 $nombreList[$key] . '<br>';
        $productosResult2 .='<b>PRECIO MENSUAL: </b><br><font color="orange"><b>'.	 $currency . ' ' .  number_format($mensualList[$key], 2, ',', '.') . '</b></font><br><b>PRECIO ANUAL:</b><br> <font color="orange"><b>'.	 $currency . ' ' . number_format($anualList[$key], 2, ',', '.') .'</b></font><br>';
        $productosResult2 .='<b>COPAGO: </b>'.	 $copagoList[$key ] . '<br>';
        $productosResult2 .='<b>DESCRIPCI&Oacute;N: </b>'.	 $descripcionList[$key ] . '<br><br>';
        $productosResult2 .='</div>';


        $productosResult2 .= '<form action="http://hi-broker.com/cotizacionPDF.php" method="post" target="_blank">';
        $productosResult2 .= '<input type="hidden" name="producto" value="'. $nombreList[$key] .'">';
        $productosResult2 .= '<input type="hidden" name="anual" value="'. $anualList[$key] .'">';
        $productosResult2 .= '<input type="hidden" name="mensual" value="'. $mensualTomadorList[$key] .'">';
        $productosResult2 .= '<input type="hidden" name="nombre" value="'. $nombreList[$key] .'">';
        $productosResult2 .= ' <input type="hidden" name="nombre_provincia" value="'. $_POST["nombre_provincia"] .'">';
        $productosResult2 .= '<input type="hidden" name="nombre_pais" value="'. $_POST["nombre_pais"] .'">';
        $productosResult2 .= '<input type="hidden" name="productosList" value="'. base64_encode(serialize($productosList)) .'">'; 
        $productosResult2 .= '<input type="hidden" name="mensualList" value="'. base64_encode(serialize($mensualList))  .'">';
        $productosResult2 .= '<input type="hidden" name="codigoProducto" value="'. $key .'">';
        $array = array_envia($fecha_nac_bene); 
        $productosResult2 .= '<input type="hidden" name="tomador" value="'. $tomador .'">';
        $productosResult2 .= '<input type="hidden" name="pais" value="'. $pais .'">';
        $productosResult2 .= '<input type="hidden" name="provincia" value="'. $provincia .'">';
        $productosResult2 .= '<input type="hidden" name="nombres" value="'. $nombres .'">';
        $productosResult2 .= '<input type="hidden" name="apellidos" value="'. $apellidos .'">';
        $productosResult2 .= '<input type="hidden" name="fecha_nac" value="'. $fecha_nac.'">';
        $productosResult2 .= '<input type="hidden" name="movil" value="'. $movil .'">';
        $productosResult2 .= '<input type="hidden" name="email" value="'. $email .'">';
        $productosResult2 .= '<input type="hidden" name="categoria" value="'. $categoria .'">';
        $productosResult2 .= '<input type="hidden" name="cant_familiares" value="'. $cant_familiares .'">';
        $productosResult2 .= '<input type="hidden" name="fecha_nac_bene" value="'. $array .'">';
        $randomNum = substr(str_shuffle("0123456789"), 0, 5);
        $productosResult2 .='<input type="hidden" name="numero_cotizacion" value="'.  $randomNum .'">';

        

        $productosResult2 .='<div class="flex">';
        $productosResult2 .='<input type="submit" id="btn1" class="buton-hb btn-rounded img view" value="" title="VER COTIZACIÓN" name="button1" />';
        $productosResult2 .='<input type="submit" id="btn2" class="buton-hb btn-rounded img download" value="" title="DESCARGAR SOLICITUD" name="button2" />';
        $productosResult2 .='<input type="submit" id="btn3" class="buton-hb btn-rounded img see" value="" title="CUADRO MÉDICO" name="button3" />';
        $productosResult .= '</div>';
        $productosResult2 .='</form>';

        $productosResult2 .='</div>';
        $productosResult2 .='</div>';

        $productosResult2 .='</div>';
        $productosResult2 .='</div>';
        $productosResult2 .='</div>';
        $productosResult2 .='</div><br><br>';

   

    }

   }
   else
   {
    
    if (($mayor == 1 && $cantidadFam == 1) || ($mayor == 0 && $cantidadFam >= 1))
    {
    foreach ($productosList as $key => $value) 
    { 

        $productosResult2 .= '<tr>'; 
        $productosResult2 .= '<td><img src='.  $sp->obtenerImagen($nombreList[$key]).' width="80%"></td>';
        
        $totalPrimaMensual += $mensualList[$key];
        $totalPrimaAnual2 += $anualList[$key] ;
        $productosResult2 .= '<td><font color="orange"><b>' . number_format($mensualList[$key], 2, ',', '.') .'</b></font></td>';
        $productosResult2 .= '<td><font color="orange"><b>'. number_format($anualList[$key], 2, ',', '.') .'</b></font></td>';
        $productosResult2 .= '<td align="center">' .$copagoList[$key] .'</td>';
        $productosResult2 .= '<td align="center">' .$nombreList[$key] .'</td>';
        $productosResult2 .= '<td>' . $descripcionList[$key] . '</td>';
        $productosResult2 .= '<td>';

        $productosResult2 .= '<form action="http://hi-broker.com/cotizacionPDF.php" method="post" target="_blank">';
        $productosResult2 .= '<input type="hidden" name="producto" value="'. $nombreList[$key] .'">';
        $productosResult2 .= '<input type="hidden" name="anual" value="'. $anualList[$key] .'">';
        $productosResult2 .= '<input type="hidden" name="mensual" value="'. $mensualTomadorList[$key] .'">';
        $productosResult2 .= '<input type="hidden" name="nombre" value="'. $nombreList[$key] .'">';
        $productosResult2 .= ' <input type="hidden" name="nombre_provincia" value="'. $_POST["nombre_provincia"] .'">';
        $productosResult2 .= '<input type="hidden" name="nombre_pais" value="'. $_POST["nombre_pais"] .'">';
        $productosResult2 .= '<input type="hidden" name="productosList" value="'. base64_encode(serialize($productosList)) .'">'; 
        $productosResult2 .= '<input type="hidden" name="mensualList" value="'. base64_encode(serialize($mensualList)) .'">';
        $productosResult2 .= '<input type="hidden" name="codigoProducto" value="'. $key .'">';
        $array = array_envia($fecha_nac_bene); 
        $productosResult2 .= '<input type="hidden" name="tomador" value="'. $tomador .'">';
        $productosResult2 .= '<input type="hidden" name="pais" value="'. $pais .'">';
        $productosResult2 .= '<input type="hidden" name="provincia" value="'. $provincia .'">';
        $productosResult2 .= '<input type="hidden" name="nombres" value="'. $nombres .'">';
        $productosResult2 .= '<input type="hidden" name="apellidos" value="'. $apellidos .'">';
        $productosResult2 .= '<input type="hidden" name="fecha_nac" value="'. $fecha_nac.'">';
        $productosResult2 .= '<input type="hidden" name="movil" value="'. $movil .'">';
        $productosResult2 .= '<input type="hidden" name="email" value="'. $email .'">';
        $productosResult2 .= '<input type="hidden" name="categoria" value="'. $categoria .'">';

        $productosResult2 .= '<input type="hidden" name="cant_familiares" value="'. $cant_familiares .'">';
        $productosResult2 .= '<input type="hidden" name="fecha_nac_bene" value="'. $array .'">';
        $randomNum = substr(str_shuffle("0123456789"), 0, 5);
        $productosResult2 .='<input type="hidden" name="numero_cotizacion" value="'.  $randomNum .'">';

       

        $productosResult2 .='<div class="flex">';
        $productosResult2 .='<input type="submit" id="btn1" class="buton-hb btn-rounded img view" value="" title="VER COTIZACIÓN" name="button1" />';
        $productosResult2 .='<input type="submit" id="btn2" class="buton-hb btn-rounded img download" value="" title="DESCARGAR SOLICITUD" name="button2" />';
        $productosResult2 .='<input type="submit" id="btn3" class="buton-hb btn-rounded img see" value="" title="CUADRO MÉDICO" name="button3" />';
        $productosResult2 .= '</div>';
        $productosResult2 .='</form>';

        $productosResult2 .='</div></td>';
        $productosResult2 .='</tr>';       

     
      
     }
    
    }else{
        
    	    $productosResult2 .='<tr><td colspan=5><center><font color="red">No existen productos que contemplen la edad(es) de: ' . $edades. ' debe realizar esta cotizaci&oacute;n individualmente</font></center></td></tr>';
    	
       }
    }

  }
  else{

    if($mayor==1){
      $productosResult2 .='<tr><td colspan=5><center><font color="red">No existen productos que contemplen la edad(es) de: ' . $edades. ' debe realizar esta cotizaci&oacute;n individualmente</font></center></td></tr>';
    }else{
      if($menor == 1)
        $productosResult2 .='<tr><td colspan=5><center><font color="red">El tomador debe ser mayor de edad</font></center></td></tr>';
      else
        $productosResult2 .='<tr><td colspan=5><center><font color="red">No hay productos disponibles</font></center></td></tr>';
    }
  }
  
  if($tomador <> "" && $mayor==1 && !empty($edadPersonaMayor)){
      $productosResult2 .='<tr><td colspan=5><center><font color="red">No existen productos que contemplen la edad(es) de: ' . $edades. ' debe realizar esta cotizaci&oacute;n individualmente</font></center></td></tr>';
     }

  $productosResult2 .='</div>';
  $productosResult2 .='<br><br>';
  $productosResult2 .='<div class="mobileShow"><center><button onclick=window.location.href="http://hi-broker.com/home">Realizar otra consulta</button></center></div>';
  $productosResult2 .='</div>';


  $_SESSION['productos2'] = $productosResult2;
  
  @header("Location: http://hi-broker.com/resultados/");
  
  ?>


  <?php  
}else{
  echo $mensaje_error;
}
?>