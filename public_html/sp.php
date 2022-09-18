<?php
//error_reporting(0);

class Sp
{
    private $con;
    
    function __construct()
    {
        $this->con = new mysqli("localhost", "orianaq0_user", "xGapjBnnxN8RMd9", "orianaq0_hbweb");
        $this->con->query("SET NAMES 'utf8'");
    }
    
    function extraerParentescos()
    {
        $datos = $this->con->prepare("CALL buscarParentesco()");
        $datos->execute();
        return $datos->get_result();
    }
    
    function buscarPais()
    {
        $datos = $this->con->prepare("CALL buscarPais()");
        $datos->execute();
        return $datos->get_result();
    }
    
    function buscarProvincia()
    {
        $datos = $this->con->prepare("CALL buscarProvincia()");
        $datos->execute();
        return $datos->get_result();
    }
    
    function buscarPromociones()
    {
        $datos = $this->con->prepare("CALL buscarPromociones()");
        $datos->execute();
        return $datos->get_result();
    }
    
    function buscarUsuario($idUsuario, $idpassword)
    {
	$datos = $this->con->prepare("CALL buscarUsuario($idUsuario,idpassword)");
        $datos->execute();
        return $datos->get_result();
     }


    function buscarLocalidad($id_provincia)
    {
        $datos = $this->con->prepare("CALL buscarLocalidad($id_provincia)");
        
        
        $datos->execute();
        return $datos->get_result();
    }
    
    function buscarProductos($pais, $provincia, $fecha_tomador, $fecha1, $fecha2, $fecha3, $fecha4, $fecha5, $fecha6)
    {
        
        $datos = $this->con->prepare("CALL buscar_productos('$pais','$provincia','$fecha_tomador','$fecha1','$fecha2','$fecha3','$fecha4','$fecha5','$fecha6')");
        $datos->execute();
        return $datos->get_result();
    }
    
    function addConsulta($pais, $provincia, $nombre, $apellido, $fecha_nac, $movil, $email, $familiares, $tomador)
    {
  
        $sql = "INSERT INTO consulta_web (idPais,idProvincia,nombre,apellido,fechaNacimiento,movil,email,nroFamiliares,tomador) VALUES (". $pais .", ". $provincia .",'". $nombre ."', '". $apellido ."', '". $fecha_nac ."', '". $movil ."','". $email ."', ". $familiares .", ". $tomador .")";
        
        //echo $sql;
        //exit();
        $this->con->query($sql);
        //var_dump($result);
        
    }

    function buscarUser($p_usuario, $p_clave)
	{
		$sql     = "";
		$sql     = "Select id, idUsuario, password, fechaAlta, fechaBaja,fechaModificacion
					from usuarios where idUsuario = '$p_usuario' and password = $p_clave";

                //echo $sql ."<br>";
                //exit();
					
		return $result = $this->con->query($sql);
		
	}

  function montoFamilia($pais, $provincia, $edad, $producto, $plan)
    {
        
        $sql = "SELECT producto.nombre as nombr, producto.idProducto as idpro, plan.idPlan as idPlan,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde,";
        $sql .= " plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, plan_precio.precioAnual as anual, IF (plan_precio.copago=0,'NO','SI') as copago FROM ";
        $sql .= " plan_precio inner join producto on producto.idProducto = plan_precio.idProducto INNER join plan on plan.idPlan = plan_precio.idPlan inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan ";
        $sql .= " WHERE  edaddesde <= $edad and $edad <=edadHasta AND plan_precio.idPais = $pais ";
        if ($pais == 1) {
            $sql .= "and IF(plan_precio.idProvincia <> '',  $provincia, NULL) = $provincia ";
        }
        $sql .= " and producto.idProducto = $producto and plan.idPlan = $plan ";
        $sql .= "group by nombr, idpro, idPlan, nombrePlan, edadDesde, edadHasta, mensual, anual";
        //echo $sql;
        //exit();
        $result = $this->con->query($sql);
        //var_dump($result);
        while ($row = $result->fetch_row()) {
            $monto = $row[6];
        }
        
        return $monto;
    }
    
    function montoFamiliaAnual($pais, $provincia, $edad, $producto, $plan)
    {
        
        $sql = "SELECT producto.nombre as nombr, producto.idProducto as idpro, plan.idPlan as idPlan,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde,";
        $sql .= " plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, plan_precio.precioAnual as anual, IF (plan_precio.copago=0,'NO','SI') as copago FROM ";
        $sql .= " plan_precio inner join producto on producto.idProducto = plan_precio.idProducto INNER join plan on plan.idPlan = plan_precio.idPlan inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan ";
        $sql .= " WHERE  edaddesde <= $edad and $edad <=edadHasta AND plan_precio.idPais = $pais ";
        if ($pais == 1) {
            $sql .= "and IF(plan_precio.idProvincia <> '',  $provincia, NULL) = $provincia ";
        }
        $sql .= " and producto.idProducto = $producto and plan.idPlan = $plan ";
        $sql .= "group by nombr, idpro, idPlan, nombrePlan, edadDesde, edadHasta, mensual, anual";
       // echo $sql;
        //exit();
        $result = $this->con->query($sql);
        //var_dump($result);
        while ($row = $result->fetch_row()) {
            $montoAnual = $row[7];
        }
        
        return $montoAnual ;
    }


     function obtenerValorAplicableSanitasInd()
     {
          $sql = "SELECT valorAplicable FROM promociones WHERE idProducto = 12 and id = 1";
          $result = $this->con->query($sql);
           while ($row = $result->fetch_row()) {
            $valorAplicable = $row[0];
        }
        
        return $valorAplicable ;
     }
     
