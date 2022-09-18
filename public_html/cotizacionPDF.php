<?php

  error_reporting(0);
  header("Content-Type: text/html;charset=utf-8");

  require_once("dompdf/dompdf_config.inc.php");
  require_once("sp.php"); 
  $sp = new Sp();
  $view=1;
  $download=2;
  $tomador = false;
  //if($_REQUEST['button1']=='view')
   //var_dump($view);
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
      && isset($_POST["numero_cotizacion"])  && !empty($_POST["numero_cotizacion"]) /*&& isset($_COOKIE['nombre'])*/){
      //NUMERO ALEATORIO DEBEMOS MEJORAR POR QUE AQUI VA EL NUMERO DE COTIZACION DE DONDE LO SACO????
      $numero_cotizacion=$_POST["numero_cotizacion"];
      $valido = 1;
      $nroPersonas = $_POST["cant_familiares"];
      $currency ="€";
     if($_POST["pais"]==2){ $currency ="$";}
     $categoria = $_POST["categoria"];
     $movil=$_POST["movil"];
     if(isset($_POST["tomador"]) && !empty($_POST["tomador"]))
        $tomador = true;
}else{
      $valido = 2;
      header("location:javascript://history.go(-1)");
}

  $html = '<!DOCTYPE html>
  <html lang="en">
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Cotizacion</title>
    <link rel="icon" href="http://pages.hi-broker.com/wp-content/uploads/2020/02/cropped-Recurso-2-32x32.png" type="image/png" sizes="32x32">
    <link rel="icon" href="http://pages.hi-broker.com/wp-content/uploads/2020/02/cropped-Recurso-2-32x32.png" sizes="32x32">
    <link rel="icon" href="http://pages.hi-broker.com/wp-content/uploads/2020/02/cropped-Recurso-2-192x192.png" sizes="192x192">
    <link rel="apple-touch-icon-precomposed" href="http://pages.hi-broker.com/wp-content/uploads/2020/02/cropped-Recurso-2-180x180.png">
    <meta name="msapplication-TileImage" content="http://pages.hi-broker.com/wp-content/uploads/2020/02/cropped-Recurso-2-270x270.png">
    <meta name="description" content="">
    <style>
    
    /*@font-face {
      font-family: "Ubuntu-Regular";
      src: url("http://localhost/hi-broker/assets/fonts/Ubuntu-Regular.ttf") format("ttf");
    }*/
  .clearfix:after {
      content: "";
      /*display: inline-block;*/
      clear: both;
  }
  
  a {
      color: #0087C3;
      text-decoration: none;
  }
  
  body {
      position: relative;
      width: auto;
      height: auto;
      margin: 0 auto;
      color: #555555;
      background: #FFFFFF;
      /*font-family: "Ubuntu-Regular";*/
      font-size: 14px;
  }
  
  
  header {
    padding: 10px 0;
      margin-bottom: 20px;
      border-bottom: 0.1em solid #cfcfcf;
  }
  
  #logo {
      float: left;
  }
  
  #logo img {
      height: 110px;
  }
  
  #company {
      position: absolute;
      top:5.5%;
      left:80%;
      margin-top: 8px;
      float: right;
      text-align: right;
  }
  
  #company img {
      height: 60px;
  }
  .descripcion{
    display:inline-block;
    border: 6px solid #4FC2F6;
    color: #99A3A4;
    font-size: 14;
    margin-bottom:10px;
    margin-top:15px;
  }

  #descripcion .title{
    background-color:#4FC2F6;
    color:white;
    margin-top:0px;
    text-align:center;
    line-height:20px;
    padding-bottom:5px;
  }
  #descripcion .content{
    color: #99A3A4;
    padding-left:25px;
      padding-right:25px;
      text-align: justify;

  }
  ';
  if($nroPersonas <= 3){
    $html.='
    #details {
      margin-bottom: 30px;
    }

    .requisitos{
      display:inline-block;
      border: 6px solid #ccc;
      color: #99A3A4;
      font-size: 14;
      line-height: 20px;
      margin-bottom:10px;
      margin-top:15px;
    }

    .cuerpo {
      display:inline-block;
      border: 6px solid #ccc;
      position: relative;
      color: #99A3A4;
      font-size: 14;
      line-height: 20px;
      margin-bottom:-10px;
      margin-top:-30px !important;
    }

    table th,
    table td {
      padding: 20px;
      background: #EEEEEE;
      text-align: center;
      height:10px !important;
      font-size: 18px !important;
      border-bottom: 5px solid #FFFFFF;
      border-right:5px solid #FFFFFF;
      border-left:5px solid #FFFFFF;
    }
    ';
    switch($nroPersonas){
      case 0:
        $html.='
          table {
            margin-top:30px;
            width: 100%;
            margin-bottom: 50px;
            border-collapse: collapse;
          }
          #thanks{
            page-break-before:always;
            font-size: 2em;
            margin-bottom: 20px;
           }
        ';
        break;
      case 1:
        if($tomador)
          $html.='
            table {
              width: 100%;
              margin-bottom:30px;
            }
            #thanks{
              page-break-before:always;
              font-size: 2em;
              margin-bottom: 20px;
            }
          ';
        else
          $html.='
          table {
            width: 100%;
            margin-bottom:50px;
          }
           #thanks{
              page-break-before:always;
              font-size: 2em;
              margin-bottom: 20px;
            }
          ';
        break;
      case 2:
        if($tomador)
          $html.='
            table {
              width: 100%;
              margin-bottom: 18px;
              border-collapse: collapse;
            }
            #thanks{
              page-break-before:always;
              font-size: 2em;
              margin-bottom: 20px;
            }
          ';
        else
          $html.='
            table {
              width: 100%;
              margin-bottom:30px;
            }
            #thanks{
              page-break-before:always;
              font-size: 2em;
              margin-bottom: 20px;
            }
          ';
        break;
      case 3:
        if($tomador)
          $html.='
          table {
            width: 100%;
            margin-bottom: 20px;
            page-break-after: always;
            }
           #thanks{
              margin-top:20px;
              font-size: 2em;
              margin-bottom: 20px;
            }
          ';
        else
          $html.='
            table {
              width: 100%;
              margin-bottom: 20px;
              border-collapse: collapse;
              }
              #thanks{
                margin-top:20px;
                font-size: 2em;
                margin-bottom: 20px;
              }
          ';
        break;
    }

  }
  else{
  $html.='
      #details {
        margin-bottom: 20px;
      }
    
      .requisitos{
        display:inline-block;
        border: 6px solid #ccc;
        position: relative;
        color: #99A3A4;
        font-size: 14px;
        line-height: 20px;
        margin-bottom:30px;
        margin-top:30px !important;
      }
    
      .cuerpo {
        border: 6px solid #ccc;
        position: relative;
        color: #99A3A4;
        font-size: 14px;
        line-height: 20px;
        margin-bottom: 5px;
      }
      table th,
      table td {
        padding: 20px;
        background: #EEEEEE;
        text-align: center;
        height:10px !important;
        font-size: 18px !important;
        border-bottom: 5px solid #FFFFFF;
        border-right:5px solid #FFFFFF;
        border-left:5px solid #FFFFFF;
    	}
    	
      #thanks{
        margin-top:20px;
        font-size: 2em;
        margin-bottom: 20px;
       }
       table {
        width: 100%;
        page-break-after: always;
      }';
  }
  $html.='
  
  #client {
      padding-left: 6px;
      border-left: 6px solid #0087C3;
      float: left;
  }
  
  #client .to {
      color: #777777;
  }
  
  h2.name {
      font-size: 1.4em;
      font-weight: normal;
      margin: 0;
  }
  
  #invoice {
      width:100%;
      position: absolute;
      top:18%;
      left:60%
      float: right;
      text-align: right;
  }

  #invoice h2{
    font-size: 1.4em;
    font-weight: normal;

  }
  
  #invoice h1 {
      color: #0087C3;
      font-size: 31px;
      line-height: 1em;
      font-weight: normal;
      margin: 0 0 3px 0;
  }
  
  #invoice .date {
      font-size: 1.1em;
      color: #777777;
      margin-top: 0px;
  }
  
  #invoice h4 {
      margin-top: 5px;
      margin-bottom: 2px;
  }
  
  .product-title{
    color: #0087C3;
    font-size: 16pt;
    line-height: 1em;
    font-weight: normal;
    text-align:center;
    margin-top:40px;
    margin-bottom:15px;

  }
  
  #req .title {
      text-align: center;
      font-size: 20px;
      padding-left: 10px;
  }
  
  #req .content {
      font-size: 16px;
      padding-left:25px;
      padding-right:25px;
      text-align: justify;
  }
  
  #req .title-min {
      text-align: center;
      font-size: 15px;
      margin-bottom: 1px;
  }
  
  #req .content-min {
      font-size: 12.8px;
      padding: 5px 25px;
      text-align: justify;
  }
  
  table th {
      white-space: nowrap;
      font-weight: normal;
  }
  
  table td {
      text-align: center;
  }
  
  table td h3 {
      font-weight: normal;
      margin: 0 0 0.2em 0;
  }
  
  table .no {
      color: #FFFFFF;
      background: #57B223;
      text-align: center;
  }
  
  table .desc {
      text-align: center;
  }
  
  table .unit {
      background: #DDDDDD;
  }
  
  table .color {
      color: white !important;
      background: #4FC2F6;
  }
  
  table .color2 {
      color: black !important;
      background: #BBDEFB;
  }
  
  table .color-base {
      color: black !important;
      background: #D5DBDB;
  }
  
  table .qty {}
  
  table .total {
      background: #57B223;
      color: #FFFFFF;
  }
  
  table td.unit,
  table td.qty,
  table td.total {
      font-size: 1.2em;
  }
  
  /*table tbody tr:last-child td {
      border: none;
  }
  
  table tfoot td {
      padding: 10px 20px;
      background: #FFFFFF;
      border-bottom: none;
      font-size: 1.2em;
      white-space: nowrap;
      border-top: 1px solid #AAAAAA;
  }
  
  table tfoot tr:first-child td {
      border-top: none;
  }
  
  table tfoot tr:last-child td {
      color: #57B223;
      font-size: 1.4em;
      border-top: 1px solid #57B223;
  }
  
  table tfoot tr td:first-child {
      border: none;
  }*/
  
  /*#thanks{
    margin-top:40px;
    font-size: 2em;
    margin-bottom: 20px;
  }*/
  
  #notices {
      padding-left: 6px;
      border-left: 6px solid #0087C3;
  }
  
  #notices .notice {
      font-size: 1.2em;
  }
  
  .btn {
      margin:auto;
      width:200px;
      color: white !important;
      border: 0px;
      padding: 10px;
      font-size: 15px;
      border-radius: 20px;
      background-color: #EB984E;
      margin-top:1px;
      margin-bottom:5px;
  }
  
  footer {
    color: #777777;
    width: 100%;
    height: 5px;
    position: fixed;
    bottom:0;
    margin-top: 15px;
    border-top: 1px solid #AAAAAA;
    padding: 8px 0;
    text-align: center;
    vertical-align:middle;
}
footer img{
  width:150px;
  height:45px;
}
    </style>
  </head>
