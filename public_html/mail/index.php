<?php
require("class.phpmailer.php");
require("class.smtp.php");
//Recibir todos los parámetros del formulario
$para = "alejandronoriegaalvarado@gmail.com";
$asunto ="prueba de gmail";
$mensaje ='

<html>
<head>
<title>Envio de Sugerencias</title>
<style type="text/css">
*{
	font-size:12px;
	padding:5px;
	margin:5px;
	font-family: Verdana, Arial, New Times Romaw;
}
table{
	width:100%;
	border:0;
}

table tr td{
	pading:10px;
}

button {
    color: #fff;
    background-color: #428bca;
    border-color: #357ebd;
    display: inline-block;
    padding: 6px 12px;
    margin-bottom: 0;
    font-size: 14px;
    font-weight: normal;
    line-height: 1.428571429;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    cursor: pointer;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    -o-user-select: none;
    user-select: none;
}
</style>
</head>

<body>
<div id="apDiv3">
 <table>
 <tr>
 <td><img src="../img/digisalud.png" width="200px"></td>
 </tr>

  <tr>
 <td>Hola<b>Julio Valiente,</b></td><
 </tr>
 <tr>
 <td>Acabas de solicitar una Recuperación de tu Contraseña, asociada a la cuenta:</td>
 </tr>

 <tr>
 <td>juliovalienteperez@gmail.com</td>
 </tr>

 <tr>
 <td>Para actualizar tu Contraseña, Por favor haz click en el siguiente Botón:</td>
 </tr>

  <tr>
 <td><button>Recuperar contraseña</button></td>
 </tr>

   <tr>
 <td>Atentamente</td>
 </tr>

  <tr>
 <td>Equipo Digisalud</td>
 </tr>
  </table>
</div>
</body>
</html>

'; // Cerramos la comilla simple. Con la comilla simple y el punto y coma se finaliza el cuerpo del mensaje html.  

//$archivo = $_FILES['hugo'];
 
//Este bloque es importante
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->CharSet = 'UTF-8';
$mail->SMTPAuth = true;
$mail->SMTPSecure = "ssl";
$mail->Host = "smtp.gmail.com";
$mail->Port = 465;
 // Indicamos en la cabecera si el correo contiene html. Esta línea es muy importante si nuestro correo va a contener html
$mail->IsHTML(true);
//Nuestra cuenta
$mail->Username ='desarrollo.sistema.web95@gmail.com';
$mail->Password = 'RA24367055'; //Su password
 
//Agregar destinatario
$mail->AddAddress($para);
$mail->Subject = $asunto;
$mail->Body = $mensaje;
$mail->AltBody = "Usted esta viendo este mensaje simple debido a que su servidor de correo no admite formato HTML.";

//Para adjuntar archivo
//$mail->AddAttachment($archivo['tmp_name'], $archivo['name']);
$mail->MsgHTML($mensaje);
 
//Avisar si fue enviado o no y dirigir al index
if($mail->Send())
{
    echo'<script type="text/javascript">
            alert("Enviado Correctamente");
            //window.location="http://localhost/maillocal/index.php"
         </script>';
}
else{
    echo'<script type="text/javascript">
            alert("NO ENVIADO, intentar de nuevo");
            //window.location="http://localhost/maillocal/index.php"
         </script>';
}
?>