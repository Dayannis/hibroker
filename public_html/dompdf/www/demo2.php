<?php
require_once("../dompdf_config.inc.php");
$html='<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>MiCodigoPHP.com</title>
    <style>
        body{
            font-family: arial, helvetica, sans-serif;
            color: #000;
            background: #fff;
            padding:40px;
            text-align: center;
            line-height: 200%;
        }
        .logo{
            font-size: 30px;
        }
        .orange{
            color:orange;
        }
        .titulo{
            padding:30px 0px;
            font-size:30px;
            font-weight: bold;
        }
        .nombre{
            border-bottom: 1px solid cornsilk;
            font-size: 24px;
            font-family: Courier, "Courier new", monospace;
            font-style: italic;
        }
        .descripcion{
            font-size: 24px;
            padding: 30px 0px;
        }
    </style>
</head>
<body>
<div class="logo">MiCodigo<span class="orange">PHP.com</span></div>
<div class="titulo">CERTIFICADO DE RECONOCIMIENTO<br>A</div>
<div class="nombre">Andres Mendoza</div>
<div class="descripcion">Por su exposici&oacute;n en el taller de PHP para la conversi&oacute;n de HTML a PDF en el
    campus de la universidad DE LA VIDA el d&iacute;a 25 de Abril del 2015</div>
</body>
</html>';

$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream("certificado.pdf");