     function obtenerValorAplicableSanitasGrupo4()
     {
          $sql = "SELECT valorAplicable FROM promociones WHERE idProducto = 12 and id = 2";
          $result = $this->con->query($sql);
           while ($row = $result->fetch_row()) {
            $valorAplicable = $row[0];
        }
        
        return $valorAplicable ;
     }

    
    function buscarProductosNew($p_categoria,$p_idPais, $p_idProvincia, $p_fechaNacimiento_tomador, $p_fechaNacimiento1, $p_fechaNacimiento2, $p_fechaNacimiento3, $p_fechaNacimiento4, $p_fechaNacimiento5, $p_fechaNacimiento6)
    {
    
        $idMediador = $_COOKIE['idMedidaor'];
        $sql     = "";
        $edadTmp = 0;
        $op      = 0;
        
        //Caso 1 fecha con tomador
        if ($p_fechaNacimiento_tomador <> '' && $p_fechaNacimiento1 == '') {
            $op      = 1;
            $edadTmp = $this->CalculaEdad($p_fechaNacimiento_tomador);
            
            
            $sql .= "SELECT producto.sumaAsegurada,producto.nombre as nombre, producto.idProducto as idProducto, plan.idPlan ,plan.Nombre as nombrePlan, ";
            $sql .= "plan_precio.edadDesde as edadDesde, plan_precio.edadHasta as edadHasta , (plan_precio.precio) as mensual, ";
 
            
            $sql .= "plan_precio.precioAnual as anual, ";

            $sql .= "promociones.valorAplicable,promociones.nombre as promoNombre, promociones.id, ";
            $sql .= "producto.descripcion as descripcion, IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "inner join producto_Mediador on producto_Mediador.idProducto = producto.idProducto  ";
            $sql .= "left join promociones on promociones.idProducto = producto.idProducto ";
            $sql .= "WHERE edaddesde <= $edadTmp and $edadTmp <=edadHasta and producto_Mediador.idMediador = {$_COOKIE['idMediador']}  ";
            
            $sql .= " and producto.idCategoria = $p_categoria AND plan_precio.idPais = $p_idPais  ";
            
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
           
            $sql.=  "and CASE when plan_precio.idProducto = 12 then promociones.id = 1  else 1=1  END ";//Solo para Sanitas cuando es una persona, esto es una mierda hay que mejorarlo,
            $sql .= "GROUP by idProducto ORDER BY anual";
            
            
            
        }
        
        //Caso 2 un solo afiliado que no es el tomador
        if ($p_fechaNacimiento1 <> '' && $p_fechaNacimiento_tomador == '') {
            $op      = 2;
            $edadTmp = $this->CalculaEdad($p_fechaNacimiento_tomador);
            $edad1 = $this->CalculaEdad($p_fechaNacimiento1);
            
            $sql         = "";
            
            $sql .= "SELECT producto.sumaAsegurada,producto.nombre as nombre, producto.idProducto as idProducto, plan.idPlan ,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
	    $sql .= "plan_precio.precioAnual as anual,producto.descripcion, ";
			$sql .= "promociones.valorAplicable,promociones.nombre as promoNombre, promociones.id, ";
            $sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "inner join producto_Mediador on producto_Mediador.idProducto = producto.idProducto  ";
            $sql .= "left join promociones on promociones.idProducto = producto.idProducto ";
            $sql .= "WHERE edaddesde <= $edad1 and $edad1 <=edadHasta and producto_Mediador.idMediador = {$_COOKIE['idMediador']} AND  producto.idCategoria = $p_categoria and plan_precio.idPais = $p_idPais ";             
            
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql.=  "and CASE when plan_precio.idProducto = 12 then promociones.id = 1  else 1=1  END ";//Solo para Sanitas cuando es una persona, esto es una mierda hay que mejorarlo,solo aplica la promocion 1 en este caso.
            $sql .= "GROUP by producto.idProducto  ";
             $sql .="";
            
        }


        //Caso 3 (1 afiliados incluyendo al tomador)
        if ($p_fechaNacimiento1 <> '' && $p_fechaNacimiento2 == '' && $p_fechaNacimiento_tomador <> '') {
            $op          = 3;
            $edadTomador = $this->CalculaEdad($p_fechaNacimiento_tomador);
            $edad1       = $this->CalculaEdad($p_fechaNacimiento1);
            
            $sql         = "";
            
            $sql .= "SELECT producto.sumaAsegurada,producto.nombre as nombre, producto.idProducto as idProducto, plan.idPlan ,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
	    $sql .= "plan_precio.precioAnual as anual,producto.descripcion, ";
			$sql .= "promociones.valorAplicable,promociones.nombre as promoNombre, ";
            $sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "inner join producto_Mediador on producto_Mediador.idProducto = producto.idProducto  ";
            $sql .= "left join promociones on promociones.idProducto = producto.idProducto ";
            $sql .= "WHERE edaddesde <= $edadTomador and $edadTomador <=edadHasta and producto_Mediador.idMediador = {$_COOKIE['idMediador']} AND  producto.idCategoria = $p_categoria and plan_precio.idPais = $p_idPais ";             
            
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql .= "GROUP by producto.idProducto  ";
            $sql .= "UNION ";
            $sql .= "SELECT producto.nombre as nombre, producto.idProducto as idproducto, plan.idPlan as idPlan,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
			
			$sql .= "plan_precio.precioAnual as anual, producto.descripcion, "; 
            
			$sql .= "promociones.valorAplicable,promociones.nombre as promoNombre, ";
            $sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "inner join producto_Mediador on producto_Mediador.idProducto = producto.idProducto  ";
            $sql .= "left join promociones on promociones.idProducto = producto.idProducto ";
            $sql .= "WHERE edaddesde <= $edad1 and $edad1 <=edadHasta and producto_Mediador.idMediador = {$_COOKIE['idMediador']} AND  producto.idCategoria = $p_categoria and plan_precio.idPais = $p_idPais ";             
                      
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql .= "GROUP by producto.idProducto  ";
            
            $sql .= "";
        }
        
        //Caso 4 (2 afiliados incluyendo al tomador)
        if ($p_fechaNacimiento1 <> '' && $p_fechaNacimiento2 <> '' && $p_fechaNacimiento_tomador <> '') {
            $op          = 4;
            $edadTomador = $this->CalculaEdad($p_fechaNacimiento_tomador);
            $edad1       = $this->CalculaEdad($p_fechaNacimiento1);
            $edad2       = $this->CalculaEdad($p_fechaNacimiento2);
            
            $sql         = "";
            
            
            $sql .= "SELECT producto.sumaAsegurada,producto.nombre as nombre, producto.idProducto as idProducto, plan.idPlan ,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
	    $sql .= "plan_precio.precioAnual as anual,producto.descripcion, ";
		
			$sql .= "promociones.valorAplicable,promociones.nombre as promoNombre, ";
            $sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "inner join producto_Mediador on producto_Mediador.idProducto = producto.idProducto  ";
            $sql .= "left join promociones on promociones.idProducto = producto.idProducto ";
            $sql .= "WHERE edaddesde <= $edadTomador and $edadTomador <=edadHasta and producto_Mediador.idMediador = {$_COOKIE['idMediador']} AND  producto.idCategoria = $p_categoria and plan_precio.idPais = $p_idPais ";             
            
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql .= "GROUP by producto.idProducto  ";
            $sql .= "UNION ";
            $sql .= "SELECT producto.nombre as nombr, producto.idProducto as idpro, plan.idPlan as idPlan,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
			
			$sql .= "plan_precio.precioAnual as anual, "; 
            $sql .= "producto.descripcion, ";
			
			$sql .= "promociones.valorAplicable,promociones.nombre as promoNombre, ";
            $sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "inner join producto_Mediador on producto_Mediador.idProducto = producto.idProducto  ";
            $sql .= "left join promociones on promociones.idProducto = producto.idProducto ";
            $sql .= "WHERE edaddesde <= $edad1 and $edad1 <=edadHasta and producto_Mediador.idMediador = {$_COOKIE['idMediador']} AND  producto.idCategoria = $p_categoria and plan_precio.idPais = $p_idPais ";             
                      
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql .= "GROUP by producto.idProducto  ";
            $sql .= "UNION ";
            $sql .= "SELECT producto.sumaAsegurada,producto.nombre as nombr, producto.idProducto as idpro, plan.idPlan as idPlan,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
			
			$sql .= "plan_precio.precioAnual as anual, "; 
            $sql .= "producto.descripcion, ";
			
			$sql .= "promociones.valorAplicable,promociones.nombre as promoNombre, ";
            $sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "inner join producto_Mediador on producto_Mediador.idProducto = producto.idProducto  ";
            $sql .= "left join promociones on promociones.idProducto = producto.idProducto ";
            $sql .= "WHERE edaddesde <= $edad2 and $edad2 <=edadHasta and producto_Mediador.idMediador = {$_COOKIE['idMediador']} AND  producto.idCategoria = $p_categoria and plan_precio.idPais = $p_idPais ";             
                      
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql .= "GROUP by producto.idProducto ";
            
            
            $sql .= "";
        
        }
        
        //Caso 5 (3 afiliados incluyendo al tomador) 4afiliados
        if ($p_fechaNacimiento1 <> '' && $p_fechaNacimiento2 <> '' && $p_fechaNacimiento_tomador <> '' && $p_fechaNacimiento3 <> '') {
            $op          = 5;
            $edadTomador = $this->CalculaEdad($p_fechaNacimiento_tomador);
            $edad1       = $this->CalculaEdad($p_fechaNacimiento1);
            $edad2       = $this->CalculaEdad($p_fechaNacimiento2);
            $edad3       = $this->CalculaEdad($p_fechaNacimiento3);
            
            $sql         = "";
            
            $sql .= "SELECT producto.sumaAsegurada,producto.nombre as nombre, producto.idProducto as idProducto, plan.idPlan ,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
	    $sql .= "plan_precio.precioAnual as anual,producto.descripcion, ";
			
			$sql .= "promociones.valorAplicable,promociones.nombre as promoNombre, promociones.id, ";
            $sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "inner join producto_Mediador on producto_Mediador.idProducto = producto.idProducto  ";
            $sql .= "left join promociones on promociones.idProducto = producto.idProducto ";
            $sql .= "WHERE edaddesde <= $edadTomador and $edadTomador <=edadHasta and producto_Mediador.idMediador = {$_COOKIE['idMediador']} AND  producto.idCategoria = $p_categoria and plan_precio.idPais = $p_idPais ";             
            
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql.=  "and CASE when plan_precio.idProducto = 12 then promociones.id = 2  else 1=1  END ";//Solo para Sanitas cuando es 4 personas, esto es una mierda hay que mejorarlo,solo aplica la promocion 2 en este caso.
            $sql .= "GROUP by producto.idProducto  ";
            $sql .= "UNION ";
            $sql .= "SELECT producto.sumaAsegurada,producto.nombre as nombr, producto.idProducto as idpro, plan.idPlan as idPlan,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
			
			$sql .= "plan_precio.precioAnual as anual, "; 
            $sql .= "producto.descripcion, ";
			
			$sql .= "promociones.valorAplicable,promociones.nombre as promoNombre, promociones.id,  ";
            $sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "inner join producto_Mediador on producto_Mediador.idProducto = producto.idProducto  ";
            $sql .= "left join promociones on promociones.idProducto = producto.idProducto ";
            $sql .= "WHERE edaddesde <= $edad1 and $edad1 <=edadHasta and producto_Mediador.idMediador = {$_COOKIE['idMediador']} AND  producto.idCategoria = $p_categoria and plan_precio.idPais = $p_idPais ";             
                      
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql.=  "and CASE when plan_precio.idProducto = 12 then promociones.id = 2  else 1=1  END ";//Solo para Sanitas cuando es 4 personas, esto es una mierda hay que mejorarlo,solo aplica la promocion 2 en este caso.
            $sql .= "GROUP by producto.idProducto  ";
            $sql .= "UNION ";
            $sql .= "SELECT producto.sumaAsegurada,producto.nombre as nombr, producto.idProducto as idpro, plan.idPlan as idPlan,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
			
			$sql .= "plan_precio.precioAnual as anual, "; 
            $sql .= "producto.descripcion, ";
			
			$sql .= "promociones.valorAplicable,promociones.nombre as promoNombre, promociones.id, ";
            $sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "inner join producto_Mediador on producto_Mediador.idProducto = producto.idProducto  ";
            $sql .= "left join promociones on promociones.idProducto = producto.idProducto ";
            $sql .= "WHERE edaddesde <= $edad2 and $edad2 <=edadHasta and producto_Mediador.idMediador = {$_COOKIE['idMediador']} AND  producto.idCategoria = $p_categoria and plan_precio.idPais = $p_idPais ";             
                      
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql.=  "and CASE when plan_precio.idProducto = 12 then promociones.id = 2  else 1=1  END "; //Solo para Sanitas cuando es 4 personas, esto es una mierda hay que mejorarlo,solo aplica la promocion 2 en este caso.
            $sql .= "GROUP by producto.idProducto  ";
            
            $sql .= "UNION ";
            $sql .= "SELECT producto.sumaAsegurada,producto.nombre as nombr, producto.idProducto as idpro, plan.idPlan as idPlan,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
			
			$sql .= "plan_precio.precioAnual as anual, "; 
            $sql .= "producto.descripcion, ";
			
			$sql .= "promociones.valorAplicable,promociones.nombre as promoNombre, promociones.id, ";
            $sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "inner join producto_Mediador on producto_Mediador.idProducto = producto.idProducto  ";
            $sql .= "left join promociones on promociones.idProducto = producto.idProducto ";
            $sql .= "WHERE edaddesde <= $edad3 and $edad3 <=edadHasta and producto_Mediador.idMediador = {$_COOKIE['idMediador']} AND  producto.idCategoria = $p_categoria and plan_precio.idPais = $p_idPais ";             
                      
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
             $sql.=  "and CASE when plan_precio.idProducto = 12 then promociones.id = 2  else 1=1  END ";//Solo para Sanitas cuando es 4 personas, esto es una mierda hay que mejorarlo,solo aplica la promocion 2 en este caso.
            $sql .= "GROUP by producto.idProducto  ";
            
            
            $sql .= "";
        
        }
        
        //Caso 6 (4 afiliados incluyendo al tomador) 5afliados
        if ($p_fechaNacimiento1 <> '' && $p_fechaNacimiento2 <> '' && $p_fechaNacimiento_tomador <> '' && $p_fechaNacimiento3 <> ''  && $p_fechaNacimiento4 <> '') {
             $op          = 6;
            $edadTomador = $this->CalculaEdad($p_fechaNacimiento_tomador);
            $edad1       = $this->CalculaEdad($p_fechaNacimiento1);
            $edad2       = $this->CalculaEdad($p_fechaNacimiento2);
            $edad3       = $this->CalculaEdad($p_fechaNacimiento3);
            $edad4       = $this->CalculaEdad($p_fechaNacimiento4);
            
            $sql         = "";
            
            $sql .= "SELECT producto.sumaAsegurada,producto.nombre as nombre, producto.idProducto as idProducto, plan.idPlan ,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
	    $sql .= "plan_precio.precioAnual as anual,producto.descripcion, ";
			
			$sql .= "promociones.valorAplicable,promociones.nombre as promoNombre, ";
            $sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "inner join producto_Mediador on producto_Mediador.idProducto = producto.idProducto  ";
            $sql .= "left join promociones on promociones.idProducto = producto.idProducto ";
            $sql .= "WHERE edaddesde <= $edadTomador and $edadTomador <=edadHasta and producto_Mediador.idMediador = {$_COOKIE['idMediador']} AND  producto.idCategoria = $p_categoria and plan_precio.idPais = $p_idPais ";             
            
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql .= "GROUP by producto.idProducto  ";
            $sql .= "UNION ";
            $sql .= "SELECT producto.sumaAsegurada,producto.nombre as nombr, producto.idProducto as idpro, plan.idPlan as idPlan,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
			
			$sql .= "plan_precio.precioAnual as anual, "; 
            $sql .= "producto.descripcion, ";
			
			$sql .= "promociones.valorAplicable,promociones.nombre as promoNombre, ";
            $sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "inner join producto_Mediador on producto_Mediador.idProducto = producto.idProducto  ";
			$sql .= "left join promociones on promociones.idProducto = producto.idProducto ";
            $sql .= "WHERE edaddesde <= $edad1 and $edad1 <=edadHasta and producto_Mediador.idMediador = {$_COOKIE['idMediador']} AND  producto.idCategoria = $p_categoria and plan_precio.idPais = $p_idPais ";             
                      
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql .= "GROUP by producto.idProducto  ";
            $sql .= "UNION ";
            $sql .= "SELECT producto.sumaAsegurada,producto.nombre as nombr, producto.idProducto as idpro, plan.idPlan as idPlan,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
			
			$sql .= "plan_precio.precioAnual as anual, "; 
            $sql .= "producto.descripcion, ";
			
			$sql .= "promociones.valorAplicable,promociones.nombre as promoNombre, ";
            $sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "inner join producto_Mediador on producto_Mediador.idProducto = producto.idProducto  ";
			$sql .= "left join promociones on promociones.idProducto = producto.idProducto ";
            $sql .= "WHERE edaddesde <= $edad2 and $edad2 <=edadHasta and producto_Mediador.idMediador = {$_COOKIE['idMediador']} AND  producto.idCategoria = $p_categoria and plan_precio.idPais = $p_idPais ";             
                      
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql .= "GROUP by producto.idProducto  ";
            
            $sql .= "UNION ";
            $sql .= "SELECT producto.sumaAsegurada,producto.nombre as nombr, producto.idProducto as idpro, plan.idPlan as idPlan,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
			
			$sql .= "plan_precio.precioAnual as anual, "; 
            $sql .= "producto.descripcion, ";
			
			$sql .= "promociones.valorAplicable,promociones.nombre as promoNombre, ";
            $sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "inner join producto_Mediador on producto_Mediador.idProducto = producto.idProducto  ";
			$sql .= "left join promociones on promociones.idProducto = producto.idProducto ";
            $sql .= "WHERE edaddesde <= $edad3 and $edad3 <=edadHasta and producto_Mediador.idMediador = {$_COOKIE['idMediador']} AND  producto.idCategoria = $p_categoria and plan_precio.idPais = $p_idPais ";             
                      
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql .= "GROUP by producto.idProducto  ";
            $sql .= "UNION ";
            $sql .= "SELECT producto.sumaAsegurada,producto.nombre as nombr, producto.idProducto as idpro, plan.idPlan as idPlan,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
			
			$sql .= "plan_precio.precioAnual as anual, "; 
            $sql .= "producto.descripcion, ";
			
			$sql .= "promociones.valorAplicable,promociones.nombre as promoNombre, ";
            $sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "inner join producto_Mediador on producto_Mediador.idProducto = producto.idProducto  ";
			$sql .= "left join promociones on promociones.idProducto = producto.idProducto ";
            $sql .= "WHERE edaddesde <= $edad4 and $edad4 <=edadHasta and producto_Mediador.idMediador = {$_COOKIE['idMediador']} AND  producto.idCategoria = $p_categoria and plan_precio.idPais = $p_idPais ";             
                      
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql .= "GROUP by producto.idProducto  ";
            
            $sql .= "";
        
        }
        
        //Caso 7 (5 afiliados incluyendo al tomador(6))
        if ($p_fechaNacimiento1 <> '' && $p_fechaNacimiento2 <> '' && $p_fechaNacimiento_tomador <> '' && $p_fechaNacimiento3 <> ''  && $p_fechaNacimiento4 <> '' && $p_fechaNacimiento5 <> '') {
             $op          = 7;
            $edadTomador = $this->CalculaEdad($p_fechaNacimiento_tomador);
            $edad1       = $this->CalculaEdad($p_fechaNacimiento1);
            $edad2       = $this->CalculaEdad($p_fechaNacimiento2);
            $edad3       = $this->CalculaEdad($p_fechaNacimiento3);
            $edad4       = $this->CalculaEdad($p_fechaNacimiento4);
            $edad5       = $this->CalculaEdad($p_fechaNacimiento5);
            
            $sql         = "";
            
            $sql .= "SELECT producto.sumaAsegurada,producto.nombre as nombre, producto.idProducto as idProducto, plan.idPlan ,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
	    $sql .= "plan_precio.precioAnual as anual,producto.descripcion, ";
			
			$sql .= "promociones.valorAplicable,promociones.nombre as promoNombre, ";
            $sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "inner join producto_Mediador on producto_Mediador.idProducto = producto.idProducto  ";
			$sql .= "left join promociones on promociones.idProducto = producto.idProducto ";
            $sql .= "WHERE edaddesde <= $edadTomador and $edadTomador <=edadHasta and producto_Mediador.idMediador = {$_COOKIE['idMediador']} AND  producto.idCategoria = $p_categoria and plan_precio.idPais = $p_idPais ";             
            
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql .= "GROUP by producto.idProducto  ";
            $sql .= "UNION ";
            $sql .= "SELECT producto.sumaAsegurada,producto.nombre as nombr, producto.idProducto as idpro, plan.idPlan as idPlan,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
			
			$sql .= "plan_precio.precioAnual as anual, "; 
            $sql .= "producto.descripcion, ";
			
			$sql .= "promociones.valorAplicable,promociones.nombre as promoNombre, ";
            $sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "inner join producto_Mediador on producto_Mediador.idProducto = producto.idProducto  ";
			$sql .= "left join promociones on promociones.idProducto = producto.idProducto ";
            $sql .= "WHERE edaddesde <= $edad1 and $edad1 <=edadHasta and producto_Mediador.idMediador = {$_COOKIE['idMediador']} AND  producto.idCategoria = $p_categoria and plan_precio.idPais = $p_idPais ";             
                      
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql .= "GROUP by producto.idProducto  ";
            $sql .= "UNION ";
            $sql .= "SELECT producto.sumaAsegurada,producto.nombre as nombr, producto.idProducto as idpro, plan.idPlan as idPlan,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
			
			$sql .= "plan_precio.precioAnual as anual, "; 
            $sql .= "producto.descripcion, ";
			
			$sql .= "promociones.valorAplicable,promociones.nombre as promoNombre, ";
            $sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "inner join producto_Mediador on producto_Mediador.idProducto = producto.idProducto  ";
			$sql .= "left join promociones on promociones.idProducto = producto.idProducto ";
            $sql .= "WHERE edaddesde <= $edad2 and $edad2 <=edadHasta and producto_Mediador.idMediador = {$_COOKIE['idMediador']} AND  producto.idCategoria = $p_categoria and plan_precio.idPais = $p_idPais ";             
                      
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql .= "GROUP by producto.idProducto  ";
            
            $sql .= "UNION ";
            $sql .= "SELECT producto.sumaAsegurada,producto.nombre as nombr, producto.idProducto as idpro, plan.idPlan as idPlan,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
			
			$sql .= "plan_precio.precioAnual as anual, "; 
            $sql .= "producto.descripcion, ";
			
			$sql .= "promociones.valorAplicable,promociones.nombre as promoNombre, ";
            $sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "inner join producto_Mediador on producto_Mediador.idProducto = producto.idProducto  ";
			$sql .= "left join promociones on promociones.idProducto = producto.idProducto ";
            $sql .= "WHERE edaddesde <= $edad3 and $edad3 <=edadHasta and producto_Mediador.idMediador = {$_COOKIE['idMediador']} AND  producto.idCategoria = $p_categoria and plan_precio.idPais = $p_idPais ";             
                      
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql .= "GROUP by producto.idProducto  ";
            $sql .= "UNION ";
            $sql .= "SELECT producto.sumaAsegurada,producto.nombre as nombr, producto.idProducto as idpro, plan.idPlan as idPlan,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
			
			$sql .= "plan_precio.precioAnual as anual, "; 
            $sql .= "producto.descripcion, ";
			
			$sql .= "promociones.valorAplicable,promociones.nombre as promoNombre, ";
            $sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "inner join producto_Mediador on producto_Mediador.idProducto = producto.idProducto  ";
			$sql .= "left join promociones on promociones.idProducto = producto.idProducto ";
            $sql .= "WHERE edaddesde <= $edad4 and $edad4 <=edadHasta and producto_Mediador.idMediador = {$_COOKIE['idMediador']} AND  producto.idCategoria = $p_categoria and plan_precio.idPais = $p_idPais ";             
                      
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql .= "GROUP by producto.idProducto  ";
            $sql .= "UNION ";
            $sql .= "SELECT producto.sumaAsegurada,producto.nombre as nombr, producto.idProducto as idpro, plan.idPlan as idPlan,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
			
			$sql .= "plan_precio.precioAnual as anual, "; 
            $sql .= "producto.descripcion, ";
			
			$sql .= "promociones.valorAplicable,promociones.nombre as promoNombre, ";
            $sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "inner join producto_Mediador on producto_Mediador.idProducto = producto.idProducto  ";
			$sql .= "left join promociones on promociones.idProducto = producto.idProducto ";
            $sql .= "WHERE edaddesde <= $edad5 and $edad5 <=edadHasta and producto_Mediador.idMediador = {$_COOKIE['idMediador']} AND  producto.idCategoria = $p_categoria and plan_precio.idPais = $p_idPais ";             
                      
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql .= "GROUP by producto.idProducto  ";
            
            $sql .= "";
        
        }
        
        //Caso 8 (6 afiliados incluyendo al tomador)
        if ($p_fechaNacimiento1 <> '' && $p_fechaNacimiento2 <> '' && $p_fechaNacimiento_tomador <> '' && $p_fechaNacimiento3 <> '' && $p_fechaNacimiento4 <> '' && $p_fechaNacimiento5 <> '' && $p_fechaNacimiento6 <> '') {
            $op          = 8;
            $edadTomador = $this->CalculaEdad($p_fechaNacimiento_tomador);
            $edad1       = $this->CalculaEdad($p_fechaNacimiento1);
            $edad2       = $this->CalculaEdad($p_fechaNacimiento2);
            $edad3       = $this->CalculaEdad($p_fechaNacimiento3);
            $edad4       = $this->CalculaEdad($p_fechaNacimiento4);
            $edad5       = $this->CalculaEdad($p_fechaNacimiento5);
            $edad6       = $this->CalculaEdad($p_fechaNacimiento6);
            $sql         = "";

            $sql .= "SELECT producto.sumaAsegurada,producto.nombre as nombre, producto.idProducto as idProducto, plan.idPlan ,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
	    $sql .= "plan_precio.precioAnual as anual,producto.descripcion, ";
			
			$sql .= "promociones.valorAplicable,promociones.nombre as promoNombre, ";
            $sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "inner join producto_Mediador on producto_Mediador.idProducto = producto.idProducto  ";
			$sql .= "left join promociones on promociones.idProducto = producto.idProducto ";
            $sql .= "WHERE edaddesde <= $edadTomador and $edadTomador <=edadHasta and producto_Mediador.idMediador = {$_COOKIE['idMediador']} AND  producto.idCategoria = $p_categoria and plan_precio.idPais = $p_idPais ";             
            
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql .= "GROUP by producto.idProducto  ";
            $sql .= "UNION ";
            $sql .= "SELECT producto.sumaAsegurada,producto.nombre as nombr, producto.idProducto as idpro, plan.idPlan as idPlan,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
			
			$sql .= "plan_precio.precioAnual as anual, "; 
            $sql .= "producto.descripcion, ";
			
			$sql .= "promociones.valorAplicable,promociones.nombre as promoNombre, ";
            $sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "inner join producto_Mediador on producto_Mediador.idProducto = producto.idProducto  ";
			$sql .= "left join promociones on promociones.idProducto = producto.idProducto ";
            $sql .= "WHERE edaddesde <= $edad1 and $edad1 <=edadHasta and producto_Mediador.idMediador = {$_COOKIE['idMediador']} AND  producto.idCategoria = $p_categoria and plan_precio.idPais = $p_idPais ";             
                      
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql .= "GROUP by producto.idProducto  ";
            $sql .= "UNION ";
            $sql .= "SELECT producto.sumaAsegurada,producto.nombre as nombr, producto.idProducto as idpro, plan.idPlan as idPlan,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
			
			$sql .= "plan_precio.precioAnual as anual, "; 
            $sql .= "producto.descripcion, ";
			
			$sql .= "promociones.valorAplicable,promociones.nombre as promoNombre, ";
            $sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "inner join producto_Mediador on producto_Mediador.idProducto = producto.idProducto  ";
			$sql .= "left join promociones on promociones.idProducto = producto.idProducto ";
            $sql .= "WHERE edaddesde <= $edad2 and $edad2 <=edadHasta and producto_Mediador.idMediador = {$_COOKIE['idMediador']} AND  producto.idCategoria = $p_categoria and plan_precio.idPais = $p_idPais ";             
                      
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql .= "GROUP by producto.idProducto  ";
            
            $sql .= "UNION ";
            $sql .= "SELECT producto.sumaAsegurada,producto.nombre as nombr, producto.idProducto as idpro, plan.idPlan as idPlan,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
			
			$sql .= "plan_precio.precioAnual as anual, "; 
            $sql .= "producto.descripcion, ";
			
			$sql .= "promociones.valorAplicable,promociones.nombre as promoNombre, ";
            $sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "inner join producto_Mediador on producto_Mediador.idProducto = producto.idProducto  ";
			$sql .= "left join promociones on promociones.idProducto = producto.idProducto ";
            $sql .= "WHERE edaddesde <= $edad3 and $edad3 <=edadHasta and producto_Mediador.idMediador = {$_COOKIE['idMediador']} AND  producto.idCategoria = $p_categoria and plan_precio.idPais = $p_idPais ";             
                      
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql .= "GROUP by producto.idProducto  ";
            $sql .= "UNION ";
            $sql .= "SELECT producto.sumaAsegurada,producto.nombre as nombr, producto.idProducto as idpro, plan.idPlan as idPlan,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
			
			$sql .= "plan_precio.precioAnual as anual, "; 
            $sql .= "producto.descripcion, ";
			
			$sql .= "promociones.valorAplicable,promociones.nombre as promoNombre, ";
            $sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "inner join producto_Mediador on producto_Mediador.idProducto = producto.idProducto  ";
			$sql .= "left join promociones on promociones.idProducto = producto.idProducto ";
            $sql .= "WHERE edaddesde <= $edad4 and $edad4 <=edadHasta and producto_Mediador.idMediador = {$_COOKIE['idMediador']} AND  producto.idCategoria = $p_categoria and plan_precio.idPais = $p_idPais ";             
                      
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql .= "GROUP by producto.idProducto  ";
            $sql .= "UNION ";
            $sql .= "SELECT producto.sumaAsegurada,producto.nombre as nombr, producto.idProducto as idpro, plan.idPlan as idPlan,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
			
			$sql .= "plan_precio.precioAnual as anual, "; 
            $sql .= "producto.descripcion, ";
			
			$sql .= "promociones.valorAplicable,promociones.nombre as promoNombre, ";
            $sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "inner join producto_Mediador on producto_Mediador.idProducto = producto.idProducto  ";
			$sql .= "left join promociones on promociones.idProducto = producto.idProducto ";
            $sql .= "WHERE edaddesde <= $edad5 and $edad5 <=edadHasta and producto_Mediador.idMediador = {$_COOKIE['idMediador']} AND  producto.idCategoria = $p_categoria and plan_precio.idPais = $p_idPais ";             
                      
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql .= "GROUP by producto.idProducto  ";
            
            
            $sql .= "";
        }
        
        //Caso 9 - 2 afiliados sin tomador
        if ($p_fechaNacimiento1 <> '' && $p_fechaNacimiento_tomador == '' && $p_fechaNacimiento2 <> '') {
            $op      = 9;
            $edadTmp = $this->CalculaEdad($p_fechaNacimiento_tomador);
            $edad1 = $this->CalculaEdad($p_fechaNacimiento1);
            $edad2 = $this->CalculaEdad($p_fechaNacimiento2);
            
            $sql         = "";
            
            $sql .= "SELECT producto.sumaAsegurada,producto.nombre as nombre, producto.idProducto as idProducto, plan.idPlan ,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
	    $sql .= "plan_precio.precioAnual as anual,producto.descripcion, ";
			
			$sql .= "promociones.valorAplicable,promociones.nombre as promoNombre, ";
            $sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "inner join producto_Mediador on producto_Mediador.idProducto = producto.idProducto  ";
			$sql .= "left join promociones on promociones.idProducto = producto.idProducto ";
            $sql .= "WHERE edaddesde <= $edad1 and $edad1 <=edadHasta and producto_Mediador.idMediador = {$_COOKIE['idMediador']} AND  producto.idCategoria = $p_categoria and plan_precio.idPais = $p_idPais ";             
            
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql .= "GROUP by producto.idProducto  ";
            $sql .= "UNION ";
            $sql .= "SELECT producto.sumaAsegurada,producto.nombre as nombr, producto.idProducto as idpro, plan.idPlan as idPlan,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
			
			$sql .= "plan_precio.precioAnual as anual, "; 
            $sql .= "producto.descripcion, ";
			
			$sql .= "promociones.valorAplicable,promociones.nombre as promoNombre, ";
            $sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "inner join producto_Mediador on producto_Mediador.idProducto = producto.idProducto  ";
			$sql .= "left join promociones on promociones.idProducto = producto.idProducto ";
            $sql .= "WHERE edaddesde <= $edad2 and $edad2 <=edadHasta and producto_Mediador.idMediador = {$_COOKIE['idMediador']} AND  producto.idCategoria = $p_categoria and plan_precio.idPais = $p_idPais ";             
                      
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql .= "GROUP by producto.idProducto  ";
             $sql .="";
            
           }
           
           //Caso 10- 3 afiliados sin tomador
        if ($p_fechaNacimiento1 <> '' && $p_fechaNacimiento_tomador == '' && $p_fechaNacimiento2 <> '' && $p_fechaNacimiento3 <> '' ) {
            $op      = 10;
            $edadTmp = $this->CalculaEdad($p_fechaNacimiento_tomador);
            $edad1 = $this->CalculaEdad($p_fechaNacimiento1);
            $edad2 = $this->CalculaEdad($p_fechaNacimiento2);
            $edad3 = $this->CalculaEdad($p_fechaNacimiento3);
            $sql         = "";
            
            $sql .= "SELECT producto.sumaAsegurada,producto.nombre as nombre, producto.idProducto as idProducto, plan.idPlan ,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
	    $sql .= "plan_precio.precioAnual as anual,producto.descripcion, ";
			
			$sql .= "promociones.valorAplicable,promociones.nombre as promoNombre, ";
            $sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "inner join producto_Mediador on producto_Mediador.idProducto = producto.idProducto  ";
			$sql .= "left join promociones on promociones.idProducto = producto.idProducto ";
            $sql .= "WHERE edaddesde <= $edad1 and $edad1 <=edadHasta and producto_Mediador.idMediador = {$_COOKIE['idMediador']} AND  producto.idCategoria = $p_categoria and plan_precio.idPais = $p_idPais ";             
            
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql .= "GROUP by producto.idProducto  ";
            $sql .= "UNION ";
            $sql .= "SELECT producto.sumaAsegurada,producto.nombre as nombr, producto.idProducto as idpro, plan.idPlan as idPlan,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
			
			$sql .= "plan_precio.precioAnual as anual, "; 
            $sql .= "producto.descripcion, ";
			
			$sql .= "promociones.valorAplicable,promociones.nombre as promoNombre, ";
            $sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "inner join producto_Mediador on producto_Mediador.idProducto = producto.idProducto  ";
			$sql .= "left join promociones on promociones.idProducto = producto.idProducto ";
            $sql .= "WHERE edaddesde <= $edad2 and $edad2 <=edadHasta and producto_Mediador.idMediador = {$_COOKIE['idMediador']} AND  producto.idCategoria = $p_categoria and plan_precio.idPais = $p_idPais ";             
                      
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql .= "GROUP by producto.idProducto  ";
             $sql .= "UNION ";
            $sql .= "SELECT producto.sumaAsegurada,producto.nombre as nombr, producto.idProducto as idpro, plan.idPlan as idPlan,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
			
			$sql .= "plan_precio.precioAnual as anual, "; 
            $sql .= "producto.descripcion, ";
			
			$sql .= "promociones.valorAplicable,promociones.nombre as promoNombre, ";
            $sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "inner join producto_Mediador on producto_Mediador.idProducto = producto.idProducto  ";
			$sql .= "left join promociones on promociones.idProducto = producto.idProducto ";
            $sql .= "WHERE edaddesde <= $edad3 and $edad3 <=edadHasta and producto_Mediador.idMediador = {$_COOKIE['idMediador']} AND  producto.idCategoria = $p_categoria and plan_precio.idPais = $p_idPais ";             
                      
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql .= "GROUP by producto.idProducto  ";
             $sql .="";
            
           }
           
           //Caso 11- 4 afiliados sin tomador
           if ($p_fechaNacimiento1 <> '' && $p_fechaNacimiento_tomador == '' && $p_fechaNacimiento2 <> '' && $p_fechaNacimiento3 <> '' && $p_fechaNacimiento4 <> '' ) {
            $op      = 11;
            $edadTmp = $this->CalculaEdad($p_fechaNacimiento_tomador);
            $edad1 = $this->CalculaEdad($p_fechaNacimiento1);
            $edad2 = $this->CalculaEdad($p_fechaNacimiento2);
            $edad3 = $this->CalculaEdad($p_fechaNacimiento3);
            $edad4 = $this->CalculaEdad($p_fechaNacimiento4);
            $sql         = "";
            
            $sql .= "SELECT producto.sumaAsegurada,producto.nombre as nombre, producto.idProducto as idProducto, plan.idPlan ,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, promociones.id, ";
	    $sql .= "plan_precio.precioAnual as anual,producto.descripcion, ";
			
			$sql .= "promociones.valorAplicable,promociones.nombre as promoNombre, ";
            $sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "inner join producto_Mediador on producto_Mediador.idProducto = producto.idProducto  ";
			$sql .= "left join promociones on promociones.idProducto = producto.idProducto ";
            $sql .= "WHERE edaddesde <= $edad1 and $edad1 <=edadHasta and producto_Mediador.idMediador = {$_COOKIE['idMediador']} AND  producto.idCategoria = $p_categoria and plan_precio.idPais = $p_idPais ";             
            
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql.=  "and CASE when plan_precio.idProducto = 12 then promociones.id = 2  else 1=1  END ";//Solo para Sanitas cuando es 4 personas, esto es una mierda hay que mejorarlo,solo aplica la promocion 2 en este caso.
            $sql .= "GROUP by producto.idProducto  ";
            $sql .= "UNION ";
            $sql .= "SELECT producto.sumaAsegurada,producto.nombre as nombr, producto.idProducto as idpro, plan.idPlan as idPlan,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
			
			$sql .= "plan_precio.precioAnual as anual, "; 
            $sql .= "producto.descripcion, ";
			
			$sql .= "promociones.valorAplicable,promociones.nombre as promoNombre, promociones.id, ";
            $sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "inner join producto_Mediador on producto_Mediador.idProducto = producto.idProducto  ";
			$sql .= "left join promociones on promociones.idProducto = producto.idProducto ";
            $sql .= "WHERE edaddesde <= $edad2 and $edad2 <=edadHasta and producto_Mediador.idMediador = {$_COOKIE['idMediador']} AND  producto.idCategoria = $p_categoria and plan_precio.idPais = $p_idPais ";             
                      
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql.=  "and CASE when plan_precio.idProducto = 12 then promociones.id = 2  else 1=1  END ";//Solo para Sanitas cuando es 4 personas, esto es una mierda hay que mejorarlo,solo aplica la promocion 2 en este caso.
            $sql .= "GROUP by producto.idProducto  ";
             $sql .= "UNION ";
            $sql .= "SELECT producto.sumaAsegurada,producto.nombre as nombr, producto.idProducto as idpro, plan.idPlan as idPlan,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
			
			$sql .= "plan_precio.precioAnual as anual, "; 
            $sql .= "producto.descripcion, ";
			$sql .= "promociones.valorAplicable,promociones.nombre as promoNombre, promociones.id, ";
            $sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "inner join producto_Mediador on producto_Mediador.idProducto = producto.idProducto  ";
			$sql .= "left join promociones on promociones.idProducto = producto.idProducto ";
            $sql .= "WHERE edaddesde <= $edad3 and $edad3 <=edadHasta and producto_Mediador.idMediador = {$_COOKIE['idMediador']} AND  producto.idCategoria = $p_categoria and plan_precio.idPais = $p_idPais ";             
                      
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql.=  "and CASE when plan_precio.idProducto = 12 then promociones.id = 2  else 1=1  END ";//Solo para Sanitas cuando es 4 personas, esto es una mierda hay que mejorarlo,solo aplica la promocion 2 en este caso.
            $sql .= "GROUP by producto.idProducto  ";
            $sql .= "UNION ";
            $sql .= "SELECT producto.sumaAsegurada,producto.nombre as nombr, producto.idProducto as idpro, plan.idPlan as idPlan,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
			
			$sql .= "plan_precio.precioAnual as anual, "; 
            $sql .= "producto.descripcion, ";
			
			$sql .= "promociones.valorAplicable,promociones.nombre as promoNombre, promociones.id, ";
            $sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "inner join producto_Mediador on producto_Mediador.idProducto = producto.idProducto  ";
			$sql .= "left join promociones on promociones.idProducto = producto.idProducto ";
            $sql .= "WHERE edaddesde <= $edad4 and $edad4 <=edadHasta and producto_Mediador.idMediador = {$_COOKIE['idMediador']} AND  producto.idCategoria = $p_categoria and plan_precio.idPais = $p_idPais ";             
                      
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql.=  "and CASE when plan_precio.idProducto = 12 then promociones.id = 2  else 1=1  END ";//Solo para Sanitas cuando es 4 personas, esto es una mierda hay que mejorarlo,solo aplica la promocion 2 en este caso.
            $sql .= "GROUP by producto.idProducto  ";
             $sql .="";
            
           }
           
            if ($p_fechaNacimiento1 <> '' && $p_fechaNacimiento_tomador == '' && $p_fechaNacimiento2 <> '' && $p_fechaNacimiento3 <> '' && $p_fechaNacimiento4 <> '' && $p_fechaNacimiento5 <> '') {
            $op      = 12;
            $edadTmp = $this->CalculaEdad($p_fechaNacimiento_tomador);
            $edad1 = $this->CalculaEdad($p_fechaNacimiento1);
            $edad2 = $this->CalculaEdad($p_fechaNacimiento2);
            $edad3 = $this->CalculaEdad($p_fechaNacimiento3);
            $edad4 = $this->CalculaEdad($p_fechaNacimiento4);
            $edad5 = $this->CalculaEdad($p_fechaNacimiento5);
            $sql         = "";
            
            $sql .= "SELECT producto.sumaAsegurada,producto.nombre as nombre, producto.idProducto as idProducto, plan.idPlan ,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
	    $sql .= "plan_precio.precioAnual as anual,producto.descripcion, ";
			
			$sql .= "promociones.valorAplicable,promociones.nombre as promoNombre, ";
            $sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "inner join producto_Mediador on producto_Mediador.idProducto = producto.idProducto  ";
			$sql .= "left join promociones on promociones.idProducto = producto.idProducto ";
            $sql .= "WHERE edaddesde <= $edad1 and $edad1 <=edadHasta and producto_Mediador.idMediador = {$_COOKIE['idMediador']} AND  producto.idCategoria = $p_categoria and plan_precio.idPais = $p_idPais ";             
            
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql .= "GROUP by producto.idProducto  ";
            $sql .= "UNION ";
            $sql .= "SELECT producto.sumaAsegurada,producto.nombre as nombr, producto.idProducto as idpro, plan.idPlan as idPlan,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
			
			$sql .= "plan_precio.precioAnual as anual, "; 
            $sql .= "producto.descripcion, ";
			
			$sql .= "promociones.valorAplicable,promociones.nombre as promoNombre, ";
            $sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "inner join producto_Mediador on producto_Mediador.idProducto = producto.idProducto  ";
			$sql .= "left join promociones on promociones.idProducto = producto.idProducto ";
            $sql .= "WHERE edaddesde <= $edad2 and $edad2 <=edadHasta and producto_Mediador.idMediador = {$_COOKIE['idMediador']} AND  producto.idCategoria = $p_categoria and plan_precio.idPais = $p_idPais ";             
                      
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql .= "GROUP by producto.idProducto  ";
             $sql .= "UNION ";
            $sql .= "SELECT producto.sumaAsegurada,producto.nombre as nombr, producto.idProducto as idpro, plan.idPlan as idPlan,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
			
			$sql .= "plan_precio.precioAnual as anual, "; 
            $sql .= "producto.descripcion, ";
			
			$sql .= "promociones.valorAplicable,promociones.nombre as promoNombre, ";
            $sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "inner join producto_Mediador on producto_Mediador.idProducto = producto.idProducto  ";
			$sql .= "left join promociones on promociones.idProducto = producto.idProducto ";
            $sql .= "WHERE edaddesde <= $edad3 and $edad3 <=edadHasta and producto_Mediador.idMediador = {$_COOKIE['idMediador']} AND  producto.idCategoria = $p_categoria and plan_precio.idPais = $p_idPais ";             
                      
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql .= "GROUP by producto.idProducto  ";
            $sql .= "UNION ";
            $sql .= "SELECT producto.sumaAsegurada,producto.nombre as nombr, producto.idProducto as idpro, plan.idPlan as idPlan,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
			
			$$sql .= "plan_precio.precioAnual as anual, "; 
            $sql .= "producto.descripcion, ";
			
			$sql .= "promociones.valorAplicable,promociones.nombre as promoNombre, ";
            $sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "inner join producto_Mediador on producto_Mediador.idProducto = producto.idProducto  ";
			$sql .= "left join promociones on promociones.idProducto = producto.idProducto ";
            $sql .= "WHERE edaddesde <= $edad4 and $edad4 <=edadHasta and producto_Mediador.idMediador = {$_COOKIE['idMediador']} AND  producto.idCategoria = $p_categoria and plan_precio.idPais = $p_idPais ";             
                      
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql .= "GROUP by producto.idProducto  ";
            $sql .= "UNION ";
            $sql .= "SELECT producto.sumaAsegurada,producto.nombre as nombr, producto.idProducto as idpro, plan.idPlan as idPlan,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
			
			$sql .= "plan_precio.precioAnual as anual, "; 
            $sql .= "producto.descripcion, ";
			
			$sql .= "promociones.valorAplicable,promociones.nombre as promoNombre, ";
            $sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "inner join producto_Mediador on producto_Mediador.idProducto = producto.idProducto  ";
			$sql .= "left join promociones on promociones.idProducto = producto.idProducto ";
            $sql .= "WHERE edaddesde <= $edad5 and $edad5 <=edadHasta and producto_Mediador.idMediador = {$_COOKIE['idMediador']} AND  producto.idCategoria = $p_categoria and plan_precio.idPais = $p_idPais ";             
                      
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql .= "GROUP by producto.idProducto  ";
             $sql .="";
            
           }
           
           if ($p_fechaNacimiento1 <> '' && $p_fechaNacimiento_tomador == '' && $p_fechaNacimiento2 <> '' && $p_fechaNacimiento3 <> '' && $p_fechaNacimiento4 <> '' && $p_fechaNacimiento5 <> ''&& $p_fechaNacimiento6 <> '') {
            $op      = 13;
            $edadTmp = $this->CalculaEdad($p_fechaNacimiento_tomador);
            $edad1 = $this->CalculaEdad($p_fechaNacimiento1);
            $edad2 = $this->CalculaEdad($p_fechaNacimiento2);
            $edad3 = $this->CalculaEdad($p_fechaNacimiento3);
            $edad4 = $this->CalculaEdad($p_fechaNacimiento4);
            $edad5 = $this->CalculaEdad($p_fechaNacimiento5);
            $edad6 = $this->CalculaEdad($p_fechaNacimiento6);
            $sql         = "";
            
            $sql .= "SELECT producto.sumaAsegurada,producto.nombre as nombre, producto.idProducto as idProducto, plan.idPlan ,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
	    $sql .= "plan_precio.precioAnual as anual,producto.descripcion, ";
			
			$sql .= "promociones.valorAplicable,promociones.nombre as promoNombre, ";
            $sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "inner join producto_Mediador on producto_Mediador.idProducto = producto.idProducto  ";
			$sql .= "left join promociones on promociones.idProducto = producto.idProducto ";
            $sql .= "WHERE edaddesde <= $edad1 and $edad1 <=edadHasta and producto_Mediador.idMediador = {$_COOKIE['idMediador']} AND  producto.idCategoria = $p_categoria and plan_precio.idPais = $p_idPais ";             
            
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql .= "GROUP by producto.idProducto  ";
            $sql .= "UNION ";
            $sql .= "SELECT producto.sumaAsegurada,producto.nombre as nombr, producto.idProducto as idpro, plan.idPlan as idPlan,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
			
			$sql .= "plan_precio.precioAnual as anual, "; 
            $sql .= "producto.descripcion, ";
			
			$sql .= "promociones.valorAplicable,promociones.nombre as promoNombre, ";
            $sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "inner join producto_Mediador on producto_Mediador.idProducto = producto.idProducto  ";
			$sql .= "left join promociones on promociones.idProducto = producto.idProducto ";
            $sql .= "WHERE edaddesde <= $edad2 and $edad2 <=edadHasta and producto_Mediador.idMediador = {$_COOKIE['idMediador']} AND  producto.idCategoria = $p_categoria and plan_precio.idPais = $p_idPais ";             
                      
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql .= "GROUP by producto.idProducto  ";
             $sql .= "UNION ";
            $sql .= "SELECT producto.sumaAsegurada,producto.nombre as nombr, producto.idProducto as idpro, plan.idPlan as idPlan,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
			
			$sql .= "plan_precio.precioAnual as anual, "; 
            $sql .= "producto.descripcion, ";
			
			$sql .= "promociones.valorAplicable,promociones.nombre as promoNombre, ";
            $sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "inner join producto_Mediador on producto_Mediador.idProducto = producto.idProducto  ";
			$sql .= "left join promociones on promociones.idProducto = producto.idProducto ";
            $sql .= "WHERE edaddesde <= $edad3 and $edad3 <=edadHasta and producto_Mediador.idMediador = {$_COOKIE['idMediador']} AND  producto.idCategoria = $p_categoria and plan_precio.idPais = $p_idPais ";             
                      
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql .= "GROUP by producto.idProducto  ";
            $sql .= "UNION ";
            $sql .= "SELECT producto.sumaAsegurada,producto.nombre as nombr, producto.idProducto as idpro, plan.idPlan as idPlan,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
			
			$sql .= "plan_precio.precioAnual as anual, "; 
            $sql .= "producto.descripcion, ";
			
			$sql .= "promociones.valorAplicable,promociones.nombre as promoNombre, ";
            $sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "inner join producto_Mediador on producto_Mediador.idProducto = producto.idProducto  ";
			$sql .= "left join promociones on promociones.idProducto = producto.idProducto ";
            $sql .= "WHERE edaddesde <= $edad4 and $edad4 <=edadHasta and producto_Mediador.idMediador = {$_COOKIE['idMediador']} AND  producto.idCategoria = $p_categoria and plan_precio.idPais = $p_idPais ";             
                      
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql .= "GROUP by producto.idProducto  ";
            $sql .= "UNION ";
            $sql .= "SELECT producto.sumaAsegurada,producto.nombre as nombr, producto.idProducto as idpro, plan.idPlan as idPlan,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
			
			$sql .= "plan_precio.precioAnual as anual, "; 
            $sql .= "producto.descripcion, ";
			
			$sql .= "promociones.valorAplicable,promociones.nombre as promoNombre, ";
            $sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "inner join producto_Mediador on producto_Mediador.idProducto = producto.idProducto  ";
			$sql .= "left join promociones on promociones.idProducto = producto.idProducto ";
            $sql .= "WHERE edaddesde <= $edad5 and $edad5 <=edadHasta and producto_Mediador.idMediador = {$_COOKIE['idMediador']} AND  producto.idCategoria = $p_categoria and plan_precio.idPais = $p_idPais ";             
                      
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql .= "GROUP by producto.idProducto  ";
            $sql .= "UNION ";
            $sql .= "SELECT producto.sumaAsegurada,producto.nombre as nombr, producto.idProducto as idpro, plan.idPlan as idPlan,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
			
			$sql .= "plan_precio.precioAnual as anual, "; 
            $sql .= "producto.descripcion, ";
			
			$sql .= "promociones.valorAplicable,promociones.nombre as promoNombre, ";
            $sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "inner join producto_Mediador on producto_Mediador.idProducto = producto.idProducto  ";
			$sql .= "left join promociones on promociones.idProducto = producto.idProducto ";
            $sql .= "WHERE edaddesde <= $edad6 and $edad6 <=edadHasta and producto_Mediador.idMediador = {$_COOKIE['idMediador']} AND  producto.idCategoria = $p_categoria and plan_precio.idPais = $p_idPais ";             
                      
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql .= "GROUP by producto.idProducto  ";
             $sql .="";
            
           }
        
       //echo "op $op"  ."<br>";
       //echo "sql $sql" ."<br>";
      // echo $p_categoria;
       //echo $_COOKIE['idMediador'];
       //echo "edadTmp $edadTmp";
      //echo "fechaN1 $p_fechaNacimiento1";
      // echo "fechaNacTM $p_fechaNacimiento_tomador";
       
       //exit;
       
      return $this->con->query($sql);
        
    }
    
    
    
    
    function enviarCorreo($code,$nombre, $correo,$descripcion,$categoria,$asegurados,$mensual,$telefono,$moneda,$ambito,$trayectoria,$ruta,$url,$producto,$mail,$anual,$nombrepdf,$show_cot = false)
    {
        
        require("mail/class.phpmailer.php");
        require("mail/class.smtp.php");
        //Recibir todos los par?etros del formulario
        $para    = $correo;
        //$anual = $mensual*12;
        $asunto  = "Cotizacion ";
        switch($categoria){
            case 1:
                $cat = 'Salud';
            break;
            case 2:
                $cat = 'Repatriación';
            break;
            case 3:
                $cat = 'Estudiantes';
            break;
            case 4:
                $cat = 'Salud + reembolso';
            break;
            case 5:
                $cat = 'Salud internacional';
            break;

        }
        $cuestionario = '';
        $cobertura = '';
        $solicitud = '';
        $count = 0;
        $str = '';
        $array = str_split($ruta);
        foreach($array as $char)
            if($char == '/')
                $count++;
        $count2 = 0;        
        foreach($array as $char){
            if($count === $count2){
                $cuestionario .= $str;
                $cuestionario .= 'Cuestionario medico.pdf';
                $cobertura .=  $str;
                $cobertura.='Cobertura.pdf';
                $solicitud .=  $str;
                $solicitud.='Solicitud.pdf';
            break;
            }
            else{
                if($char == '/')
                    $count2++;
                $str.=$char;
            }
        }
        $mensaje = '
        <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin">
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
                                        <td id="logo">
                                            <a href="https://www.hi-broker.com/" target="_blank">
                                                <img src="https://hi-broker.com/wp-content/uploads/2021/07/pages-2.png" alt="Rose & Pages">
                                            </a>
                                        </td>
                                        <td id="contact" style="text-align:right">
                                            <h4 style="background-color: #4228B4; float: right; color: white; border-radius: 12px; margin: auto;">
                                                <img style="padding: 13px 5px 7px 10px; float:left;" src="https://www.hi-broker.com/assets/icons/phone_26px.png" alt="">
                                                <p style="float: right; padding-right:10px ;" >+34 665 107 108</p>
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
                                                A continuación te detallamos la cotización de tu seguro <b>('.$producto.') de '.$cat.' para ('.$asegurados.') asegurado(s).</b>
                                                <b>Puedes contactar con nosotros para aclarar cualquier consulta, duda o para contratar tu póliza, estés donde estés.</b>
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
                                <tbody style="margin-top:15px; border-spacing: 5px;">
                                    <tr>
                                        <td style="width:600px;font-size: 14pt;">
                                            <p><b>¿Qué tipo de póliza estas contratando?</b></p>
                                            <div style="margin-left: 18px;margin-right: 18px; text-align: justify;">
                                                <p style="font-size: 12pt;">'.$descripcion.'</p>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;">
                                            <button style="background:#3D9FF2; border: none; border-radius: 12px;"  onclick="window.location.href= www.google.com ">
                                                <img style="float: left; margin-top: 9px; margin-right: 5px; padding-left: 5px;" src="https://www.hi-broker.com/assets/icons/below_32px.png" alt=""/>
                                                <a style="float: right;text-decoration:none;" target="_blank" href="'.$cobertura.'">
                                                    <p style="font-weight: bold; text-align:center;color:white;font-size:10.5pt; padding: 2px 5px 2px 5px;">COBERTURAS DE LA PÓLIZA</p>
                                                </a>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tbody style="margin-top:15px;">
                                    <tr>
                                    <div id="flexrow" style="">
                                        <h3 class="flexcol-1" >¿Qué aseguradora la respalda?</h3>
                                        <h3 class="flexcol-2" >¿En qué país puedo hacer uso de mi póliza?</h3>
                                    </div>
                                    <div  style=" margin-top: -25px; width:100% ">
                                        <div style="display:flex; padding-right:15px;">
                                            <p style="flex:1;font-size:12pt;background-color:#3D9FF2;padding: 8px 8px 8px 8px; color: white;width:50%;margin-right:15px;">
                                            '.$trayectoria.'
                                            </p>
                                            <p style="flex:1;font-size:12pt;background-color:#3D9FF2;padding: 8px 8px 8px 8px;color: white;width:50%;margin-left:15px;">
                                            '.$ambito.'
                                            </p>
                                        </div>      
                                    </div>
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
                                                <p style="font-weight:bold;font-size:14pt;">¿Cómo puedo contratarla?</p>
                                                <p style="font-weight:bold;font-size:12pt; text-align: justify;">Para solicitar tu seguro es necesario que nos envíes los siguientes requisitos a la siguiente dirección de correo:</p>
                                                <p style="margin-left: 18px;margin-right: 18px;font-size:11pt;text-align: justify;"><span style="color:rgb(255,97,97)">●</span> Documento de identidad del tomador y sus asegurados (Pasaporte, cédula, NIE, DNI u otros)</p>
                                                <p style="margin-left: 18px;margin-right: 18px;font-size:11pt;text-align: justify;"><span style="color:rgb(255,97,97)">●</span> Confirmar el método con el cuál vas a pagar. </p>
                                                <p style="margin-left: 18px;margin-right: 18px;font-size:11pt;text-align: justify;"><span style="color:rgb(255,97,97)">●</span> Planilla de solicitud y cuestionario médico en el caso de contratar un seguro de salud. </p>
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
                                            <div id="container">
                                            <div class="col">
                                                <button style="background:#3D9FF2; border: none; border-radius: 12px;" href="">
                                                    <img class="image1" src="https://www.hi-broker.com/assets/icons/below_32px.png" alt=""/>
                                                    <a style="float: right;text-decoration:none;" target="_blank" href="'.$solicitud.'">
                                                        <p>SOLICITUD DE SEGURO</p>
                                                    </a>
                                                </button>
                                            </div>
                                            <div class="col">
                                                <button style="background:#3D9FF2;border-radius: 12px; border: none; " href="">
                                                    <img class="image1" src="https://www.hi-broker.com/assets/icons/below_32px.png" alt=""/>
                                                    <a style="float: right;text-decoration:none;" target="_blank" href="'.$cuestionario.'">
                                                        <p>CUESTIONARIO MÉDICO</p>
                                                    </a>
                                                </button>
                                            </div>
                                        </div>
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
                                            <td style="width:600px;font-size: 14pt;">
                                                <p><b>¿Cuáles son los centros médicos a los que puedo asistir?</b></p>
                                                <div style="text-align: justify; margin-left: 18px;margin-right: 18px;">
                                                    <p style="font-size: 12pt;">Antes de dirigirte al centro de salud, deberás consultar si se encuentra afiliado a tu seguro. De lo contrario debes confirmar si tu póliza admite reembolso de gastos.</p>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center;">
                                                <button style="width: 300px; background:#3D9FF2; border: none;border-radius: 12px; display: inline-flex; " href="">
                                                <img style=" margin-top: 9px; margin-right: 5px; padding-top: 5px; padding-left: 5px; " src="https://www.hi-broker.com/assets/icons/marker_32px.png" alt=""/>
                                                <a target="_blank" style="text-decoration:none;" href="'.$url.'">
                                                    <p style="font-weight: bold; text-align:center;color:white;font-size:10.5pt; padding: 2px 5px 2px 5px;">LISTADO DE CENTROS DE SALUD
                                                        Y MÉDICOS  AFILIADOS
                                                    </p>
                                                </a>
                                            </button>
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
                                            <td style="width:600px;font-size: 14pt;">
                                                <p><b>¿Cuánto  voy a pagar por mi seguro?</b></p>
                                                <div style="margin-left: 18px;margin-right: 18px;">
                                                    <table id="info">
                                                        <tr>
                                                            <td class="no color2">
                                                                <p style="font-size: 12pt;font-weight: bold; color: black;line-height:0px;">Prima Mensual: </p>
                                                            
                                                            </td>
                                                            <td class="desc color2">
                                                                <p style="font-size: 12pt;font-weight: bold; color: black;line-height:0px;">'.number_format($mensual,2,",",".").''.$moneda.' </p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="no color2">
                                                                <p style="font-size: 12pt; font-weight: bold; color: black; line-height:0px;">Prima Anual:  </p>
                                                            </td>
                                                            <td class="desc color2">
                                                                <p style="font-size: 12pt;font-weight: bold; color: black;line-height:0px;">'.number_format($anual,2,",",".").''.$moneda.'</p>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
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
                                            <td>
                                                <div style="margin-left: 18px;margin-right: 18px; ">
                                                    <p>Teléfono: <b>+'.$telefono.'</b> </p>
                                                    <p>Email: <b>'.$mail.'</b></p>
                                                </div>
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

</html>'; // Cerramos la comilla simple. Con la comilla simple y el punto y coma se finaliza el cuerpo del mensaje html.  

						
$to      = $para;
$from = 'cotizaciones@hi-broker.com';
$cc = 'Oquijada@rose-pages.com';
$subject = 'Cotizacion - Hi-Broker';
$message = $mensaje;
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
// Create email headers
$headers .= 'From: '.$from."\r\n".
    'Reply-To: '.$to."\r\n" .
    'Cc: '.$cc."\r\n" .
    'X-Mailer: PHP/' . phpversion();


if(@mail($to, $subject, $message, $headers)){
    if ($show_cot) {
        return true;
    }
   echo "<br><center><b>Se ha enviado un correo electronico a " . $para . " con los detalles de su registro</b></center><br>";
}else{
    if ($show_cot) {
        return false;
    }
   echo "<br><center><b>Error al enviar mensaje a la siguiente direcci&oacute;n: " . $correo . "</b></center><br>";
}
        
      
        
    }
    
    
    function aplicar_transaccion()
    {
        $this->con->commit();
        $this->con->close();
    }
    
