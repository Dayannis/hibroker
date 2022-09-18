<?php


  header("Content-Type: text/html;charset=utf-8");

  require_once("dompdf/dompdf_config.inc.php");
  require_once("sp.php"); 
  $sp = new Sp();
  ini_set('memory_limit', '2048M'); // or you could use 1G
  ini_set('max_execution_time', 1800);

  function array_recibe($url_array) { 
    $tmp = stripslashes($url_array); 
    $tmp = urldecode($tmp); 
    $tmp = unserialize($tmp); 

   return $tmp; 
} 

function calculaedad($fechanacimiento){
  if($fechanacimiento!="" || $fechanacimiento!=null){
list($ano,$mes,$dia) = explode("-",$fechanacimiento);
$ano_diferencia = date("Y") - $ano;
$mes_diferencia = date("m") - $mes;
$dia_diferencia = date("d") - $dia;
if ($dia_diferencia < 0 && $mes_diferencia <= 0)
$ano_diferencia--;
return $ano_diferencia;
}
}

 $mensual_total_titular=0;
 $anual_total_titular=0;

//VALIDO DATOS
if(isset($_POST["producto"])  && !empty($_POST["producto"])
  && isset($_POST["movil"])  && !empty($_POST["movil"])
    && isset($_POST["email"])  && !empty($_POST["email"])
      && isset($_POST["nombres"])  && !empty($_POST["nombres"])
      && isset($_POST["apellidos"])  && !empty($_POST["apellidos"])
      && isset($_POST["cant_familiares"]) 
      && isset($_POST["numero_cotizacion"])  && !empty($_POST["numero_cotizacion"])){
      //NUMERO ALEATORIO DEBEMOS MEJORAR POR QUE AQUI VA EL NUMERO DE COTIZACION DE DONDE LO SACO????
      $numero_cotizacion=$_POST["numero_cotizacion"];
      $valido = 1;
      $nroPersonas = $_POST["cant_familiares"];
      $currency ="€";
     if($_POST["pais"]==2){ $currency ="$";}
}else{
      $valido = 2;
      header("location:javascript://history.go(-1)");
}

  $html = '<!doctype html>
    <html class="no-js" lang="">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Cotizacion</title>
    <meta name="description" content="">
   

    <style>
    *{
      margin:4;
      padding:4;
      font-family:Helvetica,Verdana,Monaco,sans-serif;

     }

     .logos{
      width:30%;
     }

     .encabezado{
      background-color:#F4F6F6;
      color:#201e5b;
      font-weight:bold;
      font-size:14;
      line-height:25px;
      margin-top:-100px;
     }

     .encabezado_title{
      background-color:#4fc3f7;
      color:#FFF;
      text-align:center;
      font-size:14;
      margin-bottom:0px;
     }

     .cuerpo{
      border: 6px solid #ccc;
      color: #99A3A4;
      
      font-size:14;
      line-height:20px;
      height:auto;
      margin-top:-3px;
     }

     .cuerpo_precios{
      position:left;
      text-align:center;
      padding:1px;
      border: 6px solid #ccc;
      font-size:12;
      height:auto;
     }

    .table_precio{
      position:center center;
      width:100%;
      margin-top:-8px;

    }

    .primera_columna{
      color:#00000;
      background-color:#D5DBDB;
      width:100%;
      padding:5px;
       font-size:16px;
      text-align:center;
    }

    .segunda_columna{
      color:#FFF;
      background-color:#4fc3f7;
      width:100%;
      padding:5px;
       font-size:16px;
      text-align:center;
      
    }

     .tercera_columna{
      color:#000;
      background-color:#bbdefb;
      width:100%;
      padding:5px;
      font-size:18px;
      text-align:center;
      
    }

    .pie{
      background-color:#bbdefb;
      height:auto;
      font-size:19px;
      color:#566573;
      line-height:27px;
      padding:0px;
      margin-top:-3px;
    }

    .table-header{
    margin-bottom:-25px;
    }

    .button_correo{
      background-color:#EB984E;
      color:#FFF;
      border-radius:20px;
      width:20%;
      border: 0px;
      padding:10px;
      position:center;
      font-size:17px;
       margin-left:38%;
    }

    #tabla{
    margin-left:10%;
  }



    </style>

  </head>
  <body>
  <div id="header"> 
  <table class="table-header">
  <tr>
  <td>
    <img src="assets/img/logo.png" class="logos">
  </td>

  <td style="width:100%;text-align:center;color:#b5bbc8;"><b>COTIZACI&Oacute;N PARA</b> <br>'.$_POST["producto"].'</td>

  
  ';
  


  $html.= '<td><img src=' .   $sp->obtenerImagen($_POST["producto"]) .' class="logos" ></td>';
          


  $html.='</tr></table>';

  
  $html.='</div>';

    $html.='<div class="encabezado">';

    $html.='N&uacute;mero de cotización: '.$numero_cotizacion.'<br>';

    $html.='Producto: '.$_POST["producto"].'<br>';

    $html.='Tel&eacute;fono: '.$_POST["movil"].'<br>';

    $html.='Email: '.$_POST["email"].'<br>';

    $html.='Fecha de presupuesto: '.date("d-m-Y").'<br>';
    
    $html.='</div>';


    $html.='<div class="encabezado_title">';

    $html.='<p>Cliente(s): '.$_POST["nombres"].' '.$_POST["apellidos"];

    if(isset($_POST["cant_familiares"]) && !empty($_POST["cant_familiares"]) && $_POST["cant_familiares"]>0){
    $html.=' y '.$_POST["cant_familiares"].' asegurado(s),';
    
    //////////////////////////7$html.='AQUI'.  $_POST["fecha_nac_bene"];
    $array=$_POST['fecha_nac_bene']; 
 // el método de envio usado. (en el ejemplo un link genera un GET. En el formulario se usa POST podria ser GET tambien ...) 

    $array=array_recibe($array); 

    $html.=' edades ';
    foreach ($array as $indice => $valor){
    if($valor!="" || $valor!=null){ 
    $edad = calculaedad($valor);
    $html.=  $edad;
    if($indice != $_POST["cant_familiares"]-1){
      $html.=',';
    }
  // $html.= $indice.' = '.$valor.; 
    }
    }
    
    }
    $html.='</p>';

    $html.='</div>';


    $html.='<div class="cuerpo">';

    if($_POST["provincia"]!="" || $_POST["provincia"]!=null){
      $html.='<p style="padding:-5px;">Provincia:   <B>'.$_POST["nombre_provincia"].'</B>';
    }
    $html.=' Fecha efecto: '.date("d-m-Y").'</p><br>';

    $html.='Requisitos para emitir p&oacute;liza:<br>';
    $html.='<p style="padding:10px;">Completar solicitud y cuestionario médico, documento de identidad pasaporte,DNI, NIE otro, Cuenta bancaria o tdc internacional.</p>';

    $html.='</div>';


    $html.='<div class="cuerpo_precios">';

     $html.='<div id="tabla"><table class="table_precio" style="border-spacing:5px;">';

    $html.='<tr>';
    $html.='<td class="primera_columna">Edad/Asegurados </td> <td class="segunda_columna">Mensual</td> <td class="segunda_columna">Anual</td>';
    $html.='</tr>';

    if(isset($_POST["tomador"])  && !empty($_POST["tomador"])){
      $edad_tomador = calculaedad($_POST["fecha_nac"]);
     
          $mensual_total_titular =$_POST["mensual"]*1;
	 
	 
          if ($_POST["mensual"]>0){
		 
		 $anual_total_titular=$_POST["mensual"]*12;
		 
	 }else{
		 
		 $anual_total_titular=$_POST["anual"];
	 }
		 
	 
	if ($_POST["mensual"]>0){
	

    $html.='<tr>';
    $html.='<td class="primera_columna">'.$edad_tomador.' A&ntilde;os </td> <td class="segunda_columna">'.number_format($_POST["mensual"],2,",","."). $currency.'</td> <td class="segunda_columna">'.number_format($_POST["mensual"]*12,2,",","."). $currency.' </td>';
    $html.='</tr>';
}else{
     $html.='<tr>';
    $html.='<td class="primera_columna">'.$edad_tomador.' A&ntilde;os </td> <td class="segunda_columna">'.number_format($_POST["mensual"],2,",","."). $currency.'</td> <td class="segunda_columna">'.number_format($_POST["anual"],2,",","."). $currency.' </td>';
    $html.='</tr>';
}

    $html.='<tr>';
    $html.='<td class="tercera_columna">Total prima titular </td> <td class="tercera_columna">'.number_format($mensual_total_titular,2,",",".").$currency.' </td> <td class="tercera_columna">'.number_format($anual_total_titular,2,",","."). $currency.'</td>';
    $html.='</tr>';

    }
