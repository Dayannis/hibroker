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
  
        $sql = "INSERT INTO consulta_web (idPais,idProvincia,nombre,apellido,fechaNacimiento,movil,email,nroFamiliares,tomador) VALUES ($pais, $provincia,'". $nombre ."', '". $apellido ."', '". $fecha_nac ."', '". $movil ."','". $email ."', ". $familiares .", ". $tomador .")";
        
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
        $sql .= " plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, (plan_precio.precio) * 12 as anual, IF (plan_precio.copago=0,'NO','SI') as copago FROM ";
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


    
    function buscarProductosNew($p_categoria,$p_idPais, $p_idProvincia, $p_fechaNacimiento_tomador, $p_fechaNacimiento1, $p_fechaNacimiento2, $p_fechaNacimiento3, $p_fechaNacimiento4, $p_fechaNacimiento5, $p_fechaNacimiento6)
    {
        
        $sql     = "";
        $edadTmp = 0;
        $op      = 0;
        
        //Caso 1 fecha con tomador
        if ($p_fechaNacimiento_tomador <> '' && $p_fechaNacimiento1 == '') {
            $op      = 1;
            $edadTmp = $this->CalculaEdad($p_fechaNacimiento_tomador);
            
            $sql .= "select consulta.nombre, consulta.idProducto, consulta.idPlan, consulta.nombrePlan, consulta.edadDesde, consulta.edadHasta, ";
            $sql .= "sum(consulta.mensual) as mensual, sum(consulta.anual) as anual, consulta.descripcion, consulta.copago from  ";
            $sql .= "(SELECT producto.nombre as nombre, producto.idProducto as idProducto, plan.idPlan ,plan.Nombre as nombrePlan, ";
            $sql .= "plan_precio.edadDesde as edadDesde, plan_precio.edadHasta as edadHasta , (plan_precio.precio) as mensual, ";
 
            $sql .= "(CASE "; 
            $sql .= " WHEN plan_precio.precio <= 0 then plan_precio.precioAnual ";
            $sql .= " WHEN plan_precio.precioAnual <> NULL THEN plan_precio.precioAnual ";
            $sql .= " ELSE plan_precio.precio * 12 ";
            $sql .= "END) as anual, ";


            $sql .= "producto.descripcion as descripcion, IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "WHERE edaddesde <= $edadTmp and $edadTmp <=edadHasta ";
            
            $sql .= " and producto.idCategoria = $p_categoria AND plan_precio.idPais = $p_idPais ";
            
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql .= "GROUP by producto.idProducto) AS consulta ";
            $sql .= "GROUP by consulta.idProducto ORDER BY consulta.anual";
            
            
        }
        
        //Caso 2 un solo afiliado que no es el tomador
        if ($p_fechaNacimiento1 <> '' && $p_fechaNacimiento_tomador == '') {
            $op      = 2;
            $edadTmp = $this->CalculaEdad($p_fechaNacimiento1);
            
            $sql .= "select consulta.nombre, consulta.idProducto, consulta.idPlan, consulta.nombrePlan, consulta.edadDesde, consulta.edadHasta, ";
            $sql .= "sum(consulta.mensual) as mensual, sum(consulta.anual) as anual, consulta.descripcion, consulta.copago from  ";
            $sql .= "(SELECT producto.nombre as nombre, producto.idProducto as idProducto, plan.idPlan ,plan.Nombre as nombrePlan, ";
            $sql .= "plan_precio.edadDesde as edadDesde, plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
			
			$sql .= "(CASE "; 
            $sql .= " WHEN plan_precio.precio <= 0 then plan_precio.precioAnual ";
            $sql .= " WHEN plan_precio.precioAnual <> NULL THEN plan_precio.precioAnual ";
            $sql .= " ELSE plan_precio.precio * 12 ";
            $sql .= "END) as anual, ";
			
            $sql .= "producto.descripcion as descripcion, IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "WHERE edaddesde <= $edadTmp and $edadTmp <=edadHasta ";
            
            $sql .= "and producto.idCategoria = $p_categoria AND plan_precio.idPais = $p_idPais ";
            
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql .= "GROUP by producto.idProducto) AS consulta ";
            $sql .= "GROUP by consulta.idProducto ORDER BY consulta.anual ";
            
            
        }
        //Caso 3 (2 afiliados incluyendo al tomador)
        if ($p_fechaNacimiento1 <> '' && $p_fechaNacimiento2 == '' && $p_fechaNacimiento_tomador <> '') {
            $op          = 3;
            $edadTomador = $this->CalculaEdad($p_fechaNacimiento_tomador);
            $edad1       = $this->CalculaEdad($p_fechaNacimiento1);
            $edad2       = $this->CalculaEdad($p_fechaNacimiento2);
            $edad3       = $this->CalculaEdad($p_fechaNacimiento3);
            $sql         = "";
            $sql .= "SELECT producto.nombre as nombre, producto.idProducto as idProducto, plan.idPlan ,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
			
			$sql .= "(CASE "; 
            $sql .= " WHEN plan_precio.precio <= 0 then plan_precio.precioAnual ";
            $sql .= " WHEN plan_precio.precioAnual <> NULL THEN plan_precio.precioAnual ";
            $sql .= " ELSE plan_precio.precio * 12 ";
            $sql .= "END) as anual, ";
			
            $sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "WHERE edaddesde <= $edadTomador and $edadTomador <=edadHasta AND  producto.idCategoria = $p_categoria and plan_precio.idPais = $p_idPais ";
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql .= "GROUP by producto.idProducto  ";
            $sql .= "UNION ";
            $sql .= "SELECT producto.nombre as nombr, producto.idProducto as idpro, plan.idPlan as idPlan,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
			
			$sql .= "(CASE "; 
            $sql .= " WHEN plan_precio.precio <= 0 then plan_precio.precioAnual ";
            $sql .= " WHEN plan_precio.precioAnual <> NULL THEN plan_precio.precioAnual ";
            $sql .= " ELSE plan_precio.precio * 12 ";
            $sql .= "END) as anual, ";
			
            $sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "WHERE edaddesde <= $edad1 and $edad1 <=edadHasta AND producto.idCategoria = $p_categoria and plan_precio.idPais = $p_idPais ";
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql .= "GROUP by producto.idProducto  ";
            $sql .= "UNION  ";
            $sql .= "SELECT producto.nombre as nombr, producto.idProducto as idpro, plan.idPlan as idPlan,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
			
			$sql .= "(CASE "; 
            $sql .= " WHEN plan_precio.precio <= 0 then plan_precio.precioAnual ";
            $sql .= " WHEN plan_precio.precioAnual <> NULL THEN plan_precio.precioAnual ";
            $sql .= " ELSE plan_precio.precio * 12 ";
            $sql .= "END) as anual, ";
			
            $sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "WHERE edaddesde <= $edad2 and $edad2 <=edadHasta AND producto.idCategoria = $p_categoria and plan_precio.idPais =  $p_idPais ";
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql .= "GROUP by producto.idProducto  ";
            
            
            $sql .= "UNION ";
            $sql .= "SELECT producto.nombre as nombr, producto.idProducto as idpro, plan.idPlan as idPlan,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
			
			$sql .= "(CASE "; 
            $sql .= " WHEN plan_precio.precio <= 0 then plan_precio.precioAnual ";
            $sql .= " WHEN plan_precio.precioAnual <> NULL THEN plan_precio.precioAnual ";
            $sql .= " ELSE plan_precio.precio * 12 ";
			$sql .= "END) as anual, ";
			
			$sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "WHERE edaddesde <= $edad3 and $edad3 <=edadHasta AND producto.idCategoria = $p_categoria and plan_precio.idPais = $p_idPais ";
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql .= " order by anual ";
            $sql .= "";
        }
        
        //Caso 4 (mas de afiliados incluyendo al tomador)
        if ($p_fechaNacimiento1 <> '' && $p_fechaNacimiento2 <> '' && $p_fechaNacimiento_tomador <> '') {
            $op          = 4;
            $edadTomador = $this->CalculaEdad($p_fechaNacimiento_tomador);
            $edad1       = $this->CalculaEdad($p_fechaNacimiento1);
            $edad2       = $this->CalculaEdad($p_fechaNacimiento2);
            $edad3       = $this->CalculaEdad($p_fechaNacimiento3);
            $edad4       = $this->CalculaEdad($p_fechaNacimiento4);
            $edad5       = $this->CalculaEdad($p_fechaNacimiento5);
            $edad6       = $this->CalculaEdad($p_fechaNacimiento6);
            $sql         = "";
            $sql .= "SELECT producto.nombre as nombre, producto.idProducto as idProducto, plan.idPlan ,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
			
			$sql .= "(CASE "; 
            $sql .= " WHEN plan_precio.precio <= 0 then plan_precio.precioAnual ";
            $sql .= " WHEN plan_precio.precioAnual <> NULL THEN plan_precio.precioAnual ";
            $sql .= " ELSE plan_precio.precio * 12 ";
            $sql .= "END) as anual, ";
			
            $sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "WHERE edaddesde <= $edadTomador and $edadTomador <=edadHasta AND producto.idCategoria = $p_categoria and plan_precio.idPais = $p_idPais ";
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql .= "GROUP by producto.idProducto  ";
            $sql .= "UNION  ";
            $sql .= "SELECT producto.nombre as nombr, producto.idProducto as idpro, plan.idPlan as idPlan,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
			
			$sql .= "(CASE "; 
            $sql .= " WHEN plan_precio.precio <= 0 then plan_precio.precioAnual ";
            $sql .= " WHEN plan_precio.precioAnual <> NULL THEN plan_precio.precioAnual ";
            $sql .= " ELSE plan_precio.precio * 12 ";
            $sql .= "END) as anual, ";
			
            $sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "WHERE edaddesde <= $edad1 and $edad1 <=edadHasta AND producto.idCategoria = $p_categoria and plan_precio.idPais = $p_idPais ";
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql .= "GROUP by producto.idProducto  ";
            $sql .= "UNION  ";
            $sql .= "SELECT producto.nombre as nombr, producto.idProducto as idpro, plan.idPlan as idPlan,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
			
			$sql .= "(CASE "; 
            $sql .= " WHEN plan_precio.precio <= 0 then plan_precio.precioAnual ";
            $sql .= " WHEN plan_precio.precioAnual <> NULL THEN plan_precio.precioAnual ";
            $sql .= " ELSE plan_precio.precio * 12 ";
            $sql .= "END) as anual, ";
			
            $sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "WHERE edaddesde <= $edad2 and $edad2 <=edadHasta AND producto.idCategoria = $p_categoria and plan_precio.idPais =  $p_idPais ";
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql .= "GROUP by producto.idProducto  ";
            $sql .= "UNION ";
            $sql .= "SELECT producto.nombre as nombr, producto.idProducto as idpro, plan.idPlan as idPlan,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
			
			$sql .= "(CASE "; 
            $sql .= " WHEN plan_precio.precio <= 0 then plan_precio.precioAnual ";
            $sql .= " WHEN plan_precio.precioAnual <> NULL THEN plan_precio.precioAnual ";
            $sql .= " ELSE plan_precio.precio * 12 ";
            $sql .= "END) as anual, ";
			
            $sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan   ";
            $sql .= "WHERE edaddesde <= $edad3 and $edad3 <=edadHasta AND producto.idCategoria = $p_categoria and plan_precio.idPais = $p_idPais ";
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql .= "GROUP by producto.idProducto  ";
            $sql .= "UNION ";
            $sql .= "SELECT producto.nombre as nombr, producto.idProducto as idpro, plan.idPlan as idPlan,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
			
			$sql .= "(CASE "; 
            $sql .= " WHEN plan_precio.precio <= 0 then plan_precio.precioAnual ";
            $sql .= " WHEN plan_precio.precioAnual <> NULL THEN plan_precio.precioAnual ";
            $sql .= " ELSE plan_precio.precio * 12 ";
            $sql .= "END) as anual, ";
			
            $sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "WHERE edaddesde <= $edad4 and $edad4 <=edadHasta AND producto.idCategoria = $p_categoria and plan_precio.idPais = $p_idPais ";
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql .= "GROUP by producto.idProducto  ";
            $sql .= "UNION ";
            $sql .= "SELECT producto.nombre as nombr, producto.idProducto as idpro, plan.idPlan as idPlan,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
			
			$sql .= "(CASE "; 
            $sql .= " WHEN plan_precio.precio <= 0 then plan_precio.precioAnual ";
            $sql .= " WHEN plan_precio.precioAnual <> NULL THEN plan_precio.precioAnual ";
            $sql .= " ELSE plan_precio.precio * 12 ";
            $sql .= "END) as anual, ";
			
            $sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "WHERE edaddesde <= $edad5 and $edad5 <=edadHasta AND producto.idCategoria = $p_categoria and plan_precio.idPais = $p_idPais ";
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql .= "GROUP by producto.idProducto  ";
            $sql .= " UNION ";
            $sql .= "SELECT producto.nombre as nombr, producto.idProducto as idpro, plan.idPlan as idPlan,plan.Nombre as nombrePlan, plan_precio.edadDesde as edadDesde, ";
            $sql .= "plan_precio.edadHasta as edadHasta , plan_precio.precio as mensual, ";
			
			$sql .= "(CASE "; 
            $sql .= " WHEN plan_precio.precio <= 0 then plan_precio.precioAnual ";
            $sql .= " WHEN plan_precio.precioAnual <> NULL THEN plan_precio.precioAnual ";
            $sql .= " ELSE plan_precio.precio * 12 ";
            $sql .= "END) as anual, ";
			
            $sql .= "IF (plan_precio.copago=0,'NO','SI') as copago FROM plan_precio ";
            $sql .= "inner join producto on producto.idProducto = plan_precio.idProducto ";
            $sql .= "INNER join plan on plan.idPlan = plan_precio.idPlan ";
            $sql .= "inner join producto_plan on producto_plan.idPlan = plan_precio.idPlan  ";
            $sql .= "WHERE edaddesde <= $edad6 and $edad6 <=edadHasta AND producto.idCategoria = $p_categoria and plan_precio.idPais = $p_idPais ";
            if ($p_idPais == 1) {
                $sql .= "and IF(plan_precio.idProvincia <> '',  $p_idProvincia, NULL) = $p_idProvincia ";
            }
            $sql .= "order by anual";
            $sql .= "";
        }
        
       //echo $op ."<br>";
       //echo $sql ."<br>";
       //echo $p_categoria;
       //exit;
        
       return $result = $this->con->query($sql);
        
    }
    
    
    
    
    function enviarCorreo($nombre, $code, $correo)
    {
        
        require("mail/class.phpmailer.php");
        require("mail/class.smtp.php");
        //Recibir todos los par?etros del formulario
        $para    = $correo;
        $asunto  = "Cotizacion ";
        $mensaje = '

						<html>
						<head><meta http-equiv="Content-Type" content="text/html; charset=big5">
						<title>COTIZACION</title>
						<style type="text/css">
						*{
							font-size:15px;
							padding:5px;
							margin:5px;
							font-family: Arial, New Times Romaw;
						}
						table{
							width:100%;
							border:0;
						}

						table tr td{
							pading:10px;
						}

						.button {
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
						    text-decoration:none;
						}
						 .logos{
					      width:30%;
					     }

						</style>
						</head>

						<body>
						<div id="apDiv3">
						
						 <table>
						 <tr>
						 <td><img src="assets/img/logo.png" class="logos"></td>
						 </tr>

						  <tr>
						 <td>Hola <b>' . $nombre . ',</b></td>
						 </tr>
						 <tr>
						 <td>Te hacemos llegar el link de tu documento sobre la cotizaci��n solicitada </td>
						 </tr>
						 <tr>
						 <td><a href="http://hi-broker.com/cotizaciones/cotizacion_' . $code . '.pdf">Cotizacion_' . $code . '.pdf</a></td>

						 </tr>
							<tr>
						 <td></td>
						 </tr>

						  <tr>
						<td></td>
						 </tr>

						 <tr>
						 <td>
						 </td>
						 </tr>
						   <tr>
						 <td>Atentamente</td>
						 </tr>

						  <tr>
						 <td>hi-brokers</td>
						 </tr>
						  </table>
						</div>
						</body>
						</html>

						'; // Cerramos la comilla simple. Con la comilla simple y el punto y coma se finaliza el cuerpo del mensaje html.  
        
        
        //Este bloque es importante
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug  = 1;
        $mail->CharSet    = 'UTF-8'; //permitir env? de caracteres especiales (tildes y ?
        $mail->SMTPAuth   = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host       = "smtp.gmail.com";
        $mail->Port       = 465;
        $mail->Subject    = 'Cotizacion';
        //Nuestra cuenta
        
        $mail->Username = 'PRUEBAHIBRO@gmail.com';
        $mail->Password = 'PRUEBAHIBRO12*'; //Su password
        $mail->FromName = 'PRUEBAHIBRO';
        //Agregar destinatario
        $mail->AddAddress($para);
        //$mail->Subject = $asunto;
        $mail->Body = $mensaje;
        //Para adjuntar archivo
        //$mail->AddAttachment($archivo['tmp_name'], $archivo['name']);
        $mail->MsgHTML($mensaje);
        if ($mail->Send()) {
            echo "<br><center><b>Se ha enviado un correo electronico a " . $para . " con los detalles de su registro</b></center>";
        } else {
            echo "<br><center><b>Error al enviar mensaje a la siguiente direccion: " . $correo . "</b></center>";
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
    
    function obtenerImagen($nombre)
    {
        $imagen = "";
        switch ($nombre) {
            case "LATINCARE RESIDENTE":
                $imagen = "http://hi-broker.com/wp-content/uploads/2019/09/Asisa..png";
                break;
            case "REPATRIACI??N Y DECES":
                $imagen = "http://hi-broker.com/wp-content/uploads/2019/09/Aegon..png";
                break;
            case "DKV SELECCION MAYORE":
                $imagen = "http://hi-broker.com/wp-content/uploads/2019/09/DKV..png";
                break;
            case "ADESLAS SENIOR MAYOR":
                $imagen = "http://hi-broker.com/wp-content/uploads/2019/09/Adeslas..png";
                break;
            case "ALUMNUSCARE":
                $imagen = "http://hi-broker.com/wp-content/uploads/2019/09/Generali..png";
                break;
            case "MERCANTIL SALUD":
                $imagen = "http://hi-broker.com/wp-content/uploads/2019/09/mercantil.png";
                break;
            case "DKV ELITE SIN COPAGO":
                $imagen = "http://hi-broker.com/wp-content/uploads/2019/09/DKV..png";
                break;
            case "ADESLAS PLENA PLUS":
                $imagen = "http://hi-broker.com/wp-content/uploads/2019/09/Adeslas..png";
                break;
            case "SANITAS STUDENTS":
                $imagen = "http://hi-broker.com/wp-content/uploads/2019/09/Sanitas..png";
                break;
            case "PROGRAMA DE SALUD ME":
                $imagen = "http://hi-broker.com/wp-content/uploads/2019/09/mercantil.png";
                break;
            case "SANITAS MAS SALUD":
                $imagen = "http://hi-broker.com/wp-content/uploads/2019/09/Sanitas..png";
                break;
            case "HISPANA SALUD":
                $imagen = "http://hi-broker.com/wp-content/uploads/2019/09/HIspana..png";
                break;
            case "LIBERTY SALUD":
                $imagen = "http://hi-broker.com/wp-content/uploads/2019/09/Liberty..png";
                break;
            case "DKV MUNDISALUD CLASSIC":
                $imagen = "http://hi-broker.com/wp-content/uploads/2019/09/DKV..png";
                break;
            case "DKV MUNDISALUD ELITE":
                $imagen = "http://hi-broker.com/wp-content/uploads/2019/09/DKV..png";
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
    
}

?>