    function cancelar_transaccion()
    {
        $this->con->rollback();
        $this->con->close();
    }
    
    
    
    /******************************************VALIDACIONES*******************************************/
    
    function obtenerPromo($idPromocion)
     {
		$imgPromo = "";
		switch ($idPromocion) {
			case "Promocion1":
			   $imgPromo = "Incremento 8%";
                           break;
			case "Promocion2":
			   $imgPromo = "Descuento 10%";
                           break;
		}
		
		return $imgPromo;
		
     }
    
    
    function obtenerImagen($nombre)
    {
        $imagen = "";
        switch ($nombre) {
            case "LATINCARE RESIDENTE":
                $imagen = "https://hi-broker.com/wp-content/uploads/2019/09/Asisa..png";
                break;
            case "REPATRIACI??N Y DECES":
                $imagen = "https://hi-broker.com/wp-content/uploads/2019/09/Aegon..png";
                break;
            case "DKV SELECCION MAYORE":
                $imagen = "https://hi-broker.com/wp-content/uploads/2019/09/DKV..png";
                break;
            case "ADESLAS SENIOR MAYOR":
                $imagen = "https://hi-broker.com/wp-content/uploads/2019/09/adeslas99.png";
                break;
            case "ALUMNUSCARE":
                $imagen = "https://hi-broker.com/wp-content/uploads/2019/09/Generali..png";
                break;
            case "MERCANTIL SALUD 10.000$":
                $imagen = "https://hi-broker.com/wp-content/uploads/2019/09/mercantil-225x152.png";
                break;
             case "HC 2.000$ MERCANTIL":
                $imagen = "https://hi-broker.com/wp-content/uploads/2019/09/mercantil-225x152.png";
                break;
            case "DKV ELITE SIN COPAGO":
                $imagen = "https://hi-broker.com/wp-content/uploads/2019/09/DKV..png";
                break;
            case "ADESLAS PLENA PLUS":
                $imagen = "https://hi-broker.com/wp-content/uploads/2019/09/adeslas99.png";
                break;
            case "SANITAS STUDENTS":
                $imagen = "https://hi-broker.com/wp-content/uploads/2019/09/Sanitas..png";
                break;
            case "MERCANTIL SALUD 5.000$":
                $imagen = "https://hi-broker.com/wp-content/uploads/2019/09/mercantil-225x152.png";
                break;
            case "SANITAS MAS SALUD":
                $imagen = "https://hi-broker.com/wp-content/uploads/2019/09/Sanitas..png";
                break;
            case "HISPANA SALUD 50.000$":
                $imagen = "https://hi-broker.com/wp-content/uploads/2019/09/Hispana.png";
                break;
            case "LIBERTY SALUD":
                $imagen = "https://hi-broker.com/wp-content/uploads/2019/09/Liberty..png";
                break;
            case "DKV MUNDISALUD CLASSIC":
                $imagen = "https://hi-broker.com/wp-content/uploads/2019/09/DKV..png";
                break;
            case "DKV MUNDISALUD ELITE":
                $imagen = "https://hi-broker.com/wp-content/uploads/2019/09/DKV..png";
                break;
            case "REPATRIACION Y DECES":
                $imagen = "https://hi-broker.com/wp-content/uploads/2019/09/AsocEuropea.png";
                break;
            case "MERCANTIL SALUD 30.000$":
                $imagen = "https://hi-broker.com/wp-content/uploads/2019/09/mercantil-225x152.png";
                break;
            case "MERCANTIL SALUD 50.000$":
                $imagen = "https://hi-broker.com/wp-content/uploads/2019/09/mercantil-225x152.png";
                break;
            case "MERCANTIL SALUD 5.000$":
                $imagen = "https://hi-broker.com/wp-content/uploads/2019/09/mercantil-225x152.png";
                break;
            case "AFINITI BANESCO 5.000$":
                $imagen = "https://hi-broker.com/wp-content/uploads/2019/09/Banesco.png";
                break;
            case "AFINITI BANESCO 10.000$":
                $imagen = "https://hi-broker.com/wp-content/uploads/2019/09/Banesco.png";
                break;
            case "AFINITI BANESCO 20.000$":
                $imagen = "https://hi-broker.com/wp-content/uploads/2019/09/Banesco.png";
                break;
            case "AFINITI BANESCO 50.000$":
                $imagen = "https://hi-broker.com/wp-content/uploads/2019/09/Banesco.png";
                break;
            case "AFINITI BANESCO 15.000$":
                $imagen = "https://hi-broker.com/wp-content/uploads/2019/09/Banesco.png";
                break;
            case "SALUD UNIVERSITAS 5.000$":
                $imagen = "https://hi-broker.com/wp-content/uploads/2019/09/Universitas.png";
                break;
            case "SEGUROS UNIVERSITAS 10.000$":
                $imagen = "https://hi-broker.com/wp-content/uploads/2019/09/Universitas.png";
                break;
            case "SEGUROS UNIVERSITAS 20.000$":
                $imagen = "https://hi-broker.com/wp-content/uploads/2019/09/Universitas.png";
                break;
            case "SEGUROS UNIVERSITAS 30.000$":
                $imagen = "https://hi-broker.com/wp-content/uploads/2019/09/Universitas.png";
                break;
            case "SEGUROS UNIVERSITAS PREMIUM 15.000$":
                $imagen = "https://hi-broker.com/wp-content/uploads/2019/09/Universitas.png";
                break;
            case "SEGUROS UNIVERSITAS 25.000$":
                $imagen = "https://hi-broker.com/wp-content/uploads/2019/09/Universitas.png";
                break;
            case "SEGUROS UNIVERSITAS 70.000$":
                $imagen = "https://hi-broker.com/wp-content/uploads/2019/09/Universitas.png";
                break;
            case "SEGUROS UNIVERSITAS 200.000$":
                $imagen = "https://hi-broker.com/wp-content/uploads/2019/09/Universitas.png";
                break;
            case "MERCANTIL SALUD 100.000 $":
                $imagen = "https://hi-broker.com/wp-content/uploads/2019/09/mercantil-225x152.png";
                break;
            case "NUEVA MUTUA SANITARIA":
                $imagen = "https://hi-broker.com/wp-content/uploads/2022/05/NuevaMutuaVLogo.png";
                break;
            case "MAPFRE SALUD 5.000$":
                $imagen = "https://pages.hi-broker.com/wp-content/uploads/2022/05/MapfreLogo.png";
                break;            
            case "MAPFRE SALUD 10.000$":
                $imagen = "https://pages.hi-broker.com/wp-content/uploads/2022/05/MapfreLogo.png";
                break;    
            case "MAPFRE SALUD 20.000$":
                $imagen = "https://pages.hi-broker.com/wp-content/uploads/2022/05/MapfreLogo.png";
                break;
            case "MAPFRE SALUD 50.000$":
                $imagen = "https://pages.hi-broker.com/wp-content/uploads/2022/05/MapfreLogo.png";
                break;
            case "MAPFRE SALUD 100.000$":
                $imagen = "https://pages.hi-broker.com/wp-content/uploads/2022/05/MapfreLogo.png";
                break;
            case "MAPFRE SALUD 200.000$":
                $imagen = "https://pages.hi-broker.com/wp-content/uploads/2022/05/MapfreLogo.png";
                break;
            case "MAPFRE SALUD 500.000$":
                $imagen = "https://pages.hi-broker.com/wp-content/uploads/2022/05/MapfreLogo.png";
                break;                 
             case "SEGUROS CARACAS 20.000 $":
                $imagen = "https://pages.hi-broker.com/wp-content/uploads/2022/05/SegurosCaracasLogo.png";
                break;
             case "SEGUROS CARACAS 50.000 $":
                $imagen = "https://pages.hi-broker.com/wp-content/uploads/2022/05/SegurosCaracasLogo.png";
                break;
             case "SEGUROS CARACAS 100.000 $":
                $imagen = "https://pages.hi-broker.com/wp-content/uploads/2022/05/SegurosCaracasLogo.png";
                break;
             case "SEGUROS CARACAS 200.000 $":
                $imagen = "https://pages.hi-broker.com/wp-content/uploads/2022/05/SegurosCaracasLogo.png";
                break;
             case "SEGUROS CARACAS 500.000 $":
                $imagen = "https://pages.hi-broker.com/wp-content/uploads/2022/05/SegurosCaracasLogo.png";
                break;
             case "ASISTENSI":
                $imagen = "https://pages.hi-broker.com/wp-content/uploads/2022/05/AsistensiLogo.png";
                break;
             case "ASISTENSI PLUS":
                $imagen = "https://pages.hi-broker.com/wp-content/uploads/2022/05/AsistensiLogo.png";
                break; 
        }
        return $imagen;
    }
    