<body>
    <header class="clearfix">
        <div id="logo">
            <img src="http://hi-broker.com/wp-content/uploads/2021/07/pages-2.png">
            
        </div>
        
        <div id="company">
        
        
            <img src="'.$sp->obtenerImagen($_POST["producto"]).'">;
            
        </div>
        </div>
    </header>
    <footer>
      Cotizado por
      <img src="assets/img/logo_hibroker_gray.png">
      
    </footer>
    <main>
        <div id="details" class="clearfix">
            <div id="client">
                <h2 class="name">'.$_POST["nombres"].' '.$_POST["apellidos"].'</h2>';
                if($_POST["pais"]==1){
                  $html.='<div class="address">ESPAÑA</div>
                  <div class="address">Provincia: '.$_POST["nombre_provincia"].'</div>';               
        
                }
                else{
                  $html.='<div class="address">VENEZUELA</div>';
                }
                $html.='
                <div class="email"><a href="'.$_POST["email"].'">'.$_POST["email"].'</a></div>
                
                
            </div>
            <div id="invoice">
                <h1>COTIZACIÓN '.$numero_cotizacion.'</h1>
                <h2 class="name"><b>Mediador: '.$_COOKIE['nombre'].'</b> </h2>
                <div class="date">Fecha efecto: '.date("d-m-Y").'</div>';
                if($tomador)
                  $aux = $nroPersonas +1;
                $html.='
                <div class="date">Numero de Asegurados: '.$aux.' persona(s)</div>
            </div>
        </div>
        
        <div class="product-title">PRODUCTO: '.$_POST["producto"].'</div>
        <table border="0" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th class="no color-base">Edad/Asegurados</th>
                    <th class="desc color-base">Mensual</th>
                    <th class="unit color-base">Anual</th>
                    <!--<th class="qty">QUANTITY</th>
                    <th class="total">TOTAL</th>-->
                </tr>
            </thead>
            <tbody>
            ';
            $total_mensual=0;
            $total_anual=0;
           //-------------ESPAÑA--------------//
            IF ($_POST["pais"] == 1)
	    {
            if(isset($_POST["tomador"])  && !empty($_POST["tomador"])){
              //Este bloque solo trabaja al tomador a parte del resto
              $edad_tomador = calculaedad($_POST["fecha_nac"]); 
              $codigoProductoTomador = $_POST['codigoProducto'];
              $tempTomador= explode ("-", $codigoProductoTomador); 
              
                
              $monto_AnualTitular = $sp->montoFamiliaAnual($_POST["pais"],$_POST["provincia"],$edad_tomador ,$tempTomador[0] ,$tempTomador[1]);
              
              $mensual_total_titular =$_POST["mensual"];
             
             
              $anual_total_titular=$_POST["anual"];
              //echo "mensual_total_titular" . $mensual_total_titular. "</br>";
              if ($_POST["mensual"]>0){
                $html.='<tr>';
                $html.='<td class="no color">'.$edad_tomador.' A&ntilde;os </td>
                        <td class="desc color">'.number_format($_POST["mensual"],2,",","."). $currency.'</td>
                        <td class="unit color">'.number_format($monto_AnualTitular ,2,",","."). $currency.' </td>';
                $html.='</tr>';
              
              
				//Caso Promocion Sanitas para tomador
				if ($tempTomador[0] == 12)
				{
					if ($_POST["cant_familiares"] == 0){ //
					$html.='<tr>';
						 $html.='<td class="no color2">Incremento</td>
						  <td class="desc color2">'.number_format($_POST["mensual"]*0.08,2,",",".").$currency.'</td>
						  <td class="desc color2">'.number_format($monto_AnualTitular*0.08,2,",",".").$currency.' </td>';
						 $html.='</tr>';
						 
						 $html.='<tr>';
						 $html.='<td class="no color2">Total prima tomador</td>
						  <td class="desc color2">'.number_format($_POST["mensual"]*1.08,2,",",".").$currency.'</td>
						  <td class="desc color2">'.number_format($monto_AnualTitular*1.08,2,",",".").$currency.' </td>';
						 $html.='</tr>';
						$total_mensual = $mensual_total_titular;
					}
				}else{
			
			
				  $html.='<tr>';
				  $html.='<td class="no color2">Total prima tomador </td>
						  <td class="desc color2">'.number_format($mensual_total_titular,2,",",".").$currency.' </td>
						  <td class="unit color2">'.number_format($monto_AnualTitular ,2,",","."). $currency.'</td>';
				  $html.='</tr>';
				  $total_mensual = $mensual_total_titular;
				}
			  
              }
            }
            $mensual_total = $_POST["mensual"];
          
           $anual_total = 0;
            if(isset($_POST["cant_familiares"]) && !empty($_POST["cant_familiares"]) && $_POST["cant_familiares"]>0){
            
              $array=$_POST['fecha_nac_bene']; 
              $array=array_recibe($array);
              $productosList=unserialize(base64_decode($_POST['productosList']));
              $mensualList =unserialize(base64_decode($_POST['mensualList']));
          
              $codigoProducto = $_POST['codigoProducto'];
              
              foreach ($array as $indice => $valor){
              
	                if($valor!="" || $valor!=null){ 
	                  $edad = calculaedad($valor);
	                  $temp = explode ("-", $codigoProducto);  
	                  // echo "montoMensual " . $montoMensual . "</br>";
	                  $montoMensual = $sp->montoFamilia($_POST["pais"],$_POST["provincia"],$edad,$temp[0] ,$temp[1]);
	                  
	                   //echo "monto_FamiliaAnual" . $monto_FamiliaAnual. "</br>";
	                  if ($montoMensual>0){
	                  $monto_FamiliaAnual = $sp->montoFamiliaAnual($_POST["pais"],$_POST["provincia"],$edad,$temp[0] ,$temp[1]);
	                  
	                  
	                  
	                  $mensual_total += $montoMensual;
	                  $anual_total = $monto_FamiliaAnual;
	                  
	                  $html.='<tr>';
	                  $html.='<td class="no color">'.$edad.' A&ntilde;os </td>
	                          <td class="desc color">'.number_format($montoMensual,2,",","."). $currency.' </td>
	                          <td class="unit color">'.number_format($anual_total ,2,",",".").$currency.' </td>';
	                  $html.='</tr>';
	                  }
	                }
                
              } 
	
	      if ($temp[0] == 12)//Solo Sanitas
	      {
	         if ($_POST["cant_familiares"] == 1 && empty($_POST["tomador"])) // multiplicar 0.08, descuento mes y año y para la prima total multiplicar por 1.08
	          {
	             $html.='<tr>';
             	     $html.='<td class="no color2">Incremento</td>
                      <td class="desc color2">'.number_format($mensual_total*0.08,2,",",".").$currency.'</td>
                      <td class="desc color2">'.number_format($anual_total_titular*0.08,2,",",".").$currency.' </td>';
                     $html.='</tr>';
                     
                     $html.='<tr>';
              	     $html.='<td class="no color2">Total prima </td>
                      <td class="desc color2">'.number_format($mensual_total*1.08,2,",",".").$currency.'</td>
                      <td class="desc color2">'.number_format($anual_total_titular*1.08,2,",",".").$currency.' </td>';
                     $html.='</tr>';
                     $total_mensual = $mensual_total;
                     
	          }
	         else ///multiplicar 0.10 el calculo del descuento y mes año por 0.90
	          {//Aplica para 4 familiares sin tomador y 3 familiares con tomador 
				if (($_POST["cant_familiares"] == 4 && empty($_POST["tomador"])) || ($_POST["cant_familiares"] == 3 && !empty($_POST["tomador"])))
				{
	             $html.='<tr>';
                   $html.='<td class="no color2">Descuento</td>
                      <td class="desc color2">'.number_format($mensual_total*0.10,2,",",".").$currency.'</td>
                      <td class="desc color2">'.number_format($anual_total_titular*0.10,2,",",".").$currency.' </td>';
                     $html.='</tr>';
                     
                     $html.='<tr>';
              	     $html.='<td class="no color2">Total prima </td>
                      <td class="desc color2">'.number_format($mensual_total*0.90,2,",",".").$currency.'</td>
                      <td class="desc color2">'.number_format($anual_total_titular*0.90,2,",",".").$currency.' </td>';
                     $html.='</tr>';
                     $total_mensual = $mensual_total;
				}
	          }         
	          
	          
	          
	      }else{
          
              $html.='<tr>';
              $html.='<td class="no color2">Total prima </td>
                      <td class="desc color2">'.number_format($mensual_total,2,",",".").$currency.'</td>
                      <td class="desc color2">'.number_format($anual_total_titular,2,",",".").$currency.' </td>';
              $html.='</tr>';
              $total_mensual = $mensual_total;
              }
              
            }
			
          }
		
           //--------VENEZUELA------//
	   if ($_POST["pais"] == 2)
           {
            if(isset($_POST["tomador"])  && !empty($_POST["tomador"])){
              $edad_tomador = calculaedad($_POST["fecha_nac"]); 
              $codigoProductoTomador = $_POST['codigoProducto'];
              $tempTomador= explode ("-", $codigoProductoTomador); 
              
                
              $monto_AnualTitular = $sp->montoFamiliaAnual($_POST["pais"],$_POST["provincia"],$edad_tomador ,$tempTomador[0] ,$tempTomador[1]);
              
              $mensual_total_titular =$_POST["mensual"];
             
             
              $anual_total_titular=$_POST["anual"];
              //echo "mensual_total_titular" . $mensual_total_titular. "</br>";
              
                $html.='<tr>';
                $html.='<td class="no color">'.$edad_tomador.' A&ntilde;os </td>
                        <td class="desc color">'.number_format($_POST["mensual"],2,",","."). $currency.'</td>
                        <td class="unit color">'.number_format($monto_AnualTitular ,2,",","."). $currency.' </td>';
                $html.='</tr>';
              
            
              $html.='<tr>';
              $html.='<td class="no color2">Total prima tomador </td>
                      <td class="desc color2">'.number_format($mensual_total_titular,2,",",".").$currency.' </td>
                      <td class="unit color2">'.number_format($monto_AnualTitular ,2,",","."). $currency.'</td>';
              $html.='</tr>';
              $total_mensual = $mensual_total_titular;
              
            }
            $mensual_total = $_POST["mensual"];
           // $anual_total = $_POST["anual"];
           $anual_total = 0;
            if(isset($_POST["cant_familiares"]) && !empty($_POST["cant_familiares"]) && $_POST["cant_familiares"]>0){
            
              $array=$_POST['fecha_nac_bene']; 
              $array=array_recibe($array);
              $productosList=unserialize(base64_decode($_POST['productosList']));
              $mensualList =unserialize(base64_decode($_POST['mensualList']));
          
              $codigoProducto = $_POST['codigoProducto'];
              //var_dump($productosList);
              //var_dump($mensualList);
              foreach ($array as $indice => $valor){
              
	                if($valor!="" || $valor!=null){ 
	                  $edad = calculaedad($valor);
	                  $temp = explode ("-", $codigoProducto);  
	                  // echo "montoMensual " . $montoMensual . "</br>";
	                  $montoMensual = $sp->montoFamilia($_POST["pais"],$_POST["provincia"],$edad,$temp[0] ,$temp[1]);
	                  
	                  $monto_FamiliaAnual = $sp->montoFamiliaAnual($_POST["pais"],$_POST["provincia"],$edad,$temp[0] ,$temp[1]);
	                  $mensual_total += $montoMensual;
	                  $anual_total = $monto_FamiliaAnual;
	                  
	                  $html.='<tr>';
	                  $html.='<td class="no color">'.$edad.' A&ntilde;os </td>
	                          <td class="desc color">'.number_format($montoMensual,2,",","."). $currency.' </td>
	                          <td class="unit color">'.number_format($anual_total,2,",",".").$currency.' </td>';
	                  $html.='</tr>';
	                  
	                }
                
              } 
			
                       
          
              $html.='<tr>';
              $html.='<td class="no color2">Total prima </td>
                      <td class="desc color2">'.number_format($mensual_total,2,",",".").$currency.'</td>
                      <td class="desc color2">'.number_format($anual_total_titular,2,",",".").$currency.' </td>';
              $html.='</tr>';
              $total_mensual = $mensual_total;
              $total_anual_total = $anual_total_titular;
            }
			
		}
		 
		 
            $descripcion = $sp->traerDescripcion($_POST["producto"]);
            if($row = $descripcion->num_rows > 0)
              while($res = $descripcion->fetch_row())
                $value= $res[0];
            $html.='
            </tbody>
        </table>
        <div>
         <button class="btn"><a href="https://hi-broker.com/enviarCorreo.php?code='.$numero_cotizacion.'&nombre='.$_POST["nombres"].' '.$_POST["apellidos"].'&email='.$_POST["email"].'&descripcion='.$value.'&categoria='.$categoria.'&asegurados='.$aux.'&mensual='.$total_mensual.'&telefono='.$telefono.'&moneda='.$currency.'&ruta='.$path.'&url='.$url.'&producto='.$_POST["producto"].'&correo='.$correo.'&anual='.$anual_total_titular.'">ENVIAR POR CORREO</a></button>       
               
        </div>
        <div id="descripcion" class="descripcion">
          <p class="title">¿Qué cubre el seguro?</p>
          <p class="content">'.$value.'</p>
        </div>
        <div id="req" class="requisitos">
          <p class="title">Requisitos para emitir póliza</p>
          <p class="content">Completar solicitud y cuestionario médico, documento de identidad pasaporte, DNI, NIE u otro, Cuenta bancaria o TDC Internacional.</p>
        </div>
        <div id="thanks">Gracias!

        </div>

        <div id="req" class="cuerpo">
            <p class="title-min">AVISO LEGAL</p>
            <p class="content-min">En virtud de lo dispuesto en el Reglamento (UE) 2016/679 del Parlamento Europeo y del Consejo de 27 de abril de 2016 relativo a la protección de las personas físicas en lo que respecta al tratamiento de datos personales, ROSE & PAGÉS, S.L.
                le informa que sus datos personales incorporados en este formulario, serán incluidos en un fichero creado bajo nuestra responsabilidad, con la finalidad de comunicarnos con usted para llevar a cabo el mantenimiento y control de la relación
                de negocio que nos vincula Según el Reglamento (UE) 2016/679 de 27 de abril de 2016, puede ejercitar los derechos de acceso, rectificación, oposición y supresión dirigiéndose por escrito a ROSE & PAGÉS, S.L., Hermosilla, nº 80 - 2º A.
                28001 Madrid, o al correo electrónico oquijada@rose-pages.com..
            </p>
        </div>';
        $check = False;
        $query= $sp->traerRuta($_POST["producto"],$check);
        if($row = $query->num_rows > 0){
          while($res = $query->fetch_row())
            $url= $res[0];
        }
        $check = true;
        $query= $sp->traerRuta($_POST["producto"],$check);
        if($row = $query->num_rows > 0){
          while($res = $query->fetch_row())
            $path= $res[0]; 
        } 
        $query= $sp->traerDatos($_COOKIE["idMediador"]);
        if($row = $query->num_rows > 0)
          while($res = $query->fetch_row()){
            $telefono= $res[0];
            $correo = $res[1];
          }
        
        
        
        //-------ESPAÑA--------
        if ($_POST["pais"] == 1)
           {
        $html.='
        <p><p><button class="btn"><a href="https://hi-broker.com/enviarCorreo.php?code='.$numero_cotizacion.'&nombre='.$_POST["nombres"].' '.$_POST["apellidos"].'&email='.$_POST["email"].'&descripcion='.$value.'&categoria='.$categoria.'&asegurados='.$aux.'&mensual='.$total_mensual.'&telefono='.$telefono.'&moneda='.$currency.'&ruta='.$path.'&url='.$url.'&producto='.$_POST["producto"].'&correo='.$correo.'&anual='.$anual_total_titular.'">ENVIAR POR CORREO</a></button></p></p>
        </main></body></html>';
        }
        
        //-------VENEZUELA-----
         if ($_POST["pais"] == 2)
       {
        $html.='
        <p><p><button class="btn"><a href="https://hi-broker.com/enviarCorreo.php?code='.$numero_cotizacion.'&nombre='.$_POST["nombres"].' '.$_POST["apellidos"].'&email='.$_POST["email"].'&descripcion='.$value.'&categoria='.$categoria.'&asegurados='.$aux.'&mensual='.$total_mensual.'&telefono='.$telefono.'&moneda='.$currency.'&ruta='.$path.'&url='.$url.'&producto='.$_POST["producto"].'&correo='.$correo.'&anual='.$anual_total_titular.'&nombrepdf='.$numero_cotizacion.'".pdf">ENVIAR POR CORREO</a></button></p></p>
        </main></body></html>';
        }
        


