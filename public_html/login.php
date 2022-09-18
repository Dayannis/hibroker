<?php
    
    require_once("/home/customer/www/hi-broker.com/public_html/sp.php"); 
    $sp = new Sp();
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    $result = $sp->buscarMediador($user,$pass);
    if($res = $result->num_rows > 0)
    {
    	while($res = $result->fetch_row())
    	{
    	  $valor = $res[0];
    	}
    	if($valor == 1){
    	  $nombre = $sp->traerMediador($user,$pass);
          if($row = $nombre->num_rows > 0)
          {
            while($row = $nombre->fetch_assoc()) 
            {
              if(isset($_COOKIE['nombre'])){
                unset($_COOKIE['nombre']);
                unset($_COOKIE['idMediador']);
                
              }
              setcookie( 'nombre', $row['nombre'], time()+3600);
              setcookie( 'idMediador', $row['idMediador'], time()+3600);  
              Redirect('http://www.hi-broker.com/home/', false);
         
            }
          }
    	}
    	else{
    	  echo'<script type="text/javascript">
        alert("Datos Invalidos");
        window.location.href="http://hi-broker.com/login/?preview=true";
        </script>';
    	}
    	  
     
    }

    function Redirect($url, $permanent = false)
    {
        header('Location: ' . $url, true, $permanent ? 301 : 302);
        exit();
    }
    


?>