    function limpiarString($texto)
    {
        $textoLimpio = preg_replace('([^A-Za-z0-9])', ' ', $texto);
        return $textoLimpio;
    }
    
    function limpiarCorreo($correo)
    {
        $correoLimpio = preg_replace('([^-@._A-Za-z0-9])', '', $correo);
        return $correoLimpio;
    }
    
    function limpiarUser($user)
    {
        $textoLimpio = preg_replace('([^A-Za-z0-9])', '', $user);
        return $textoLimpio;
    }
    
    function limpiarPw($pw)
    {
        $textoLimpio = preg_replace('([^!#$%&/*.,A-Za-z0-9])', '', $pw);
        return $textoLimpio;
    }
    
    function limpiarNombre($texto)
    {
        $textoLimpio = preg_replace('([^A-Za-z ])', '', $texto);
        return $textoLimpio;
    }
    
    function limpiarRif($nacionalidad, $number)
    {
        $numberLimpio = preg_replace('([^0-9])', '', $number);
        $persJuridica = preg_replace('([^J,V,E])', '', $nacionalidad);
        if (strlen($numberLimpio) >= 7):
            return $persJuridica . "-" . $numberLimpio;
        else:
            header("Location: index.php?mensaje=errorDatos");
        endif;
    }
    
    function limpiarId($id)
    {
        $numberLimpio = preg_replace('([^0-9])', '', $id);
        if (strlen($numberLimpio) >= 0):
            return $numberLimpio;
        endif;
    }
    