//var_dump($html);

  $dompdf = new DOMPDF();
  $dompdf->set_option('enable_html5_parser', TRUE);
  //$dompdf->set_option('enable_css_float', true);
  $dompdf->set_paper("a4");
  $dompdf->load_html($html);
  $dompdf->render();
  
  //$dompdf->set_option( 'isRemoteEnabled', true );
  //$dompdf->set_paper("a4","portrait");

  //Enviar correo con cotización
if(isset($_POST["producto"])  && !empty($_POST["producto"])
  && isset($_POST["movil"])  && !empty($_POST["movil"])
    && isset($_POST["email"])  && !empty($_POST["email"])
      && isset($_POST["nombres"])  && !empty($_POST["nombres"])
      && isset($_POST["apellidos"])  && !empty($_POST["apellidos"])
      && isset($_POST["cant_familiares"]) 
      && isset($_POST["numero_cotizacion"])  && !empty($_POST["numero_cotizacion"]) /*&& isset($_COOKIE['nombre'])*/){

  $nombre = $_POST["nombres"].' '.$_POST["apellidos"];
  $email = $_POST["email"];
  $producto = $_POST["producto"];

  $result = $sp->traerAmbitoTerritorial($producto);
  if($row = $result->num_rows > 0)
      while($res = $result->fetch_row())
          $ambito= $res[0];
  
  $result = $sp->traerTrayectoria($producto);
  if($row = $result->num_rows > 0)
      while($res = $result->fetch_row())
          $trayectoria= $res[0];
          
  $show_cot = true;
          
  $enviar_cot = $sp->enviarCorreo($numero_cotizacion,$nombre,$email,$value,$categoria,$aux,$total_mensual,$telefono,$currency,$ambito,$trayectoria,$path,$url,$producto,$correo, $anual_total_titular,$numero_cotizacion,$show_cot);
}

  if (isset($_POST["button1"]))
    $val = 0;
  else if(isset($_POST["button2"])){
    $val = 1;
    //echo 'EN CONSTRUCCION';
    $check = true;
    $file= $sp->traerRuta($_POST["producto"],$check);
    if($row = $file->num_rows > 0){
      while($res = $file->fetch_row())
        $valor= $res[0];
        //var_dump($valor);
        @header("Location: $valor");
      
    }
  }
  else if(isset($_POST["button3"])){
    $val = 1;
    $check = false;
    $file= $sp->traerRuta($_POST["producto"],$check);
    if($row = $file->num_rows > 0){
      while($res = $file->fetch_row())
        $valor= $res[0];
    }
    if(!empty($valor)){
      ?>
      <script type="text/javascript">
        window.location.href= <?php echo "'" . $valor. "'"; ?>;
      </script>
      <?php
    }
    else{
      echo "PAGE NOT FOUND";
    }
  }
  else if (isset($_POST["button4"])) {
    $val = 0;

    $url = "https://hi-broker.com/formulario.php?";

    $url = $url.'nombre='.$_POST["nombres"].'&apellido1='.$_POST["apellidos"].'&fecha_nac='.$_POST["fecha_nac"].'&movil='.$_POST["movil"].'&email='.$_POST["email"].'&cant_familiares='.$_POST["cant_familiares"].'&numero_cotizacion='.$_POST["numero_cotizacion"].'&nombre_pais='.$_POST["nombre_pais"].'&producto='.$_POST["producto"].'&anual='.$_POST["anual"].'&mensual='.$_POST["mensual"].'&categoria='.$_POST["categoria"];

    header("Location: ".$url);
  }
  
  
  if(!$val)
    $dompdf->stream("cotizacion_".$numero_cotizacion.".pdf", array("Attachment" => $val));
  
 


  //$dompdf->stream("Historial ".$_POST["nombre"].".pdf");
?>