<?php
session_destroy();
clearstatcache();

session_start();

$datos_correctos = 0;
$MAX_EDAD = 75;
$MIN_EDAD = 18;
$edades = "";
$mayor = 0;
$menor = 0;
$check = true;
$prueba = 0;
$edadPersonaMayor = "";
$valido = 0;
$mensaje_error = "";

//ENVIE POR LO MENOS UN DATO
if (isset($_POST)) {
  //VALIDAR LA EXISTENCIA DE TODOS LOS DATOS
  if (isset($_POST["pais"]) && !empty($_POST["pais"]) && isset($_POST["nombres"]) && !empty($_POST["nombres"]) && isset($_POST["apellidos"]) && !empty($_POST["apellidos"]) && isset($_POST["fecha_nac"]) && !empty($_POST["fecha_nac"]) && isset($_POST["movil"]) && !empty($_POST["movil"]) && isset($_POST["email"]) && !empty($_POST["email"]) && isset($_POST["cant_familiares"]) && isset($_POST["categoria"]) && !empty($_POST["categoria"]))
  {
    if (count($_POST["cant_familiares"]) > 0)
    {
      for ($i = 0;$i <= 6;$i++)
      {
        if (isset($_POST["fechanac"][$i]) && !empty($_POST["fechanac"][$i]))
        {
          $edadPersonaMayor = $sp->CalculaEdad($sp->limpiarFechaNac($_POST["fechanac"][$i]));
          $edades .= $edadPersonaMayor . " ,";
          $fecha_nac_bene[$i] = $sp->limpiarFechaNac($_POST["fechanac"][$i]);
          $valido++;
        }
        else
        {
          $fecha_nac_bene[$i] = '';
        }
      }

      if ($_POST["cant_familiares"] == $valido)
      {
        $datos_correctos = 1;
      }
      else
      {
        $datos_correctos = 0;
        $mensaje_error = "Ha ocurrido un error en la recolección de datos de los beneficiarios";
      }
    }
  }
  else
  {
    $datos_correctos = 0;
    $mensaje_error = "Ha ocurrido un error en la recepción de los datos, valide nuevamente que todos los datos esten correctos";
    header("location:javascript://history.go(-1)");
  }
}
else
{
  $datos_correctos = 0;
  $mensaje_error = "Ha ocurrido un error en la recepción de los datos, debe completar todos los campos requeridos";
}

