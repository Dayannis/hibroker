<?php

  error_reporting(0);
  header("Content-Type: text/html;charset=utf-8");

  require_once("dompdf/dompdf_config.inc.php");
  require_once("sp.php");
  require("mail/class.phpmailer.php");
  require("mail/class.smtp.php");

  $sp = new Sp();
  ini_set('memory_limit', '2048M'); // or you could use 1G
  ini_set('max_execution_time', 1800);

  $html = '<!DOCTYPE html>
  <html lang="en">
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <title>Planilla</title>
      <style>
        /*@font-face {
          font-family: SourceSansPro;
          src: url(SourceSansPro-Regular.ttf);
        }/*

        .clearfix:after {
          content: "";
          /*display: table;*/
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
          /*font-family: Arial, sans-serif; */
          font-size: 14px; 
          /*font-family: SourceSansPro;*/
        }

        header {
          padding: 10px 0;
          margin-bottom: 20px;
          border-bottom: 1px solid #cfcfcf;
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


        #details {
          margin-bottom: 50px;
        }

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
          float: right;
          text-align: right;
        }

        #invoice h1 {
          color: #0087C3;
          font-size: 2.4em;
          line-height: 1em;
          font-weight: normal;
          margin: 0  0 10px 0;
        }

        #invoice .date {
          font-size: 1.1em;
          color: #777777;
        }

        table {
          width: 100%;
          border-collapse: collapse;
          border-spacing: 0;
          margin-bottom: 20px;
        }

        table th,
        table td {
          padding: 10px;
          background: #EEEEEE;
          text-align: center;
          border-bottom: 1px solid #FFFFFF;
        }

        table th {
          white-space: nowrap;        
          font-weight: normal;
        }

        table td {
          text-align: right;
        }

        table td h3{
          color: #4FC2F6;
          font-size: 1.2em;
          font-weight: normal;
          margin: 0 0 0.2em 0;
        }

        table .no {
          color: #FFFFFF;
          font-size: 1.6em;
          background: #4FC2F6;
          text-align: center;
        }

        table .desc {
          text-align: left;
        }

        table .unit {
          background: #DDDDDD;
        }

        table .qty {
        }

        table .total {
          background: #4FC2F6;
          color: #FFFFFF;
        }

        table td.unit,
        table td.qty,
        table td.total {
          font-size: 1.2em;
        }

        table tbody tr:last-child td {
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
          color: #4FC2F6;
          font-size: 1.4em;
          border-top: 1px solid #4FC2F6; 

        }

        table tfoot tr td:first-child {
          border: none;
        }

        #thanks{
          font-size: 2em;
          margin-bottom: 50px;
        }

        #notices{
          padding-left: 6px;
          border-left: 6px solid #0087C3;  
        }

        #notices .notice {
          font-size: 1.2em;
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

        .product-title{
          color: #0087C3;
          font-size: 16pt;
          line-height: 1em;
          font-weight: normal;
          text-align:center;
          margin-top:40px;
          margin-bottom:15px;

        }

      </style>
    </head>
    <body>
      <header class="clearfix">
        <div id="logo">
          <img src="https://pages.hi-broker.com/wp-content/uploads/2021/03/pages-2.png">
        </div>
        <div id="company">
            <img src="'.$sp->obtenerImagen($_POST["producto"]).'">            
        </div>
      </header>
    <footer>
      Cotizado por
      <img src="assets/img/logo_hibroker_gray.png">
      
    </footer>
      <main>
        <div id="details" class="clearfix">
          <div id="client">
            <h2 class="name">'.$_POST["nombre"].' '.$_POST["apellido1"].' '.$_POST["apellido2"].'</h2>';
            $html.='<div class="to">VENEZUELA</div>';
            $html.='<div class="email"><a href="mailto:'.$_POST["email"].'">'.$_POST["email"].'</a></div>
          </div>
          <div id="invoice">
            <h1>COTIZACIÓN '.$_POST["num_cot"].'</h1>
                  <h2 class="name"><b>Mediador: '.$_COOKIE['nombre'].'</b></h2>
            <div class="date">Fecha efecto: '.date("d-m-Y").'</div>
          </div>
        </div>

        <table border="0" cellspacing="0" cellpadding="0">
          <thead>
            <tr>
              <th class="no">Producto</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="desc"><h3>'.$_POST["producto"].'</h3>
              </td>
            </tr>
          </tbody>
        </table>

        <table border="0" cellspacing="0" cellpadding="0">
          <thead>
            <tr>
              <th class="no">Datos del asegurado principal (Titular de la Póliza)</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="desc">
                Nombre: '.$_POST["nombre"].' '.$_POST["apellido1"].' '.$_POST["apellido2"].'
                Tipo de Documento de Identidad: '.$_POST["documento_identidad"].'<br>
                Número Documento de Identidad: '.$_POST["no_documento_identidad"].'<br>
                Sexo: '.$_POST["sexo"].'<br>
                Peso (kg): '.$_POST["peso"].'<br>
                Altura (cm): '.$_POST["altura"].'<br> 
                Fecha de nacimiento: '.$_POST["fecha_nacimiento"].'<br>
                Teléfono móvil: '.$_POST["movil"].'<br>
                Teléfono fijo: '.$_POST["telefono_fijo"].'<br>
                Correo electrónico: '.$_POST["email"].'<br>
                Dirección: '.$_POST["direccion"].'<br>
                Número: '.$_POST["numero"].'<br>
                Calle, número, piso, puerta, Bloque, Esc (Dirección de residencia en España): '.$_POST["tipo_numero"].'<br>
                Código Postal: '.$_POST["codigo_postal"].'<br>
                Municipio: '.$_POST["municipio"].'<br>
              </td>
            </tr>
          </tbody>
        </table>
        <div style="page-break-after:always;"></div>';

        if ($_POST["cant_familiares"] > 0) {          
            $html.='
            <table border="0" cellspacing="0" cellpadding="0">
              <thead>
                <tr>
                  <th class="no">Datos de los asegurados adicionales</th>
                </tr>
              </thead>
              <tbody>
                ';
                  for ($i=0; $i < $_POST["cant_familiares"]; $i++) {
                    $html.='
                    <tr>
                      <td class="desc">
                        Nombre: '.$_POST["nombre_asegurado_".$i].' '.$_POST["apellido1_asegurado_".$i].' '.$_POST["apellido2_asegurado_".$i].'
                        Parentesco con el asegurado principal: '.$_POST["parentesco_asegurado_".$i].'<br>
                        Tipo de Documento de Identidad: '.$_POST["documento_identidad_asegurado_".$i].'<br>
                        Número Documento de Identidad: '.$_POST["no_documento_identidad_asegurado_".$i].'<br>
                        Sexo: '.$_POST["sexo_asegurado_".$i].'<br>
                        Peso (kg): '.$_POST["peso_asegurado_".$i].'<br>
                        Altura (cm): '.$_POST["altura_asegurado_".$i].'<br> 
                        Fecha de nacimiento: '.$_POST["fecha_nacimiento_asegurado_".$i].'<br>
                      </td>
                    </tr>';
                  }
                $html.='
                
              </tbody>
            </table>
            <div style="page-break-after:always;"></div>';
        }

        $html.='
        <table border="0" cellspacing="0" cellpadding="0">
          <thead>
            <tr>
              <th class="no">Cuestionario de salud</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="desc">
                <h3>Asegurado Principal</h3>
                1. ¿Padece o ha padecido de alguna enfermedad o ha sufrido un accidente en los últimos cinco años que haya precisado de un tratamiento médico?: <strong>'.$_POST["enfermedad_accidente"].'</strong><br>';

                if ($_POST["enfermedad_accidente"] == "Si") {
                  $html.= 'Detalles: '.$_POST["detalles_enfermedad_accidente_principal"].'<br><br>';
                }

                $html.='
                2. ¿Ha estado alguna vez o tiene previsto ser hospitalizado y/o intervenido quirúrgicamente?: <strong>'.$_POST["hospitalizado"].'</strong><br>';

                if ($_POST["hospitalizado"] == "Si") {
                  $html.= 'Detalles: '.$_POST["detalles_hospitalizado_principal"].'<br><br>';
                }

                $html.='
                3. ¿Se encuentra actualmente bajo tratamiento médico?: <strong>'.$_POST["tratamiento_actual"].'</strong><br>';

                if ($_POST["tratamiento_actual"] == "Si") {
                  $html.= 'Detalles: '.$_POST["detalles_tratamiento_actual_principal"].'<br><br>';
                }

                $html.='
                4. ¿Tiene algún síntoma o dolor, no diagnosticado y manifestado de forma continuada o reiterada?: <strong>'.$_POST["sintoma_actual"].'</strong><br>';

                if ($_POST["sintoma_actual"] == "Si") {
                  $html.= 'Detalles: '.$_POST["detalles_sintoma_actual_principal"].'<br><br>';
                }

              $html.='
              </td>
            </tr>';

              if ($_POST["cant_familiares"] > 0) {
                for ($i=0; $i < $_POST["cant_familiares"]; $i++) {
                  $html.='
                  <tr>         
                    <td class="desc">
                      <h3>Asegurado Adicional: </h3>
                      1. ¿Padece o ha padecido de alguna enfermedad o ha sufrido un accidente en los últimos cinco años que haya precisado de un tratamiento médico?: <strong>'.$_POST["enfermedad_accidente_asegurado_".$i].'</strong><br>';

                      if ($_POST["enfermedad_accidente_asegurado_".$i] == "Si") {
                        $html.='Detalles: '.$_POST["detalles_enfermedad_accidente_asegurado_".$i].'<br><br>';
                      }

                      $html.='
                      2. ¿Ha estado alguna vez o tiene previsto ser hospitalizado y/o intervenido quirúrgicamente?: <strong>'.$_POST["hospitalizado_asegurado_".$i].'</strong><br>';

                      if ($_POST["hospitalizado_asegurado_".$i] == "Si") {
                        $html.='Detalles: '.$_POST["detalles_hospitalizado_asegurado_".$i].'<br><br>';
                      }

                      $html.='
                      3. ¿Se encuentra actualmente bajo tratamiento médico?: <strong>'.$_POST["tratamiento_actual_asegurado_".$i].'</strong><br>';

                      if ($_POST["tratamiento_actual_asegurado_".$i] == "Si") {
                        $html.='Detalles: '.$_POST["detalles_tratamiento_actual_asegurado_".$i].'<br><br>';
                      }

                      $html.='
                      4. ¿Tiene algún síntoma o dolor, no diagnosticado y manifestado de forma continuada o reiterada?: <strong>'.$_POST["sintoma_actual_asegurado_".$i].'</strong><br>';

                      if ($_POST["sintoma_actual_asegurado_".$i] == "Si") {
                        $html.='Detalles: '.$_POST["detalles_sintoma_actual_asegurado_".$i].'<br><br>';
                      }

                  $html.='
                    </td>
                  </tr>';
                }
              }

            $html.='            
          </tbody>
        </table>
        <div style="page-break-after:always;"></div>';

        $html.='
        <table border="0" cellspacing="0" cellpadding="0">
          <thead>
            <tr>
              <th class="no">Datos del tomador</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="desc">
                ¿El titular asegurado es el tomador de la póliza?: '.$_POST["asegurado_tomador"].'<br><br>';

                if ($_POST["asegurado_tomador"] == 'No') {
                  
                  $html.='
                  Nombre: '.$_POST["nombre_tomador"].' '.$_POST["apellido1_tomador"].' '.$_POST["apellido2_tomador"].'<br>
                  Tipo de Documento de Identidad: '.$_POST["documento_identidad_tomador"].'<br>
                  Número Documento de Identidad: '.$_POST["no_documento_identidad_tomador"].'<br>
                  Fecha de nacimiento: '.$_POST["fecha_nacimiento_tomador"].'<br>
                  Teléfono móvil: '.$_POST["movil_tomador"].'<br>
                  Teléfono fijo: '.$_POST["telefono_fijo_tomador"].'<br>
                  Correo electrónico: '.$_POST["email_tomador"].'<br>
                  Dirección: '.$_POST["direccion_tomador"].'<br>
                  Número: '.$_POST["numero_tomador"].'<br>
                  Calle, número, piso, puerta, Bloque, Esc (Dirección de residencia en España): '.$_POST["tipo_numero_tomador"].'<br>
                  Código Postal: '.$_POST["codigo_postal_tomador"].'<br>
                  Municipio: '.$_POST["municipio_tomador"].'<br><br>';
                }

                $html.='
                Desea recibir la información de alta en otra dirección distina a las indicadas anteriormente? '.$_POST["otra_direccion"].'<br><br>';

                if ($_POST["otra_direccion"] == 'Si') {
                  $html.='
                  Dirección: '.$_POST["direccion_informacion"].'<br>
                  Número: '.$_POST["numero_informacion"].'<br>
                  Calle, número, piso, puerta, Bloque, Esc (Dirección de residencia en España): '.$_POST["tipo_numero_informacion"].'<br>
                  Código Postal: '.$_POST["codigo_postal_informacion"].'<br>
                  Municipio: '.$_POST["municipio_informacion"].'<br>';
                }

                $html.='
              </td>
            </tr>
          </tbody>
        </table>

        <table border="0" cellspacing="0" cellpadding="0">
          <thead>
            <tr>
              <th class="no">Método de Pago</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="desc">
                Fecha de inicio de la póliza: '.$_POST["inicio_poliza"].'<br>';                
                if ($_POST["metodo_pago"] == 'Cuenta') {
                  $html.='Método de pago: Cuenta Bancaria <br>
                  IBAN: '.$_POST["iban"].'<br>';
                }
                else if ($_POST["metodo_pago"] == 'Tarjeta') {
                  $html.='Método de pago: Tarjeta de Débito/Crédito <br>';
                }
              $html.='</td>
            </tr>
          </tbody>
        </table>

        <div style="page-break-after:always;"></div>';
        

        $html.='
        <table border="0" cellspacing="0" cellpadding="0">
          <thead>
            <tr>
              <th class="no">Tratamiento de datos Personales</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="desc">
                <p>La falta de aceptación de los tratamientos que se incluyen a continuación no condiciona la solicitud o el contrato de seguro con Sanitas. Salvo que indique lo contrario marcando alguna de las siguientes opciones, con la firma de la presente cláusula el Solicitante consiente que SANITAS pueda realizar cada uno de los siguientes tratamientos sobre los Datos Personales de los interesados, incluidos datos personales de salud: </p>

                <p>Consiento el tratamiento de mis datos personales para finalidades promocionales de productos y servicios de Sanitas o de terceras empresas, incluyendo el envío por medios electrónicos de comunicaciones comerciales o equivalentes por parte de Sanitas, incluso aunque no llegue a contratar: <trong>'.$_POST["promociones"].'</strong></p>

                <p>Consiento la cesión y el tratamiento de mis datos personales por las entidades del grupo de Sanitas con fines de investigación cientifica y/o estadistica y fines comerciales, así como de las terceras empresas colaboradoras identificadas en la Información Adicional con la finalidad de remitirme información comercial relacionada con productos y servicios financieros, seguros, servicios socio-sanitarios y/o de salud o bienestar, incluyendo el envio de comunicaciones comerciales por medios electrónicos: <trong>'.$_POST["terceros"].'</strong></p>

                <p>Consiento el tratamiento de mis datos personales con el fin de que Sanitas lleve a cabo un análisis de mis intereses y necesidades con base en los datos proporcionados por mi incluyendo pero sin limitarse a mis datos de salud, aquellos datos personales que se hayan generado como consecuencia del servicio prestado por Sanitas o que haya obtenido Sanitas por otros medios, pudiendo incluir dicho tratamiento la toma de decisiones automatizadas: <trong>'.$_POST["automatizacion"].'</strong></p>
              </td>
            </tr>
          </tbody>
        </table>
    </body>
  </html>
  ';

  $dompdf = new DOMPDF();
  $dompdf->set_option('enable_html5_parser', true);
  $dompdf->set_paper("a4");
  $dompdf->load_html($html);
  $dompdf->render();
  
  file_put_contents("formularios/formulario_cotizacion_".$_POST["num_cot"]."_".$_POST["apellido1"]."_".$_POST["nombre"].".pdf", $dompdf->output());
  //$dompdf->stream("formularios/formulario_cotizacion_".$_POST['num_cot'].".pdf");

  $para   = $_POST["email"];
  $nombre = $_POST["nombre"].' '.$_POST["apellido1"];
  $asegurados = $_POST["cant_familiares"];
  $producto = $_POST["producto"];
  $mensaje = '<!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
      <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin">
      <style>
          body {
              font-family: Ubuntu !important;
          }
          @media (max-width: 480px) {
              #logo img{
                  width: 200px;
                  height:85px;
                  vertical-aling:top;
              }
              #contact{
                  display: table;
                  text-align: center;
                  float: right;
                  padding-top:27px;
              }
              #contact h4{
                  width: 160px;
              }
              #contact p{
                  font-size:10pt;
                  display: table-cell;
                  vertical-align: middle;
                  line-height:20px;
              }
              #contact img{
                  widht:26px;
                  height:26px;
              }
              #container{
                  display: flex;
                  padding:7px;
              }
              #container .col{
                  flex:1;
                  text-align: center;
                  margin:5px;
              }
              #container img{
                  float: left;
                  padding-top:3px;
                  padding-bottom:3px;
                  margin-right:4px;
              }
              #container .image1{
                  display: block;
                  width:26px;
                  height:26px;
              }
              #container .image2{
                  display: none;
              }
              #container p{
                  font-weight: bold; 
                  text-align:right;
                  color:white;
                  font-size:7.5pt; 
              }
              #flexrow{
                  font-weight: bold; 
                  display:flex;
              }
              #flexrow .flexcol-1{
                  flex:1;
                  margin-right:55px; 
                  font-size:14pt;
              }
              #flexrow .flexcol-2{
                  flex:1;
                  font-size:14pt;
                  padding-left:33px;
              }
              #info table td {
                  padding: 20px;
                  background: #EEEEEE;
                  text-align: center;
                  height:10px !important;
                  font-size: 18px !important;
                  border-bottom: 5px solid #FFFFFF;
                  border-right:5px solid #FFFFFF;
                  border-left:5px solid #FFFFFF;
              }
              table .no {
                  color: #FFFFFF;
                  background: #57B223;
                  text-align: center;
              }
                
              table .desc {
                  text-align: center;
              }  
              table .color2 {
                  color: black !important;
                  background: #BBDEFB;
              }
    
              #info  td{
                  padding: 10px;
                  text-align: center;
                  border-bottom: 5px solid #FFFFFF;
                  border-right:5px solid #FFFFFF;
                  border-left:5px solid #FFFFFF;
              }
              
          }
          @media (min-width: 600px) {
              #logo{
                  width:300px;
              }
              #logo img{
                  width: 270px;
                  height:113px;
              }
              
              #contact{
                  width:300px;
              }
              #contact h4{
                  float: right;
              }
              #contact p{
                  font-size:11pt;
              }
              #container{
                  display: flex;
                  padding:5px;
              }
              #container .col{
                  flex:1;
                  text-align: center;
                  margin:38px;
              }
              #container img{
                  float: left;
                  margin-top: 9px; 
                  margin-right: 5px; 
                  padding-left: 5px;
              }
              #container .image1{
                  display: block;
              }
              #container .image2{
                  display: none;
              }
              #container p{
                  font-weight: bold; 
                  text-align:center;
                  color:white;
                  font-size:10.5pt; 
                  padding: 2px 5px 2px 5px;
              }
              #flexrow{
                  display:flex;
                  font-weight:bold;
              }
              #flexrow .flexcol-1{
                  width:100%;
                  flex:1;
                  margin-right:35px; 
                  font-size:14pt;
              }
              #flexrow .flexcol-2{
                  width:100%;
                  flex:1;
                  font-size:14pt;
              }
              #info table td {
                  padding: 20px;
                  background: #EEEEEE;
                  text-align: center;
                  height:10px !important;
                  font-size: 18px !important;
                  border-bottom: 5px solid #FFFFFF;
                  border-right:5px solid #FFFFFF;
                  border-left:5px solid #FFFFFF;
              }
              table .no {
                  color: #FFFFFF;
                  background: #57B223;
                  text-align: center;
              }
                
              table .desc {
                  text-align: center;
              }
    
              table .color2 {
                  color: black !important;
                  background: #BBDEFB;
              }
    
              #info  td{
                  padding: 10px;
                  text-align: center;
                  border-bottom: 5px solid #FFFFFF;
                  border-right:5px solid #FFFFFF;
                  border-left:5px solid #FFFFFF;
              }
          }
      </style>
  </head>
  <body>
      <div>
          <div align="center">
              <table border="0" cellspacing="0" cellpadding="0" width="600" style="margin-top:15px;">
                  <tbody>
                      <tr>
                          <td>
                              <table border="0" cellspacing="0" cellpadding="0">
                                  <tbody>
                                      <tr>
                                          <td style="width:80px">
                                              <a href="http://pages.hi-broker.com/" target="_blank">
                                                  <img src="http://pages.hi-broker.com/wp-content/uploads/2021/03/pages-2.png" width="110px" height="90px" alt="Rose & Pages">
                                              </a>
                                          </td>
                                          <td id="contact" style="text-align:right; width:520px">
                                              <h4 style="background-color: #4228B4; float: right; color: white; border-radius: 12px; margin: auto;">
                                                  <img style="padding: 13px 5px 7px 10px; float:left;" src="http://pages.hi-broker.com/assets/icons/phone_26px.png" alt="">
                                                  <p style="float: right; padding-right:10px ;" >+34 690 681 261</p>
                                              </h4>
                                          </td>
                                      </tr>
                                  </tbody>
                              </table>
                          </td>
                      </tr>
                      <tr>
                          <td>
                              <table border="0" cellspacing="0" cellpadding="0">
                                  <tbody>
                                      <tr>
                                          <td style="width:600px">
                                              <p style="text-align:left;margin-bottom:20px;margin-top:20px;font-weight:bold;font-size:18pt;color:#3D9FF2">Hola, <b style="text-transform: uppercase;">'.$nombre.'</b></p>
                                          </td>
                                      </tr>
                                  </tbody>
                              </table>
                          </td>
                      </tr>
                      <tr style="background:#ffc1c1">
                          <td>
                              <table border="0" cellspacing="0" cellpadding="0">
                                  <tbody>
                                      <tr style="background:#5271FF">
                                          <td>
                                              <p style="margin:10px;text-align:justify;font-size:11pt;color:white;padding: 2px 7px 2px 7px;">
                                                  A continuación te adjuntamos el formulario de solicitud de tu seguro <b>('.$producto.') de salud para ('.$asegurados.') asegurado(s).</b>
                                                  <b>Puedes contactar con nosotros para aclarar cualquier consulta, estés donde estés.</b>
                                              </p>
                                          </td>
                                      </tr>
                                  </tbody>
                              </table>
                          </td>
                      </tr>
                      <tr>
                          <td>
                              <table border="0" cellspacing="0" cellpadding="0">
                                  <tbody style="margin-top:15px">
                                      <tr>
                                          <td>
                                              <p style="text-align:left;margin-bottom:20px;margin-top:20px;font-weight:bold;font-size:18pt;color:#3D9FF2"><b>¡Gracias por confiar en nosotros!</b></p>
                                          </td>
                                      </tr>
                                      <tr>
                                          <td style="text-align:justify ">
                                              <p style="margin-top:12px;font-size:9pt;;color:rgb(166,166,166) ">
                                                  En virtud de lo dispuesto en el Reglamento (UE) 2016/679 del Parlamento Europeo y del Consejo de 27 de abril de 2016 relativo a la protección de las personas físicas en lo que respecta al tratamiento de datos personales, ROSE & PAGÉS, S.L. le informa
                                                  que sus datos personales incorporados en este formulario, serán incluidos en un fichero creado bajo nuestra responsabilidad, con la finalidad de comunicarnos con usted para llevar a cabo el mantenimiento
                                                  y control de la relación de negocio que nos vincula.
                                              </p>
                                              <p style="margin-top:12px;font-size:9pt;;color:rgb(166,166,166) ">
                                                  Según el Reglamento (UE) 2016/679 de 27 de abril de 2016, puede ejercitar los derechos de acceso, rectificación, oposición y supresión dirigiéndose por escrito a ROSE & PAGÉS, S.L., Hermosilla, nº 80 - 2º A. 28001 Madrid, o al correo electrónico
                                                  <a href="oquijada@rose-pages.com ">oquijada@rose-pages.com</a>.
                                              </p>
                                          </td>
                                      </tr>
                                  </tbody>
                              </table>
                          </td>
                      </tr>
                  </tbody>
              </table>
          </div>
      </div>
  </body>
  </html>';

  // Count total files
  $countfiles = count($_FILES['file']['name']);
  //var_dump($countfiles);
  //die();

  $uploadStatus = 1;

  $files = [];

  $id_asegurado = $_POST["no_documento_identidad"].'_'.$_POST["apellido1"].'_'.$_POST["nombre"];
  $id_asegurado = strtolower($id_asegurado);
   
  // Looping all files
  for($i=0;$i<$countfiles;$i++){

      $targetDir = "formularios/";
      $fileName = basename($_FILES['file']['name'][$i]);      
      $targetFilePath = $targetDir . $fileName;
      $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

      $newName = $targetDir.date('Ymd').'_'.random_int(100, 9999).'_'.$id_asegurado.'.'.$fileType;
          
      // Allow certain file formats
      $allowTypes = array('pdf', 'jpg', 'png', 'jpeg');
      if(in_array($fileType, $allowTypes)){
          // Upload file to the server
          if(move_uploaded_file($_FILES['file']['tmp_name'][$i], $newName)){
              array_push($files, $newName);
          }else{
              $uploadStatus = 0;
              $statusMsg = "Sorry, there was an error uploading your file.";
          }
      }else{
          $uploadStatus = 0;
          $statusMsg = 'Sorry, only PDF, JPG, JPEG, & PNG files are allowed to upload.';
      }       
      
  }

  // Attachment file
  $pdf_form = "formularios/formulario_cotizacion_".$_POST["num_cot"]."_".$_POST["apellido1"]."_".$_POST["nombre"].".pdf";
  array_push($files, $pdf_form);

  // Sender info
  $senderName = 'Solicitudes';
  $senderEmail = 'cotizaciones@hi-broker.com';

  $to      = $para;
  $from = $senderName." <".$senderEmail.">";
  $cc = 'dayannis.alguaca@gmail.com';
  $subject = 'Solicitud - Seguro de Salud';
  $message = $mensaje;

  // Create email headers
  $headers = 'From: '.$from."\r\n".
      'Reply-To: '.$to."\r\n" .
      'Cc: '.$cc."\r\n" .
      'X-Mailer: PHP/' . phpversion();

  // Boundary  
  $semi_rand = md5(time());  
  $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";  

  $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 

  // Multipart boundary  
  $message1 = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" . 
  "Content-Transfer-Encoding: 7bit\n\n" . $message . "\n\n";

  // Preparing attachment 
  if(!empty($files)){ 
      for($i=0;$i<count($files);$i++){ 
          if(is_file($files[$i])){ 
              $file_name = basename($files[$i]); 
              $file_size = filesize($files[$i]); 
               
              $message1 .= "--{$mime_boundary}\n"; 
              $fp =    @fopen($files[$i], "rb"); 
              $data =  @fread($fp, $file_size); 
              @fclose($fp); 
              $data = chunk_split(base64_encode($data)); 
              $message1 .= "Content-Type: application/octet-stream; name=\"".$file_name."\"\n" .  
              "Content-Description: ".$file_name."\n" . 
              "Content-Disposition: attachment;\n" . " filename=\"".$file_name."\"; size=".$file_size.";\n" .  
              "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n"; 
          } 
      } 
  } 
   
  $message1 .= "--{$mime_boundary}--"; 
  $returnpath = "-f" . $senderEmail; 
   
  // Send email 
  $mail = @mail($to, $subject, $message1, $headers);  

  if($mail){

      echo "<html><head>";
      echo "<meta charset='utf-8'>";
      echo "<meta name='viewport' content='width=device-width, initial-scale=1'>";
      echo "<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0' crossorigin='anonymous'>";
      
      echo "<style>
      body {
          background-image: url('http://pages.hi-broker.com/wp-content/uploads/2021/05/pages-hb.png');
           /* Full height */
          height: 100%;
          /* Center and scale the image nicely */
          background-position: center;
          background-repeat: no-repeat;
          background-size: cover;
          background-attachment: fixed;    
      }

      .contenedor {
          display: flex;
          justify-content: center;
          padding: 1em 1em 1em;
      }

      .fila{
          padding: 18em 5em 5em;
      }
      .green{
          min-width: 190px;
      }
      @media screen and (max-width: 600px) {
          .fila{
              padding: 2em 2em 2em;
          }
        
          .row {
          /* --bs-gutter-x: 1.5rem; */
          --bs-gutter-y: 0;
          display: flex;
          flex-wrap: wrap;
          margin-top: calc(var(--bs-gutter-y) * -1);
          margin-right: calc(var(--bs-gutter-x)/ -2);
          margin-left: calc(var(--bs-gutter-x)/ -2);
          }
      }


      .buton-hb {
          color: #ffffff !important;
          background-color: #51D11A !important;
          border-radius: 12px !important;
          -webkit-appearance: none;
          cursor: pointer;
          display: inline-block;
          text-transform: none;
          white-space: nowrap;
          padding: 1.15em 1.95em 1.1em;
          font-size: 1em;
          line-height: 1.5;
          font-weight: 400;
          letter-spacing: -0.3px;
          height: auto;
          border-width: 0 !important;
          -webkit-box-sizing: border-box;
          -ms-box-sizing: border-box;
          box-sizing: border-box;
      }
      .button-form {
          color: #ffffff !important;
          background-color: #ffffff !important;
      }
      </style>";
      echo "</head><body>";

      echo "<div><div class='row'>&nbsp;</div><div class='row'>";
     
     echo "<div class='col-md-3'></div>";
     echo "<div class='col-md-6'>";
     //echo "<center><img src='http://pages.hi-broker.com/wp-content/uploads/2021/03/pages.png' width='30%'></center>";
     echo "<br><br><br><h2 style='text-align: center'>Hemos enviado el formulario a tu correo electrónico</h2><br><h5 style='text-align: center'>" . $para . "</h5><br>";
     echo "</div>";
     echo "<br>";
     echo "<div class='col-md-3'></div>";
     echo "</div></div>";
     echo "<div>";
     echo "<div class='row'><div class='col-md-12'></div></div>";
     echo "<div class='row fila'>";     
     echo "<div class='col-md-4 contenedor'>";
     echo "<a href='https://pagesseguros.com' class='btn buton-hb green' role='button'>Ir al home</a>";
     echo "</div>";
     echo "<div class='col-md-4 contenedor'>";
     echo "<a href='http://pages.hi-broker.com/home/' class='btn buton-hb green' role='button'>Nueva cotización</a>";
     echo "</div>";
     echo "</div>";
     echo "</div>";
     echo "</body>";
     echo "</html>";
     
  }else{
     echo "<br><br><h5 style='text-align: center'>Error al enviar mensaje a la siguiente direcci&oacute;n: " . $para . "</h5><br>";
  }
