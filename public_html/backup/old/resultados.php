<?php

require_once("sp.php"); 
$sp = new Sp();
$datos_correctos=0;
$MAX_EDAD=75;
$edades = "";
$mayor = 0;
//ECHO "<BR><BR><BR>".$_POST["fechanac"][1];
//echo $sql;
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

              $edadTmp = $sp->CalculaEdad($sp->limpiarFechaNac($_POST["fechanac"][$i]));
              
              if($edadTmp >= $MAX_EDAD){
                 $mayor = 1;
                 $edades .= $edadTmp  . " ,";
              }

              $fecha_nac_bene[$i]= $sp->limpiarFechaNac($_POST["fechanac"][$i]);

              // echo "aquii".$_POST["fechanac"][$i]." ".$fecha_nac_bene[$i]."<br>";

              
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
          //echo $provincia;
          //var_dump($_POST);
          if(isset($_POST["tomador"]) && !empty($_POST["tomador"])){
              $fecha_tomador = $fecha_nac;
              $tomador = 1;
              $edadTmp = $sp->CalculaEdad($sp->limpiarFechaNac($fecha_tomador));
              
              if($edadTmp >= $MAX_EDAD){
                 $mayor = 1;
                 $edades .= $edadTmp  . " ,";
              }

          }else{
               $fecha_tomador ='';
               $tomador='';
          }
         // var_dump($fecha_nac_bene);
         
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
         
         
          //var_dump($_SESSION['productos']);
          
          
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
    if(@mysqli_num_rows($productos)>0){
    
     $sumMensual = 0;
            $sumAnual = 0;
            $existe = false;
            $edadTmp = 0;
            $edadTmp1 = 0;
            $nroPersonas= 0;
            //array temporal
            $edadesList = array($sp->CalculaEdad($sp->limpiarFechaNac($_POST["fecha_nac"])), $sp->CalculaEdad($sp->limpiarFechaNac($_POST["fechanac"][0])), $sp->CalculaEdad($sp->limpiarFechaNac($_POST["fechanac"][1])), $sp->CalculaEdad($sp->limpiarFechaNac($_POST["fechanac"][2])), $sp->CalculaEdad($sp->limpiarFechaNac($_POST["fechanac"][3])), $sp->CalculaEdad($sp->limpiarFechaNac($_POST["fechanac"][4])), $sp->CalculaEdad($sp->limpiarFechaNac($_POST["fechanac"][5]))); 

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

            //  var_dump ($edadesList);
              
            if(count($_POST["cant_familiares"])>0){
                
             for($i=0; $i<=7; $i++){
                  if($edadesList[$i] > 0){
                       $num = $edadesList[$i];
                       $nroPersonas=$nroPersonas+1;
                         //echo "EDAD ". $num ."<br>";
                         $p =0 ;
                       foreach ($productos as $key => $value) { 
                        //   echo "PINIT=>" . $p . $value["nombrePlan"] . "-". $value["mensual"]  ."<br>";
                            if (($num >= $value["edadDesde"]) && ($num <= $value["edadHasta"])) {
                              //  echo "PV=>" . $p . $value["nombrePlan"] . "-". $value["mensual"]  ."<br>";
                                $sumMensual = 0;
                                $sumAnual = 0;
                                $t= $value["idProducto"]."-".$value["idPlan"];
                                $productosList[$t] =  $productosList[$t] +1;
                                if($i ==0){
                                   $mensualTomadorList[$t]=$value["mensual"];
                                }
                                $mensualList[$t] =  $mensualList[$t] + $value["mensual"];
                                $anualList[$t] =  $anualList[$t] + $value["anual"];
                                $nombreList[$t]= $value["nombre"];
                                $descripcionList[$t]= $value["descripcion"];
                                $copagoList[$t]= $value["copago"];
                            }
                            $p++;
                       }
                  }
              }    
              }      
            //  echo $nroPersonas."<br>";
             // var_dump ($productosList);
            //  var_dump ($mensualList);
            //  var_dump ($anualList);
                  
            foreach ($productosList as $key => $value) { 

            

              if($value == $nroPersonas){
    
     

         
          $productosResult .= '<tr>'; 
          $productosResult .= '<td><img src='.  $sp->obtenerImagen($nombreList[$key]).' width="80%"></td>';
          $totalPrimaMensual += $mensualList[$key] ;
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

              $productosResult .= '<input type="hidden" name="cant_familiares" value="'. $cant_familiares .'">';
              $productosResult .= '<input type="hidden" name="fecha_nac_bene" value="'. $array .'">';
              $randomNum = substr(str_shuffle("0123456789"), 0, 5);
              $productosResult .='<input type="hidden" name="numero_cotizacion" value="'.  $randomNum .'">';

              //$productosResult .='<input type="hidden" name="numero_cotizacion" value="'.  date('Ymd-His') .'">';


              $productosResult .='<button class="buton-hb">VER COTIZACI&Oacute;N</button>';
            $productosResult .='</form>';

          $productosResult .='</div></td>';
        $productosResult .='</tr>';
    
        }
        if($totalPrimaMensual > 0){
          //$productosResult .='<tr><td>TOTAL PRIMA</td><td><font color="orange"><b>'. $totalPrimaMensual  .'</b></font></td><td><font color="orange"><b>'. $totalPrimaAnual  .'</b></font></td><td colspan=4></td></tr>';
        }
        }
    }else{

      if($mayor==1){
         $productosResult .='<tr><td colspan=5><center><font color="red">No existen productos que contemplen la edad(es) de: ' . $edades. ' debe realizar esta cotizaci&oacute;n individualmente</font></center></td></tr>';
      }else{
          $productosResult .='<tr><td colspan=5><center><font color="red">No hay productos disponibles</font></center></td></tr>';
      }
      


    }
    
          
          $productosResult .='</tr>';
          $productosResult .='</tbody>';
          $productosResult .='</table>';
          $productosResult .='<br>';
          $productosResult .='<center><button onclick=window.location.href="http://hi-broker.com">Realizar otra consulta</button></center>';
          $productosResult .='</div>';
           $productosResult .= '</div>';

          $_SESSION['productos'] = $productosResult;

          if(@mysqli_num_rows($productos)>0){

            $sumMensual = 0;
            $sumAnual = 0;
            $existe = false;
            $edadTmp = 0;
            $edadTmp1 = 0;
            $nroPersonas= 0;
            //array temporal
            $edadesList = array($sp->CalculaEdad($sp->limpiarFechaNac($_POST["fecha_nac"])), $sp->CalculaEdad($sp->limpiarFechaNac($_POST["fechanac"][0])), $sp->CalculaEdad($sp->limpiarFechaNac($_POST["fechanac"][1])), $sp->CalculaEdad($sp->limpiarFechaNac($_POST["fechanac"][2])), $sp->CalculaEdad($sp->limpiarFechaNac($_POST["fechanac"][3])), $sp->CalculaEdad($sp->limpiarFechaNac($_POST["fechanac"][4])), $sp->CalculaEdad($sp->limpiarFechaNac($_POST["fechanac"][5]))); 

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

            //  var_dump ($edadesList);
              
            if(count($_POST["cant_familiares"])>0){
                
             for($i=0; $i<=7; $i++){
                  if($edadesList[$i] > 0){
                       $num = $edadesList[$i];
                       $nroPersonas=$nroPersonas+1;
                         //echo "EDAD ". $num ."<br>";
                         $p =0 ;
                       foreach ($productos as $key => $value) { 
                        //   echo "PINIT=>" . $p . $value["nombrePlan"] . "-". $value["mensual"]  ."<br>";
                            if (($num >= $value["edadDesde"]) && ($num <= $value["edadHasta"])) {
                              //  echo "PV=>" . $p . $value["nombrePlan"] . "-". $value["mensual"]  ."<br>";
                                $sumMensual = 0;
                                $sumAnual = 0;
                                
                                $t= $value["idProducto"]."-".$value["idPlan"];
                                $productosList[$t] =  $productosList[$t] +1;
                                $mensualList[$t] =  $mensualList[$t] + $value["mensual"];
                                if($i ==0){
                                   $mensualTomadorList[$t]=$value["mensual"];
                                }
                                $anualList[$t] =  $anualList[$t] + $value["anual"];
                                $nombreList[$t]= $value["nombre"];
                                $descripcionList[$t]= $value["descripcion"];
                                $copagoList[$t]= $value["copago"];
                            }
                            $p++;
                       }
                  }
              }    
              }      
            //  echo $nroPersonas."<br>";
             // var_dump ($productosList);
            //  var_dump ($mensualList);
            //  var_dump ($anualList);

          $productosResult2 ='</br></br>';
          $productosResult2 .='<div class="mobileShow">';
          $productosResult2 .='<div class="mobileShow wpb_wrapper">';
                  
            foreach ($productosList as $key => $value) { 

            

              if($value == $nroPersonas){
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

                                $productosResult2 .= '<input type="hidden" name="cant_familiares" value="'. $cant_familiares .'">';
                                $productosResult2 .= '<input type="hidden" name="fecha_nac_bene" value="'. $array .'">';
                                $randomNum = substr(str_shuffle("0123456789"), 0, 5);
                                $productosResult2 .='<input type="hidden" name="numero_cotizacion" value="'.  $randomNum .'">';

                                //$productosResult2 .='<input type="hidden" name="numero_cotizacion" value="'.  date('Ymd-His') .'">';


                                $productosResult2 .='<button class="buton-hb">VER COTIZACI&Oacute;N</button>';
                              $productosResult2 .='</form>';
                              
                            $productosResult2 .='</div>';
                          $productosResult2 .='</div>';
                          
                      $productosResult2 .='</div>';
                  $productosResult2 .='</div>';
                  $productosResult2 .='</div>';
                $productosResult2 .='</div><br><br>';
              
              }

            }
            

            }

            $productosResult2 .='</div>';
            $productosResult2 .='<br><br>';
            $productosResult2 .='<div class="mobileShow"><center><button onclick=window.location.href="http://hi-broker.com">Realizar otra consulta</button></center></div>';
            $productosResult2 .='</div>';
          
          
          $_SESSION['productos2'] = $productosResult2;
          //var_dump( $productosResult);
//var_dump( $productosResult2);
         @header("Location: http://hi-broker.com/resultados/");
        //die();
 ?>


<?php  
}else{
  echo $mensaje_error;
}
?>