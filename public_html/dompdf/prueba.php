
<?php
   
  require_once("dompdf_config.inc.php");
  ini_set('memory_limit', '2048M'); // or you could use 1G
  ini_set('max_execution_time', 1800);

  

  
   $html='<center><i> Siacc versi&oacute;n 2.0.07122017</i></center>';
  


  $dompdf = new DOMPDF();

  $dompdf->load_html($html);
  $dompdf->set_paper("a4","portrait");
  //$dompdf->set_paper("a4","portrait");

  $dompdf->render();
  $dompdf->stream("Listado de personas.pdf", array("Attachment" => 0));

  ?>
   