    function limpiarNumero($numero)
    {
        $numberLimpio = preg_replace('([^0-9])', '', $numero);
        return $numberLimpio;
    }
    
    function limpiarFechaNac($fecha)
    {
        
        $fechaLimpio = preg_replace('([^-/0-9])', '', $fecha);
        $fecha_final = $this->formatoFecha($fechaLimpio);
        
        return $fecha_final;
        
    }
    
    function formatoFecha($fecha)
    {
        $fechaLimpio2 = date_create($fecha);
        $fechaLimpio3 = date_format($fechaLimpio2, "Y-m-d");
        
        return $fechaLimpio3;
        
    }
    
    function CalculaEdad($fecha)
    {
        if ($fecha == '') {
            return 0;
        } else {
            list($Y, $m, $d) = explode("-", $fecha);
            return (date("md") < $m . $d ? date("Y") - $Y - 1 : date("Y") - $Y);
        }
        
    }
    
    
    /******************************************VALIDACIONES*******************************************/

    function buscarMediador($useranme, $password)
    {
       $datos = "SELECT validarMediador('$useranme','$password')";
       return $result = $this->con->query($datos);
       
    }

    function traerMediador($user,$pass)
    {

       $this->con->query("SET @p0 = '".$user."' ");
       $this->con->query("SET @p1 = '".$pass."' ");
       $datos = $this->con->prepare("CALL traerMediador(@p0,@p1)");
       $datos->execute();
       return $datos->get_result();
    }
    