if ($datos_correctos == 1)
{
  /********************************LIMPIAR DATOS DE ENTRADA************************************/
  $pais = $sp->limpiarId($_POST["pais"]);

  if (isset($_POST["provincia"]) && !empty($_POST["provincia"]))
  {
    $provincia = $sp->limpiarId($_POST["provincia"]);
  }
  else
  {
    $provincia = '';
  }
  $nombres = $sp->limpiarNombre($_POST["nombres"]);
  $apellidos = $sp->limpiarNombre($_POST["apellidos"]);
  $fecha_nac = $sp->limpiarFechaNac($_POST["fecha_nac"]);
  $movil = $_POST["movil"];
  $pais = $_POST["pais"];
  $currency = "€";
  if ($pais == 2)
  {
    $currency = "$";
    $provincia = 55;
  }

  $categoria = $_POST["categoria"];
  $email = $sp->limpiarCorreo($_POST["email"]);
  $cant_familiares = $sp->limpiarNumero($_POST["cant_familiares"]);

  $tomador = 0;
  if (isset($_POST["tomador"]) && !empty($_POST["tomador"]))
  {

    $fecha_tomador = $fecha_nac;
    $tomador = 1;
    $edadTmp = $sp->CalculaEdad($sp->limpiarFechaNac($fecha_tomador));
    $prueba = $edadTmp;

    if ($edadTmp >= $MAX_EDAD)
    {
      $mayor = 1;
      $edades .= $edadTmp . " ,";
    }
    else if ($edadTmp >= $MIN_EDAD) $check = false;
    else if ($edadTmp < $MIN_EDAD && $check === true) $menor = 1;

  }
  else
  {
    $fecha_tomador = $fecha_nac;
    $edadTmp2 = $sp->CalculaEdad($sp->limpiarFechaNac($fecha_tomador));

    if ($edadTmp2 < $MIN_EDAD) $menor = 1;
    $fecha_tomador = '';
    $tomador = '';
  }


  
  

  //Insert de consulta realizada
  $sp->addConsulta($pais, $provincia, $_POST["nombres"], $_POST["apellidos"], $fecha_tomador, $movil, $email, $cant_familiares, $tomador);

  /*****************************INVOCAR EL SP DE PRODUCTOS************************************/
  $productos = $sp->buscarProductosNew($categoria, $pais, $provincia, $fecha_tomador, $fecha_nac_bene[0], $fecha_nac_bene[1], $fecha_nac_bene[2], $fecha_nac_bene[3], $fecha_nac_bene[4], $fecha_nac_bene[5]);
  function array_envia($array)
  {
    $tmp = serialize($array);
    $tmp = urlencode($tmp);
    return $tmp;
  }

  $totalPrimaMensual = 0;
  $totalPrimaAnual = 0;

  $result["title"] = $nombres . ' ' . $apellidos . ', a continuación te ofrecemos un comparativo de precios, con fecha de inicio '.  date("d/m/Y");

  $result["content"] = array(
    "numero_cotizacion" => rand(1, 10000000) ,
    "currency" => $currency,
    "rows" => array()
  );
  
  if (@mysqli_num_rows($productos) > 0 && $menor == 0)
  {
    $sumMensual = 0;
    $sumAnual = 0;
    $existe = false;
    $edadTmp = 0;
    $edadTmp1 = 0;
    $nroPersonas = 0;
    if ($tomador)
    {
      $edadesList = array(
        $sp->CalculaEdad($sp->limpiarFechaNac($_POST["fecha_nac"])) ,
        $sp->CalculaEdad($sp->limpiarFechaNac($_POST["fechanac"][0])) ,
        $sp->CalculaEdad($sp->limpiarFechaNac($_POST["fechanac"][1])) ,
        $sp->CalculaEdad($sp->limpiarFechaNac($_POST["fechanac"][2])) ,
        $sp->CalculaEdad($sp->limpiarFechaNac($_POST["fechanac"][3])) ,
        $sp->CalculaEdad($sp->limpiarFechaNac($_POST["fechanac"][4])) ,
        $sp->CalculaEdad($sp->limpiarFechaNac($_POST["fechanac"][5]))
      );
    }
    else
    {
      $edadesList = array(
        $sp->CalculaEdad($sp->limpiarFechaNac($_POST["fechanac"][0])) ,
        $sp->CalculaEdad($sp->limpiarFechaNac($_POST["fechanac"][1])) ,
        $sp->CalculaEdad($sp->limpiarFechaNac($_POST["fechanac"][2])) ,
        $sp->CalculaEdad($sp->limpiarFechaNac($_POST["fechanac"][3])) ,
        $sp->CalculaEdad($sp->limpiarFechaNac($_POST["fechanac"][4])) ,
        $sp->CalculaEdad($sp->limpiarFechaNac($_POST["fechanac"][5]))
      );
    }
    foreach ($productos as $key => $value)
    {
      $t = $value["idProducto"] . "-" . $value["idPlan"];
      $productosList[$t] = 0;
      $mensualList[$t] = 0;
      $mensualTomadorList[$t] = 0;
      $anualList[$t] = 0;
      $nombreList[$t] = "";
      $descripcionList[$t] = "";
      $copagoList[$t] = "";
      $edadList[$t] = 0;
      $promoList[$t] = "";
      $sumaAseguradaList[$t] = 0;
    
    }
    
   
    
    $cantidadFam = $_POST["cant_familiares"];
    if (count($_POST["cant_familiares"]) > 0)
    {
      if ($tomador <> "")
      {
        $cantidadFam = $cantidadFam + 1;
        for ($i = 0;$i < $cantidadFam;$i++)
        {
          if ($edadesList[$i] >= 0)
          {
            $num = $edadesList[$i];
            $nroPersonas = $nroPersonas + 1;

            $p = 0;
            foreach ($productos as $key => $value)
            {
               
              if (($value["edadDesde"] <= $num) && ($num <= $value["edadHasta"]))
              {
                $sumMensual = 0;
                $sumAnual = 0;
                $t = $value["idProducto"] . "-" . $value["idPlan"];
                $prod = $value["idProducto"];
                $auxiliar = $auxiliar . $prod . ",";
                $productosList[$t] = $productosList[$t] + 1;
                $arrayDatos = array(
                  $num,
                  $auxiliar,
                  $nroPersonas
                );
                $find = $arrayDatos[1];
                if ($i == 0)
                {
                  $mensualTomadorList[$t] = $value["mensual"];
                }
                $mensualList[$t] = $mensualList[$t] + $value["mensual"];
                $anualList[$t] = $anualList[$t] + $value["anual"];
                $nombreList[$t] = $value["nombre"];
                $descripcionList[$t] = $value["descripcion"];
                $copagoList[$t] = $value["copago"];
                $sumaAseguradaList[$t] = $value["sumaAsegurada"];
                //$promoList[$t] =  $value["promoNombre"];
                //Cuando es el tomador solo que se esta consultando, calcula 2 personas en cantidad de familiares **OJO con tomador seleccionado, IF para armar las edades
                //que se mostraran en cada producto
                if ($cantidadFam == 1)
                {
                  $edadList[$t] = $num . " Años";
                }
                else
                {
                  $edadList[$t] = $edadList[$t] . ";" . $num;
                  $edadList[$t] = str_replace("0;", " ", substr($edadList[$t], 0) . " Años"); ////Aqui es donde mostramos la edad asegurable
                }
                $p++;
              }
            }
          }
        }
      }
      else
      {
        //////////////////////////////////////////////////***SIN TOMADOR AHORA***///////////////////////////////////////////////////////////////////////
        //Para tomar en cuenta
        //Si hay un sin tomador si se puede consultar y la cantidad de familiares debe ser solo uno que es el abuelo
        //ó
        //Si es un grupo familiar sin abuelos
        //si es una abuelo y trae mas de un afiliado sin tomador no podemos incluirlo en el grupo familiar
        for ($i = 0;$i < $cantidadFam;$i++)
        {
          if ($edadesList[$i] >= 0)
          {
            $num = $edadesList[$i];
            $numeroEdad = $sp->CalculaEdad($num);
            $nroPersonas = $nroPersonas + 1;
            $p = 0;
            foreach ($productos as $key => $value)
            {
              if (($value["edadDesde"] <= $num) && ($num <= $value["edadHasta"]))
              {
                $sumMensual = 0;
                $sumAnual = 0;
                $t = $value["idProducto"] . "-" . $value["idPlan"];
                $prod = $value["idProducto"];
                $auxiliar = $auxiliar . $prod . ",";
                $productosList[$t] = $productosList[$t] + 1;
                $arrayDatos = array(
                  $num,
                  $auxiliar,
                  $nroPersonas
                );
                $mensualTomadorList[$t] = 0;
                $mensualList[$t] = $mensualList[$t] + $value["mensual"];
                $anualList[$t] = $anualList[$t] + $value["anual"];
                $nombreList[$t] = $value["nombre"];
                $descripcionList[$t] = $value["descripcion"];
                $copagoList[$t] = $value["copago"];
                $sumaAseguradaList[$t] = $value["sumaAsegurada"];
                //$promoList[$t] =  $value["promoNombre"];
                
                // **OJO sin tomador seleccionado, IF para armar las edades que se mostraran en cada producto
                if ($cantidadFam == 1)
                {
                  $edadList[$t] = $num . " Años";
                }
                else
                {
                  $edadList[$t] = $edadList[$t] . ";" . $num;
                  $edadList[$t] = str_replace("0;", " ", substr($edadList[$t], 0) . " Años");
                }
                $p++;
              }
            }
          }
        }
      }
    }
  
    foreach ($productosList as $key => $value)
    {
      $totalPrimaMensual += $mensualList[$key];
      $totalPrimaAnual += $anualList[$key];
      $row = array();
      $row["imagen"] = $sp->obtenerImagen($nombreList[$key]);
      $row["promo"] = $sp->obtenerPromo($promoList[$key]);
      $row["mensual"] = number_format($mensualList[$key], 2, ',', '.');
      $row["anual"] = number_format($anualList[$key], 2, ',', '.');
      $row["copago"] = $copagoList[$key];
      $row["nombre"] = $nombreList[$key];
      $row["e"] = $edadList[$key];
      $row["sumaAsegurada"] = $sumaAseguradaList[$key];
      $row["descripcion"] = $descripcionList[$key];
      $row["form"]["producto"] = $nombreList[$key];
      $row["form"]["anual"] = $anualList[$key];
      $row["form"]["mensual"] = $mensualTomadorList[$key];
      $row["form"]["nombre"] = $nombreList[$key];
      $row["form"]["nombre_provincia"] = $_POST["nombre_provincia"];
      $row["form"]["nombre_pais"] = $_POST["nombre_pais"];
      $row["form"]["productosList"] = base64_encode(serialize($productosList));
      $row["form"]["mensualList"] = base64_encode(serialize($mensualList));
      $row["form"]["codigoProducto"] = $key;
      $row["form"]["tomador"] = $tomador;
      $row["form"]["pais"] = $pais;
      $row["form"]["provincia"] = $provincia;
      $row["form"]["nombres"] = $nombres;
      $row["form"]["apellidos"] = $apellidos;
      $row["form"]["fecha_nac"] = $fecha_nac;
      $row["form"]["movil"] = $movil;
      $row["form"]["email"] = $email;
      $row["form"]["categoria"] = $categoria;
      $row["form"]["cant_familiares"] = $cant_familiares;
      $row["form"]["fecha_nac_bene"] = array_envia($fecha_nac_bene);
      $row["form"]["numero_cotizacion"] = substr(str_shuffle("0123456789") , 0, 5);
      $result["content"]["rows"][] = $row;
    }
    $result["content"]["totalPrimaMensual"] = round($totalPrimaMensual, 2);
    $result["content"]["totalPrimaAnual"] = round($totalPrimaAnual, 2);
  }
  else
  {
    $result["status"]["success"] = false;
    $result["status"]["code"] = - 1;
    if ($menor == 1) $result["status"]["message"] = 'El tomador debe ser mayor de edad.';
    else $result["status"]["message"] = 'No hay productos disponibles.';
  }
}
else
{
  $result["status"]["success"] = false;
  $result["status"]["code"] = - 1;
  $result["status"]["message"] = $mensaje_error;
}