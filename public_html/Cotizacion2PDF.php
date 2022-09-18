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

 $html = '<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Cotización</title>
	
	<style>
				.clearfix:after {
			  content: "";
			  display: table;
			  clear: both;
			}

			a {
			  color: #0087C3;
			  text-decoration: none;
			}

			body {
			  position: relative;
			  width: 21cm;  
			  height: 29.7cm; 
			  margin: 0 auto; 
			  color: #555555;
			  background: #FFFFFF; 
			  font-family: Arial, sans-serif; 
			  font-size: 14px; 
			  font-family: SourceSansPro;
			}

			header {
			  padding: 10px 0;
			  margin-bottom: 20px;
			  border-bottom: 1px solid #AAAAAA;
			}

			#logo {
			  float: left;
			  margin-top: 8px;
			}

			#logo img {
			  height: 70px;
			}

			#company {
			  float: right;
			  text-align: right;
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
			  padding: 20px;
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
			  color: #57B223;
			  font-size: 1.2em;
			  font-weight: normal;
			  margin: 0 0 0.2em 0;
			}

			table .no {
			  color: #FFFFFF;
			  font-size: 1.6em;
			  background: #57B223;
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
			  background: #57B223;
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
			  color: #57B223;
			  font-size: 1.4em;
			  border-top: 1px solid #57B223; 

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
			  height: 30px;
			  position: absolute;
			  bottom: 0;
			  border-top: 1px solid #AAAAAA;
			  padding: 8px 0;
			  text-align: center;
			}
			</style>

  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="assets/img/logo.png">
      </div>
      <div id="company">
        <h2 class="name">'.$_POST["producto"]'</h2>
        <div>455 Foggy Heights, AZ 85004, US</div>
        <div>(602) 519-0450</div>
        <div><a href="mailto:company@example.com">company@example.com</a></div>
      </div>
      </div>
    </header>
	<main>
      <div id="details" class="clearfix">
        <div id="client">
          <div class="to">INVOICE TO:</div>
          <h2 class="name">vvvvv</h2>
          <div class="address">796 Silver Harbour, TX 79273, US</div>
          <div class="email"><a href="mailto:john@example.com">bbbbbb</a></div>
        </div>
        <div id="invoice">
          <h1>numero_cotizacion</h1>
          <div class="date">Fecha de cotizacion: 01/06/2014</div>
          <div class="date">Fecha limite: 30/06/2014</div>
        </div>
      </div>
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="no">#</th>
            <th class="desc">PRODUCTO</th>
            <th class="unit">PRECIO MENSUAL</th>
            <th class="qty">PRECIO ANUAL</th>
            <th class="total">TOTAL</th>
          </tr>
        </thead>';
		
		if(isset($_POST["cant_familiares"]) && !empty($_POST["cant_familiares"]) && $_POST["cant_familiares"]>0)
		{
			$html.=' y '.$_POST["cant_familiares"].' asegurado(s),';
			
			 $array=$_POST['fecha_nac_bene']; 
	 
			$array=array_recibe($array); 

			$html.=' edades ';
			foreach ($array as $indice => $valor){
			if($valor!="" || $valor!=null){ 
					$edad = calculaedad($valor);
					$html.=  $edad;
					if($indice != $_POST["cant_familiares"]-1){
					  $html.=',';
					}
				}
			}
    
        }
		
        $html ='<tbody>
          <tr>
            <td class="no">01</td>
            <td class="desc"><h3>Website Design</h3>Creating a recognizable design solution based on the companys existing visual identity</td>
            <td class="unit">$40.00</td>
            <td class="qty">30</td>
            <td class="total">$1,200.00</td>
          </tr>
          <tr>
            <td class="no">02</td>
            <td class="desc"><h3>Website Development</h3>Developing a Content Management System-based Website</td>
            <td class="unit">$40.00</td>
            <td class="qty">80</td>
            <td class="total">$3,200.00</td>
          </tr>
          <tr>
            <td class="no">03</td>
            <td class="desc"><h3>Search Engines Optimization</h3>Optimize the site for search engines (SEO)</td>
            <td class="unit">$40.00</td>
            <td class="qty">20</td>
            <td class="total">$800.00</td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">SUBTOTAL</td>
            <td>$5,200.00</td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">TAX 25%</td>
            <td>$1,300.00</td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">GRAND TOTAL</td>
            <td>$6,500.00</td>
          </tr>
        </tfoot>
      </table>
      <div id="thanks">Thank you!</div>
      <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
      </div>
    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
  </body>
</html>
	
</body>'

 $dompdf = new DOMPDF();
  $dompdf->load_html($html);

  $dompdf->set_paper("a4","portrait");
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

	
	
	