    function traerRuta($nombre,$check){
      $this->con->query("SET @p1 = '".$nombre."' ");
      $valor = 1;
      if($check){
        $this->con->query("SET @p2 = '".$valor."'  ");
        $datos  = $this->con->prepare("CALL traerRuta(@p1,@p2)");
      }
      else{
        $valor = 0;
        $this->con->query("SET @p2 = '".$valor."'  ");
        $datos  = $this->con->prepare("CALL traerRuta(@p1,@p2)");
      }
      $datos->execute();
      return $datos->get_result();
    }
    
    
    function traerIdMediador(){
      $this->con->query("SET @p1 = '".$_COOKIE['nombre']."' ");
      $datos  = $this->con->prepare("CALL traerIdMediador(@p1)");
      $datos->execute();
      return $datos->get_result();
    }
    
    function traerDescripcion($producto){
      $this->con->query("SET @p1 = '".$producto."' ");
      $datos  = $this->con->prepare("CALL traerDescripcion(@p1)");
      $datos->execute();
      return $datos->get_result();
    }
    
    function traerTrayectoria($producto){
    $this->con->query("SET @p1 = '".$producto."' ");
      $datos  = $this->con->prepare("CALL traerTrayectoria(@p1)");
      $datos->execute();
      return $datos->get_result();
    }

    function traerAmbitoTerritorial($producto){
        $this->con->query("SET @p1 = '".$producto."' ");
        $datos  = $this->con->prepare("CALL traerAmbitoTerritorial(@p1)");
        $datos->execute();
        return $datos->get_result();
    }
    
    function traerDatos($idMediador){
        $this->con->query("SET @p1 = '".$idMediador."' ");
        $datos  = $this->con->prepare("CALL traerDatos(@p1)");
        $datos->execute();
        return $datos->get_result();
    }
    
}

?>