<?php 

include('/home/customer/www/hi-broker.com/public_html/sp.php');

class Ajax {
  static function api($args)
  {
    $sp = new Sp();
    $result = array(
      'status' => array(
        'success' => true, 
        'code' => 200, 
        'message' => null),
      'content' => null
    ); 
    try
    {
      if(isset($_REQUEST['endpoint']))
      {
        // Fix PHP Errors
        error_reporting(E_ERROR | E_PARSE);
        // Fix Error Allowed memory size of 134217728 bytes exhausted.
        ini_set('memory_limit', '1024M');
        // Fix Error Timeout exhausted.
        ini_set('max_execution_time', '60');
        
        $endpoint = $_REQUEST['endpoint'];

        if ($endpoint == 'test')
        {
          include('endpoints/test.php');
        }
        else if ($endpoint == 'getCountries')
        {
          include('endpoints/get-countries.php');
        }
        else if ($endpoint == 'getProvinces')
        {
          include('endpoints/get-provinces.php');
        }
        else if ($endpoint == 'fetchQuotes')
        {
          include('endpoints/fetch-quotes.php');
        }
        else {
          $result["status"]["success"] = false;
          $result["status"]["code"] = -2;
          $result["status"]["message"] = "Servicio invalido.";
        }
      }
      else
      {   
        $result["status"]["success"] = false;
        $result["status"]["code"] = -3;
        $result["status"]["message"] = "Solicitud invalida.";
      }
    }
    catch (Throwable $t)
    {
      $result["status"]["success"] = false;
      $result["status"]["code"] = -4;
      $result["status"]["message"] = "Se ha presentado un problema.";
      $result["content"] = $t->getMessage();
    }
    catch (Exception $e)
    {
      $result["status"]["success"] = false;
      $result["status"]["code"] = -5;
      $result["status"]["message"] = "Se ha presentado un problema.";
      $result["content"] = $e->getMessage();
    }
    echo json_encode($result);
    header('Content-Type: application/json');
    die();
    return;
  }
}