$mensual_total = $_POST["mensual"];

  

   if(isset($_POST["cant_familiares"]) && !empty($_POST["cant_familiares"]) && $_POST["cant_familiares"]>0){

    $productosList=unserialize(base64_decode($_POST['productosList']));
    $mensualList =unserialize(base64_decode($_POST['mensualList']));

    $codigoProducto = $_POST['codigoProducto'];
    
    //var_dump($productosList);
   //var_dump($mensualList);
  
   
 
   foreach ($array as $indice => $valor){
    if($valor!="" || $valor!=null){ 
    $edad = calculaedad($valor);
    $temp = explode ("-", $codigoProducto);  

    $montoMensual = $sp->montoFamilia($_POST["pais"],$_POST["provincia"],$edad,$temp[0] ,$temp[1]);

    $mensual_total += $montoMensual;
    
    
    $html.='<tr>';
    $html.='<td class="primera_columna">'.$edad.' A&ntilde;os </td> <td class="segunda_columna">'.number_format($montoMensual,2,",","."). $currency.' </td> <td class="segunda_columna">'.number_format($montoMensual * 12,2,",",".").$currency.' </td>';
    $html.='</tr>';
    }
    } 

    $anual_total= $mensual_total*12;

    $html.='<tr>';
    $html.='<td class="tercera_columna">Total prima </td> <td class="tercera_columna">'.number_format($mensual_total,2,",",".").$currency.' </td> <td class="tercera_columna">'.number_format($anual_total,2,",",".").$currency.' </td>';
    $html.='</tr>';




    }


    $html.='</table></div>';
    $html.='</div>';

     $html.='<div class="pie">';

  

      $html.='</div>';
       
     

      $temp = '<p><p><button class="button_correo"><a href="http://hi-broker.com/enviarCorreo.php?code='.$numero_cotizacion.'&nombre='.$_POST["nombres"].' '.$_POST["apellidos"].'&email='.$_POST["email"].'" class="">ENVIAR POR CORREO</a></button></p></p>';
      
      $html.='<p><p><button class="button_correo"><a href="http://hi-broker.com/enviarCorreo.php?code='.$numero_cotizacion.'&nombre='.$_POST["nombres"].' '.$_POST["apellidos"].'&email='.$_POST["email"].'" class="">ENVIAR POR CORREO</a></button></p></p>';






  


 $html.='<!--<div style="page-break-before: always;"></div>-->
         

 </div> 

 </body>
</html>';

//var_dump($html);


  $dompdf = new DOMPDF();
  $dompdf->set_option('enable_html5_parser', TRUE);
  $dompdf->set_paper("a4","portrait");
  $dompdf->load_html($html);
  
  //$dompdf->set_option( 'isRemoteEnabled', true );
  //$dompdf->set_paper("a4","portrait");

  $dompdf->render();

  $dompdf->stream("cotizacion_".$numero_cotizacion.".pdf", array("Attachment" => 0));

  if($valido==1){
  //ALMACENANDO EL ARCHIVO EN UN DIRECTORIO PARA ENVIARLO POR CORREO
  $dompdf = new DOMPDF();
  $html = str_replace($temp,"",$html);
  $dompdf->load_html($html);
  $dompdf->set_paper("a4","portrait");
  $dompdf->render();
  $pdf = $dompdf->output();
  file_put_contents("cotizaciones/cotizacion_".$numero_cotizacion.".pdf", $pdf);  
}



  //$dompdf->stream("Historial ".$_POST["nombre"].".pdf");

   ?>