<?php

$nombre = $_GET["nombre"];
$apellido1 = $_GET["apellido1"];
$fecha_nacimiento = $_GET["fecha_nac"];
//$movil = strtr($_GET["movil"], " ", "_");
//$movil = strtr($movil, "-", "_");
$movil= str_replace(" ", "", $_GET["movil"]);
$movil= str_replace("-", "", $movil);
$movil= str_replace("(", "", $movil);
$movil= str_replace(")", "", $movil);
$email = $_GET["email"];

$cant_familiares = $_GET["cant_familiares"];
$numero_cotizacion = $_GET["numero_cotizacion"];


$categoria = $_GET["categoria"];
$pais = $_GET["nombre_pais"];
$producto = strtr($_GET["producto"], " ", "_");
$anual = $_GET["anual"];
$mensual = $_GET["mensual"];

?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Solicitud de Seguro</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <link rel="apple-touch-icon" sizes="76x76" href="assets/wizard/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="assets/wizard/img/favicon.png" />

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

    <!-- CSS Files -->
    <link href="assets/wizard/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/wizard/css/material-bootstrap-wizard.css" rel="stylesheet" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="assets/wizard/css/demo.css" rel="stylesheet" />


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">
    <link href="assets/bootstrap-fileinput/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
    <link href="assets/bootstrap-fileinput/themes/explorer-fas/theme.css" media="all" rel="stylesheet" type="text/css"/>
    
    <link rel="stylesheet" href="assets/flatpickr/flatpickr.min.css">
    <link rel="stylesheet" href="assets/flatpickr/theme/material_blue.css">
    <link rel="stylesheet" href="assets/formulario/css/styles.css">
</head>

<body>
    <div class="image-container set-full-height">
        <!--   Creative Tim Branding   -->
        <a href="http://creative-tim.com">
             <div class="logo-container">
                <div style="width: 60px; float: left;">
                    <img src="assets/wizard/img/new_logo.png">
                </div>
            </div>
        </a>

        <!--   Big container   -->
        <div class="container">
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1">
                    <!--      Wizard container        -->
                    <div class="wizard-container">
                        <div class="card wizard-card" data-color="blue" id="wizard">
                            <form action="formularioPDF.php" method="post" enctype="multipart/form-data" class="dropzone" id="myForm">
                            <!--        You can switch " data-color="rose" "  with one of the next bright colors: "blue", "green", "orange", "purple"        -->

                                <div class="wizard-header">
                                    <h3 class="wizard-title">
                                        Solicitud de Seguro
                                    </h3>
                                    <h5>Por favor completa la siguiente información:</h5>
                                </div>
                                <div class="wizard-navigation items-nav">
                                    <ul>
                                        <li><a href="#datos_asegurados" data-toggle="tab">1 Asegurados</a></li>
                                        <li><a href="#cuestionario_salud" data-toggle="tab">2 Cuestionario de Salud</a></li>
                                        <li><a href="#datos_tomador" data-toggle="tab">3 Tomador</a></li>
                                        <li><a href="#tratamiento_datos" data-toggle="tab">4 Tratamiento de Datos</a></li>
                                        <li><a href="#datos_cotizacion" data-toggle="tab">5 Detalles de Cobertura</a></li>
                                    </ul>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane" id="datos_asegurados">
                                        <a class="btn btn-info steps">1/5</a>
                                        <div id="accordion">
                                          <div class="card">
                                            <div class="card-header" id="headingOne">
                                              <h5 class="mb-0">
                                                <a class="btn btn-link" data-toggle="collapse" data-target="" aria-expanded="true" aria-controls="collapseOne">
                                                  Asegurado
                                                </a>
                                              </h5>
                                            </div>
                                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                              <div class="card-body">
                                                <div class="col-sm-12"><h4 class="info-text"><strong>Datos Personales</strong></h4></div>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="material-icons">person</i>
                                                            </span>
                                                            <div class="form-group label-floating">
                                                                <label class="control-label">Nombre</label>
                                                                <input type="text" class="form-control" id="nombre" name="nombre" readonly value=<?= isset($nombre)?htmlspecialchars($nombre):'' ?>>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="material-icons">person</i>
                                                            </span>
                                                            <div class="form-group label-floating">
                                                                <label class="control-label">Apellido 1</label>
                                                                <input type="text" class="form-control" id="apellido1" name="apellido1" readonly value=<?= isset($apellido1)?htmlspecialchars($apellido1):'' ?>>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="material-icons">person</i>
                                                            </span>
                                                            <div class="form-group label-floating">
                                                                <label class="control-label">Apellido 2</label>
                                                                <input type="text" class="form-control" id="apellido2" name="apellido2">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="material-icons">event</i>
                                                            </span> 
                                                            <div class="form-group label-floating">               
                                                                <label class="control-label">Fecha de nacimiento</label>
                                                                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" readonly value=<?= isset($fecha_nacimiento)?htmlspecialchars($fecha_nacimiento):'' ?>>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="material-icons">list</i>
                                                            </span>
                                                            <div class="form-group label-floating">
                                                                <label class="control-label">Sexo</label>
                                                                <select name="sexo" class="form-control">
                                                                    <option disabled="" selected=""></option>
                                                                    <option value="Hombre"> Hombre </option>
                                                                    <option value="Mujer"> Mujer </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">                                 
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="material-icons">folder_shared</i>
                                                            </span> 
                                                            <div class="form-group label-floating">   
                                                                <label class="control-label">Peso (kg)</label>
                                                                <input type="text" class="form-control" id="peso" name="peso">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">                             
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="material-icons">folder_shared</i>
                                                            </span>    
                                                            <div class="form-group label-floating">
                                                                <label class="control-label">Altura (cm)</label>
                                                                <input type="text" class="form-control" id="altura" name="altura">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="material-icons">email</i>
                                                            </span>
                                                            <div class="form-group label-floating">
                                                                <label class="control-label">Email</label>
                                                                <input type="email" class="form-control" id="email" name="email" readonly value=<?= isset($email)?htmlspecialchars($email):'' ?>>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="material-icons">phone_iphone</i>
                                                            </span>
                                                            <div class="form-group label-floating">
                                                                <label class="control-label">Teléfono móvil</label>
                                                                <input type="text" class="form-control" id="movil" name="movil" readonly value=<?= isset($movil)?htmlspecialchars($movil):'' ?>>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="material-icons">local_phone</i>
                                                            </span>
                                                            <div class="form-group label-floating">
                                                                <label class="control-label">Teléfono fijo</label>
                                                                <input type="text" class="form-control" id="telefono_fijo" name="telefono_fijo">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="material-icons">account_circle</i>
                                                            </span>
                                                            <div class="form-group label-floating">
                                                                <label class="control-label">Tipo de Documento de identidad</label>
                                                                <select name="documento_identidad" id="documento_identidad" class="form-control">
                                                                    <option disabled="" selected=""></option>
                                                                    <option value="NIF"> NIF </option>
                                                                    <option value="Pasaporte"> Pasaporte </option>
                                                                    <option value="NIE"> NIE </option>
                                                                    <option value="DNI"> DNI </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="material-icons">account_circle</i>
                                                            </span>
                                                            <div class="form-group label-floating">
                                                                <label class="control-label">N° Documento de Identidad</label>
                                                                <input type="text" class="form-control" id="no_documento_identidad" name="no_documento_identidad">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12"><hr></div>
                                                    <div class="col-sm-12"><h4 class="info-text"><strong>Domicilio Residencia</strong></h4></div>                                                    
                                                    <div class="col-sm-3">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="material-icons">location_on</i>
                                                            </span>
                                                            <div class="form-group label-floating">
                                                                <label class="control-label">País</label>
                                                                <select name="pais_direccion" id="pais_direccion" class="form-control" required onchange="codigoPostal(this)" data-input="codigo_postal">
                                                                    <option disabled="" selected=""></option>
                                                                    <option value="1">España</option>
                                                                    <option value="2">Venezuela</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="material-icons">location_on</i>
                                                            </span>
                                                            <div class="form-group label-floating">
                                                                <label class="control-label">Dirección</label>
                                                                <input type="text" class="form-control" id="direccion" name="direccion">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="material-icons">location_on</i>
                                                            </span>
                                                            <div class="form-group label-floating">
                                                                <label class="control-label">Número</label>
                                                                <input type="text" class="form-control" id="numero" name="numero">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="material-icons">location_on</i>
                                                            </span>
                                                            <div class="form-group label-floating">
                                                                <label class="control-label">Bloque, escalera, piso..</label>
                                                                <select name="tipo_numero" class="form-control">
                                                                    <option disabled="" selected=""></option>
                                                                    <option value="Bloque">Bloque</option>
                                                                    <option value="Escalera">Escalera</option>
                                                                    <option value="Piso">Piso</option>
                                                                    <option value="Puerta">Puerta</option>
                                                                    <option value="Portal">Portal</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>                                          
                                                    <div class="col-sm-3">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="material-icons">location_on</i>
                                                            </span>
                                                            <div class="form-group label-floating">
                                                                <label class="control-label">Municipio</label>
                                                                <input type="text" class="form-control" id="municipio" name="municipio">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="material-icons">location_on</i>
                                                            </span>
                                                            <div class="form-group label-floating">
                                                                <label class="control-label">Código Postal</label>
                                                                <input type="text" class="form-control" id="codigo_postal" name="codigo_postal">
                                                            </div>
                                                        </div>
                                                    </div>  
                                                    <div class="col-sm-12"><hr></div>
                                                    <div class="col-sm-12"><h4 class="info-text"><strong>Documentación</strong></h4></div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="material-icons">attach_file</i>
                                                            </span>
                                                            <div class="form-group">
                                                                <label class="control-label">Documento de Identidad</label>
                                                                <input type="file" class="file-images asegurado" id="archivo_documento_identidad" name="file[]">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <?php if ($categoria == "3") {?>          
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="material-icons">attach_file</i>
                                                            </span>
                                                            <div class="form-group">
                                                                <label class="control-label">Carta de Matriculación</label>
                                                                <input type="file" class="file-images asegurado" id="archivo_carta_matriculacion" name="file[]">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php } ?>                                                  
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        <?php for ($i = 0; $i < $cant_familiares; $i++) {?>
                                          <div class="card">
                                            <div class="card-header" id="heading<?=$i?>">
                                              <h5 class="mb-0">
                                                <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse<?=$i?>" aria-expanded="false" aria-controls="collapse<?=$i?>">
                                                  Asegurado Adicional <?php echo $i+1; ?> <i class="material-icons">person_add</i>
                                                </a>
                                              </h5>
                                            </div>
                                            <div id="collapse<?=$i?>" class="collapse" aria-labelledby="heading<?=$i?>" data-parent="#accordion">
                                              <div class="card-body">
                                                <div class="col-sm-12"><h4 class="info-text"><strong>Datos Personales</strong></h4></div>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="material-icons">person</i>
                                                            </span>
                                                            <div class="form-group label-floating">
                                                                <label class="control-label">Nombre</label>
                                                                <input type="text" class="form-control asegurado" id="nombre_asegurado_<?=$i?>" name="nombre_asegurado_<?=$i?>" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="material-icons">person</i>
                                                            </span>
                                                            <div class="form-group label-floating">
                                                                <label class="control-label">Apellido 1</label>
                                                                <input type="text" class="form-control asegurado" id="apellido1_asegurado_<?=$i?>" name="apellido1_asegurado_<?=$i?>" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="material-icons">person</i>
                                                            </span>
                                                            <div class="form-group label-floating">
                                                                <label class="control-label">Apellido 2</label>
                                                                <input type="text" class="form-control" id="apellido2_asegurado_<?=$i?>" name="apellido2_asegurado_<?=$i?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="material-icons">list</i>
                                                            </span>
                                                            <div class="form-group label-floating">
                                                                <label class="control-label">Sexo</label>
                                                                <select name="sexo_asegurado_<?=$i?>" class="form-control asegurado" required>
                                                                    <option disabled="" selected=""></option>
                                                                    <option value="Hombre"> Hombre </option>
                                                                    <option value="Mujer"> Mujer </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="material-icons">event</i>
                                                            </span>
                                                            <div class="form-group label-floating">
                                                                <label class="control-label">Fecha de nacimiento</label>
                                                                <input type="date" class="form-control asegurado flatpickr" id="fecha_nacimiento_asegurado_<?=$i?>"  name="fecha_nacimiento_asegurado_<?=$i?>" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="material-icons">folder_shared</i>
                                                            </span>
                                                            <div class="form-group label-floating">
                                                                <label class="control-label">Peso</label>
                                                                <input type="text" class="form-control asegurado" id="peso_asegurado_<?=$i?>"  name="peso_asegurado_<?=$i?>" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="material-icons">folder_shared</i>
                                                            </span>
                                                            <div class="form-group label-floating">
                                                                <label class="control-label">Altura</label>
                                                                <input type="text" class="form-control asegurado" id="altura_asegurado_<?=$i?>" name="altura_asegurado_<?=$i?>" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="material-icons">list</i>
                                                            </span>
                                                            <div class="form-group label-floating">
                                                                <label class="control-label">Parentesco con el asegurado titular</label>
                                                                <select name="parentesco_asegurado_<?=$i?>" id="parentesco_asegurado_<?=$i?>" class="form-control" required="">
                                                                    <option disabled="" selected=""></option>
                                                                    <option value="Conyuge"> Conyuge </option>
                                                                    <option value="Hijo/Hija"> Hijo/Hija </option>
                                                                    <option value="Otro familiar"> Otro familiar </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="material-icons">account_circle</i>
                                                            </span>
                                                            <div class="form-group label-floating">
                                                                <label class="control-label">Tipo de Documento de identidad</label>
                                                                <select name="documento_identidad_asegurado_<?=$i?>" class="form-control asegurado" required>
                                                                    <option disabled="" selected=""></option>
                                                                    <option value="NIF"> NIF </option>
                                                                    <option value="Pasaporte"> Pasaporte </option>
                                                                    <option value="NIE"> NIE </option>
                                                                    <option value="DNI"> DNI </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="material-icons">account_circle</i>
                                                            </span>
                                                            <div class="form-group label-floating">
                                                                <label class="control-label">N° Documento de Identidad</label>
                                                                <input type="text" class="form-control asegurado" id="no_documento_identidad_asegurado_<?=$i?>" name="no_documento_identidad_asegurado_<?=$i?>" required>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                    <div class="col-sm-12"><hr></div>                       
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="material-icons">attach_file</i>
                                                            </span>
                                                            <div class="form-group">
                                                                <label class="control-label">Tipo de Documento de Identidad</label>
                                                                <input type="file" class="file-images asegurado" id="archivo_documento_identidad_asegurado_<?=$i?>" name="file[]" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php if ($categoria == "3") {?>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="material-icons">attach_file</i>
                                                            </span>
                                                            <div class="form-group">
                                                                <label class="control-label">Carta de Matriculación</label>
                                                                <input type="file" class="file-images asegurado" id="archivo_carta_matriculacion_asegurado_<?=$i?>" name="file[]" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php } ?>                                            
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        <?php }?>
                                        </div>                                        
                                    </div>                       
                                    <div class="tab-pane" id="cuestionario_salud">
                                        <a class="btn btn-info steps">2/5</a>
                                        <div id="accordion">
                                          <div class="card">
                                            <div class="card-header" id="headingCuestionarioPrincipal">
                                              <h5 class="mb-0">
                                                <a class="btn btn-link" data-toggle="collapse" data-target="" aria-expanded="true" aria-controls="collapseCuestionarioPrincipal">
                                                  Asegurado Titular
                                                </a>
                                              </h5>
                                            </div>
                                            <div id="collapseCuestionarioPrincipal" class="collapse show" aria-labelledby="headingCuestionarioPrincipal" data-parent="#accordion">
                                              <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group label-floating">
                                                            <div class="col-sm-9">
                                                            <label style="margin-top:15px; text-align: justify;"><strong><i class="material-icons">content_paste</i>  ¿Padece o ha padecido de alguna enfermedad o ha sufrido un accidente en los últimos cinco años que haya precisado de un tratamiento médico?</strong></label>
                                                            </div>
                                                            <div class="col-sm-3 text-center" style="padding-top: 0px;">
                                                                <div class="choice"  style="display: inline-block;"data-input="enfermedad_accidente" data-value="Si" data-other="choice_enfermedad_accidente_no" data-div="div_enfermedad_accidente" onclick="showText(this)" id="choice_enfermedad_accidente_si">
                                                                    <input type="radio" name="enfermedad_accidente" value="Si" id="enfermedad_accidente_si">
                                                                    <div class="icon">
                                                                        <i class="fa fa-check"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="choice" style="display: inline-block;" data-input="enfermedad_accidente"  data-value="No" data-other="choice_enfermedad_accidente_si" data-div="div_enfermedad_accidente" onclick="showText(this)" id="choice_enfermedad_accidente_no">
                                                                    <input type="radio" name="enfermedad_accidente" value="No" id="enfermedad_accidente_no">
                                                                    <div class="icon">
                                                                        <i class="fa fa-close"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12" id="div_enfermedad_accidente" style="display:none">
                                                        <div class="form-group label-floating col-sm-9">
                                                            <label class="control-label">Explique</label>
                                                            <input type="text" class="form-control" id="detalles_enfermedad_accidente_principal" name="detalles_enfermedad_accidente_principal" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group label-floating">
                                                            <div class="col-sm-9">
                                                            <label style="margin-top:15px; text-align: justify;"><strong><i class="material-icons">content_paste</i> ¿Ha estado alguna vez o tiene previsto ser hospitalizado y/o intervenido quirúrgicamente?</strong></label>
                                                            </div>
                                                            <div class="col-sm-3 text-center" style="padding-top: 0px;">
                                                                <div class="choice"  style="display: inline-block;"data-input="hospitalizado" data-value="Si" data-other="choice_hospitalizado_no" data-div="div_hospitalizado" onclick="showText(this)" id="choice_hospitalizado_si">
                                                                    <input type="radio" name="hospitalizado" value="Si" id="hospitalizado_si">
                                                                    <div class="icon">
                                                                        <i class="fa fa-check"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="choice" style="display: inline-block;" data-input="hospitalizado"  data-value="No" data-other="choice_hospitalizado_si" data-div="div_hospitalizado" onclick="showText(this)" id="choice_hospitalizado_no">
                                                                    <input type="radio" name="hospitalizado" value="No" id="hospitalizado_no">
                                                                    <div class="icon">
                                                                        <i class="fa fa-close"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12" id="div_hospitalizado" style="display:none">
                                                        <div class="form-group label-floating col-sm-9">
                                                            <label class="control-label">Explique</label>
                                                            <input type="text" class="form-control" id="detalles_hospitalizado_principal" name="detalles_hospitalizado_principal" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group label-floating">
                                                            <div class="col-sm-9">
                                                            <label style="margin-top:15px; text-align: justify;"><strong><i class="material-icons">content_paste</i> ¿Se encuentra actualmente bajo tratamiento médico?</strong></label>
                                                            </div>                             
                                                            <div class="col-sm-3 text-center" style="padding-top: 0px;">
                                                                <div class="choice" style="display: inline-block;" data-input="tratamiento_actual" data-value="Si" data-other="choice_tratamiento_actual_no" data-div="div_tratamiento_actual" onclick="showText(this)" id="choice_tratamiento_actual_si">
                                                                    <input type="radio" name="tratamiento_actual" value="Si" id="tratamiento_actual_si">
                                                                    <div class="icon">
                                                                        <i class="fa fa-check"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="choice" style="display: inline-block;" data-input="tratamiento_actual" data-value="No" data-other="choice_tratamiento_actual_si" data-div="div_tratamiento_actual" onclick="showText(this)" id="choice_tratamiento_actual_no">
                                                                    <input type="radio" name="tratamiento_actual" value="No" id="tratamiento_actual_no">
                                                                    <div class="icon">
                                                                        <i class="fa fa-close"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12" id="div_tratamiento_actual" style="display:none">
                                                        <div class="form-group label-floating col-sm-9">
                                                            <label class="control-label">Explique</label>
                                                            <input type="text" class="form-control" id="detalles_tratamiento_actual_principal" name="detalles_tratamiento_actual_principal" required>
                                                        </div>
                                                    </div> 
                                                    <div class="col-sm-12">
                                                        <div class="form-group label-floating">
                                                            <div class="col-sm-9">
                                                            <label style="margin-top:15px; text-align: justify;"><strong><i class="material-icons">content_paste</i> ¿Tiene algún síntoma o dolor, no diagnosticado y manifestado de forma continuada o reiterada?</strong></label>
                                                            </div>
                                                            <div class="col-sm-3 text-center" style="padding-top: 0px;">
                                                                <div class="choice" style="display: inline-block;" data-input="sintoma_actual" data-value="Si" data-other="choice_sintoma_actual_no" data-div="div_sintoma_actual" onclick="showText(this)" id="choice_sintoma_actual_si">
                                                                    <input type="radio" name="sintoma_actual" value="Si" id="sintoma_actual_si">
                                                                    <div class="icon">
                                                                        <i class="fa fa-check"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="choice" style="display: inline-block;" data-input="sintoma_actual" data-value="No" data-other="choice_sintoma_actual_si" data-div="div_sintoma_actual" onclick="showText(this)" id="choice_sintoma_actual_no">
                                                                    <input type="radio" name="sintoma_actual" value="No" id="sintoma_actual_no">
                                                                    <div class="icon">
                                                                        <i class="fa fa-close"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>                                            
                                                    <div class="col-sm-12" id="div_sintoma_actual" style="display:none">
                                                        <div class="form-group label-floating col-sm-9">
                                                            <label class="control-label">Explique</label>
                                                            <input type="text" class="form-control" id="detalles_sintoma_actual_principal" name="detalles_sintoma_actual_principal" required>
                                                        </div>
                                                    </div>                                                                                                  
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        <?php for ($i = 0; $i < $cant_familiares; $i++) {?>
                                          <div class="card">
                                            <div class="card-header" id="headingCuestionarioAsegurado<?=$i?>">
                                              <h5 class="mb-0">
                                                <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseCuestionarioAsegurado<?=$i?>" aria-expanded="false" aria-controls="collapseCuestionarioAsegurado<?=$i?>">
                                                  Asegurado Adicional <?php echo $i+1; ?> <i class="material-icons">person_add</i>
                                                </a>
                                              </h5>
                                            </div>
                                            <div id="collapseCuestionarioAsegurado<?=$i?>" class="collapse" aria-labelledby="headingCuestionarioAsegurado<?=$i?>" data-parent="#accordion">
                                              <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group label-floating">
                                                            <div class="col-sm-9">
                                                            <label style="margin-top:15px; text-align: justify;"><strong><i class="material-icons">content_paste</i>  ¿Padece o ha padecido de alguna enfermedad o ha sufrido un accidente en los últimos cinco años que haya precisado de un tratamiento médico?</strong></label>
                                                            </div>
                                                            <div class="col-sm-3 text-center" style="padding-top: 0px;">
                                                                <div class="choice"  style="display: inline-block;"data-input="enfermedad_accidente_asegurado_<?=$i?>" data-value="Si" data-other="choice_enfermedad_accidente_asegurado_<?=$i?>_no" data-div="div_enfermedad_accidente_asegurado_<?=$i?>" onclick="showText(this)" id="choice_enfermedad_accidente_asegurado_<?=$i?>_si">
                                                                    <input type="radio" name="enfermedad_accidente_asegurado_<?=$i?>" value="Si" id="enfermedad_accidente_asegurado_<?=$i?>_si">
                                                                    <div class="icon">
                                                                        <i class="fa fa-check"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="choice" style="display: inline-block;" data-input="enfermedad_accidente_asegurado_<?=$i?>"  data-value="No" data-other="choice_enfermedad_accidente_asegurado_<?=$i?>_si" data-div="div_enfermedad_accidente_asegurado_<?=$i?>" onclick="showText(this)" id="choice_enfermedad_accidente_asegurado_<?=$i?>_no">
                                                                    <input type="radio" name="enfermedad_accidente_asegurado_<?=$i?>" value="No" id="enfermedad_accidente_asegurado_<?=$i?>_no">
                                                                    <div class="icon">
                                                                        <i class="fa fa-close"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12" id="div_enfermedad_accidente_asegurado_<?=$i?>" style="display:none">
                                                        <div class="form-group label-floating col-sm-9">
                                                            <label class="control-label">Explique</label>
                                                            <input type="text" class="form-control" id="detalles_enfermedad_accidente_asegurado_<?=$i?>_principal" name="detalles_enfermedad_accidente_asegurado_<?=$i?>_principal" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group label-floating">
                                                            <div class="col-sm-9">
                                                            <label style="margin-top:15px; text-align: justify;"><strong><i class="material-icons">content_paste</i> ¿Ha estado alguna vez o tiene previsto ser hospitalizado y/o intervenido quirúrgicamente?</strong></label>
                                                            </div>
                                                            <div class="col-sm-3 text-center" style="padding-top: 0px;">
                                                                <div class="choice"  style="display: inline-block;"data-input="hospitalizado_asegurado_<?=$i?>" data-value="Si" data-other="choice_hospitalizado_asegurado_<?=$i?>_no" data-div="div_hospitalizado_asegurado_<?=$i?>" onclick="showText(this)" id="choice_hospitalizado_asegurado_<?=$i?>_si">
                                                                    <input type="radio" name="hospitalizado_asegurado_<?=$i?>" value="Si" id="hospitalizado_asegurado_<?=$i?>_si">
                                                                    <div class="icon">
                                                                        <i class="fa fa-check"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="choice" style="display: inline-block;" data-input="hospitalizado_asegurado_<?=$i?>"  data-value="No" data-other="choice_hospitalizado_asegurado_<?=$i?>_si" data-div="div_hospitalizado_asegurado_<?=$i?>" onclick="showText(this)" id="choice_hospitalizado_asegurado_<?=$i?>_no">
                                                                    <input type="radio" name="hospitalizado_asegurado_<?=$i?>" value="No" id="hospitalizado_asegurado_<?=$i?>_no">
                                                                    <div class="icon">
                                                                        <i class="fa fa-close"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12" id="div_hospitalizado_asegurado_<?=$i?>" style="display:none">
                                                        <div class="form-group label-floating col-sm-9">
                                                            <label class="control-label">Explique</label>
                                                            <input type="text" class="form-control" id="detalles_hospitalizado_asegurado_<?=$i?>_principal" name="detalles_hospitalizado_asegurado_<?=$i?>_principal" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group label-floating">
                                                            <div class="col-sm-9">
                                                            <label style="margin-top:15px; text-align: justify;"><strong><i class="material-icons">content_paste</i> ¿Se encuentra actualmente bajo tratamiento médico?</strong></label>
                                                            </div>                             
                                                            <div class="col-sm-3 text-center" style="padding-top: 0px;">
                                                                <div class="choice" style="display: inline-block;" data-input="tratamiento_actual_asegurado_<?=$i?>" data-value="Si" data-other="choice_tratamiento_actual_asegurado_<?=$i?>_no" data-div="div_tratamiento_actual_asegurado_<?=$i?>" onclick="showText(this)" id="choice_tratamiento_actual_asegurado_<?=$i?>_si">
                                                                    <input type="radio" name="tratamiento_actual_asegurado_<?=$i?>" value="Si" id="tratamiento_actual_asegurado_<?=$i?>_si">
                                                                    <div class="icon">
                                                                        <i class="fa fa-check"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="choice" style="display: inline-block;" data-input="tratamiento_actual_asegurado_<?=$i?>" data-value="No" data-other="choice_tratamiento_actual_asegurado_<?=$i?>_si" data-div="div_tratamiento_actual_asegurado_<?=$i?>" onclick="showText(this)" id="choice_tratamiento_actual_asegurado_<?=$i?>_no">
                                                                    <input type="radio" name="tratamiento_actual_asegurado_<?=$i?>" value="No" id="tratamiento_actual_asegurado_<?=$i?>_no">
                                                                    <div class="icon">
                                                                        <i class="fa fa-close"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12" id="div_tratamiento_actual_asegurado_<?=$i?>" style="display:none">
                                                        <div class="form-group label-floating col-sm-9">
                                                            <label class="control-label">Explique</label>
                                                            <input type="text" class="form-control" id="detalles_tratamiento_actual_asegurado_<?=$i?>_principal" name="detalles_tratamiento_actual_asegurado_<?=$i?>_principal" required>
                                                        </div>
                                                    </div> 
                                                    <div class="col-sm-12">
                                                        <div class="form-group label-floating">
                                                            <div class="col-sm-9">
                                                            <label style="margin-top:15px; text-align: justify;"><strong><i class="material-icons">content_paste</i> ¿Tiene algún síntoma o dolor, no diagnosticado y manifestado de forma continuada o reiterada?</strong></label>
                                                            </div>
                                                            <div class="col-sm-3 text-center" style="padding-top: 0px;">
                                                                <div class="choice" style="display: inline-block;" data-input="sintoma_actual_asegurado_<?=$i?>" data-value="Si" data-other="choice_sintoma_actual_asegurado_<?=$i?>_no" data-div="div_sintoma_actual_asegurado_<?=$i?>" onclick="showText(this)" id="choice_sintoma_actual_asegurado_<?=$i?>_si">
                                                                    <input type="radio" name="sintoma_actual_asegurado_<?=$i?>" value="Si" id="sintoma_actual_asegurado_<?=$i?>_si">
                                                                    <div class="icon">
                                                                        <i class="fa fa-check"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="choice" style="display: inline-block;" data-input="sintoma_actual_asegurado_<?=$i?>" data-value="No" data-other="choice_sintoma_actual_asegurado_<?=$i?>_si" data-div="div_sintoma_actual_asegurado_<?=$i?>" onclick="showText(this)" id="choice_sintoma_actual_asegurado_<?=$i?>_no">
                                                                    <input type="radio" name="sintoma_actual_asegurado_<?=$i?>" value="No" id="sintoma_actual_asegurado_<?=$i?>_no">
                                                                    <div class="icon">
                                                                        <i class="fa fa-close"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>                                            
                                                    <div class="col-sm-12" id="div_sintoma_actual_asegurado_<?=$i?>" style="display:none">
                                                        <div class="form-group label-floating col-sm-9">
                                                            <label class="control-label">Explique</label>
                                                            <input type="text" class="form-control" id="detalles_sintoma_actual_asegurado_<?=$i?>_principal" name="detalles_sintoma_actual_asegurado_<?=$i?>_principal" required>
                                                        </div>
                                                    </div>                                
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        <?php }?>
                                        </div>   
                                    </div>                                    
                                    <div class="tab-pane" id="datos_tomador">
                                        <a class="btn btn-info steps">3/5</a>
                                        <h4 class="info-text"><strong>Datos del tomador de la póliza</strong></h4>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group label-floating">
                                                    <div class="col-sm-9">
                                                    <label style="margin-top:15px; text-align: justify;"><strong><i class="fa fa-question-circle-o"></i> ¿El titular asegurado es el tomador de la póliza?</strong></label>
                                                    </div>
                                                    <div class="col-sm-3 text-right" style="padding-top: 0px;">
                                                        <div class="choice"  style="display: inline-block;"data-input="asegurado_tomador" data-value="No" data-other="choice_asegurado_tomador_no" data-div="div_asegurado_tomador" onclick="showText(this)" id="choice_asegurado_tomador_si">
                                                            <input type="radio" name="asegurado_tomador" value="Si" id="asegurado_tomador_si">
                                                            <div class="icon">
                                                                <i class="fa fa-check"></i>
                                                            </div>
                                                        </div>
                                                        <div class="choice" style="display: inline-block;" data-input="asegurado_tomador"  data-value="Si" data-other="choice_asegurado_tomador_si" data-div="div_asegurado_tomador" onclick="showText(this)" id="choice_asegurado_tomador_no">
                                                            <input type="radio" name="asegurado_tomador" value="No" id="asegurado_tomador_no">
                                                            <div class="icon">
                                                                <i class="fa fa-close"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" id="div_asegurado_tomador" style="display:none">
                                            <div class="col-sm-4">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">person</i>
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Nombre</label>
                                                        <input type="text" class="form-control tomador" id="nombre_tomador" name="nombre_tomador" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">person</i>
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Apellido 1</label>
                                                        <input type="text" class="form-control tomador" id="apellido1_tomador" name="apellido1_tomador" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">person</i>
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Apellido 2</label>
                                                        <input type="text" class="form-control" id="apellido2_tomador" name="apellido2_tomador">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">event</i>
                                                    </span> 
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Fecha de nacimiento</label>
                                                        <input type="date" class="form-control tomador flatpickr" id="fecha_nacimiento_tomador" name="fecha_nacimiento_tomador" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">phone_iphone</i>
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Teléfono móvil</label>
                                                        <input type="text" class="form-control tomador" id="movil_tomador" name="movil_tomador" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">local_phone</i>
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Teléfono fijo</label>
                                                        <input type="text" class="form-control" id="telefono_fijo_tomador" name="telefono_fijo_tomador">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">account_circle</i>
                                                    </span> 
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Tipo de Documento de identidad</label>
                                                        <select name="documento_identidad_tomador" class="form-control tomador" required>
                                                            <option disabled="" selected=""></option>
                                                            <option value="NIF"> NIF </option>
                                                            <option value="Pasaporte"> Pasaporte </option>
                                                            <option value="NIE"> NIE </option>
                                                            <option value="DNI"> DNI </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">account_circle</i>
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">N° Documento de Identidad</label>
                                                        <input type="text" class="form-control tomador" id="no_documento_identidad_tomador" name="no_documento_identidad_tomador" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12"><hr></div>
                                            <div class="col-sm-3">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">location_on</i>
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">País</label>
                                                        <select name="pais_direccion_tomador" id="pais_direccion_tomador" class="form-control" required onchange="codigoPostal(this)" data-input="codigo_postal_tomador">
                                                            <option disabled="" selected=""></option>
                                                            <option value="1">España</option>
                                                            <option value="2">Venezuela</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">location_on</i>
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Dirección</label>
                                                        <input type="text" class="form-control tomador" id="direccion_tomador" name="direccion_tomador" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">location_on</i>
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Número</label>
                                                        <input type="text" class="form-control tomador" id="numero_tomador" name="numero_tomador" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">location_on</i>
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Bloque, escalera, piso..</label>
                                                        <select name="tipo_numero_tomador" class="form-control tomador" required>
                                                            <option disabled="" selected=""></option>
                                                            <option value="Bloque">Bloque</option>
                                                            <option value="Escalera">Escalera</option>
                                                            <option value="Piso">Piso</option>
                                                            <option value="Puerta">Puerta</option>
                                                            <option value="Portal">Portal</option>
                                                        </select>
                                                    </div>                                                
                                                </div>
                                            </div>                                        
                                            <div class="col-sm-3">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">location_on</i>
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Municipio</label>
                                                        <input type="text" class="form-control tomador" id="municipio_tomador" name="municipio_tomador" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">location_on</i>
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Código Postal</label>
                                                        <input type="text" class="form-control tomador" id="codigo_postal_tomador" name="codigo_postal_tomador">
                                                    </div>
                                                </div>
                                            </div>    
                                            <div class="col-sm-12"><hr></div>  
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">attach_file</i>
                                                    </span>
                                                    <div class="form-group">
                                                        <label class="control-label">Documento de Identidad</label>
                                                        <input type="file" class="file-images opcional" id="archivo_documento_identidad_tomador" name="file[]" required>
                                                    </div>
                                                </div>
                                            </div>                                            
                                            <!--<div class="col-sm-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">attach_file</i>
                                                    </span>
                                                    <div class="form-group">
                                                        <label class="control-label">Carta de Matriculación</label>
                                                        <input type="file" class="file-images opcional" id="archivo_carta_matriculacion_tomador" name="file[]">
                                                    </div>
                                                </div>
                                            </div>-->                                        
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group label-floating">
                                                    <div class="col-sm-9">
                                                    <label style="text-align: justify;"><strong><i class="fa fa-question-circle-o"></i> ¿Desea recibir la información de alta en una dirección distinta a la indicada anteriormente?</strong></label>
                                                    </div>
                                                    <div class="col-sm-3 text-right" style="padding-top: 0px;">
                                                        <div class="choice"  style="display: inline-block;"data-input="otra_direccion" data-value="Si" data-other="choice_otra_direccion_no" data-div="div_otra_direccion" onclick="showText(this)" id="choice_otra_direccion_si">
                                                            <input type="radio" name="otra_direccion" value="Si" id="otra_direccion_si">
                                                            <div class="icon">
                                                                <i class="fa fa-check"></i>
                                                            </div>
                                                        </div>
                                                        <div class="choice" style="display: inline-block;" data-input="otra_direccion"  data-value="No" data-other="choice_otra_direccion_si" data-div="div_otra_direccion" onclick="showText(this)" id="choice_otra_direccion_no">
                                                            <input type="radio" name="otra_direccion" value="No" id="otra_direccion_no">
                                                            <div class="icon">
                                                                <i class="fa fa-close"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" id="div_otra_direccion" style="display:none">
                                            <div class="col-sm-3">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">location_on</i>
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">País</label>
                                                        <select name="pais_direccion_informacion" id="pais_direccion_informacion" class="form-control" required onchange="codigoPostal(this)" data-input="codigo_postal_informacion">
                                                            <option disabled="" selected=""></option>
                                                            <option value="1">España</option>
                                                            <option value="2">Venezuela</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">location_on</i>
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Dirección</label>
                                                        <input type="text" class="form-control informacion" id="direccion_informacion" name="direccion_informacion" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">location_on</i>
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Número</label>
                                                        <input type="text" class="form-control informacion" id="numero_informacion" name="numero_informacion" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">location_on</i>
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Bloque, escalera, piso..</label>
                                                        <select name="tipo_numero_informacion" class="form-control informacion" required>
                                                            <option disabled="" selected=""></option>
                                                            <option value="Bloque">Bloque</option>
                                                            <option value="Escalera">Escalera</option>
                                                            <option value="Piso">Piso</option>
                                                            <option value="Puerta">Puerta</option>
                                                            <option value="Portal">Portal</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>                                           
                                            <div class="col-sm-3">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">location_on</i>
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Municipio</label>
                                                        <input type="text" class="form-control informacion" id="municipio_informacion" name="municipio_informacion" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">location_on</i>
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Código Postal</label>
                                                        <input type="text" class="form-control informacion" id="codigo_postal_informacion" name="codigo_postal_informacion">
                                                    </div>
                                                </div>
                                            </div>                                            
                                        </div>
                                        <h4 class="info-text"><strong>Método de pago</strong></h4>
                                        <div class="row">                                                       
                                            <div class="col-sm-4">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">event</i>
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">¿Cuándo deseas que inicie tu póliza?</label>
                                                        <input type="date" class="form-control flatpickr-poliza" id="inicio_poliza" name="inicio_poliza">
                                                    </div>
                                                </div>
                                            </div>                                          
                                            <div class="col-sm-4">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">list</i>
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Método de Pago</label>
                                                        <select name="metodo_pago" id="metodo_pago" class="form-control" onchange="paymentMethod(this)">
                                                            <option disabled="" selected=""></option>
                                                            <option value="Tarjeta"> Tarjeta de Débito/Crédito </option>
                                                            <option value="Cuenta"> Cuenta Bancaria en España</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>                                         
                                            <div class="col-sm-4" id="div_datos_bancarios" style="display:none">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">account_balance</i>
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">IBAN</label> 
                                                        <input type="text" class="form-control" id="iban" name="iban" maxlength="28" minlength="28">
                                                    </div>
                                                </div>
                                            </div>  
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tratamiento_datos">
                                        <a class="btn btn-info steps">4/5</a>
                                        <h4 class="info-text"><strong>Tratamiento de datos personales</strong></h4>
                                        <p><strong>La falta de aceptación de los tratamientos que se incluyen a continuación no condiciona la solicitud o el contrato de seguro con Pages. Salvo que indique lo contrario marcando alguna de las siguientes opciones, con la firma de la presente cláusula el Solicitante consiente que Pages pueda realizar cada uno de los siguientes tratamientos sobre los Datos Personales de los interesados, incluidos datos personales de salud:</strong></p>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group label-floating">
                                                    <div class="col-sm-10">
                                                    <label style="text-align: justify;"><strong><i class="fa fa-question-circle-o"></i> Consiento el tratamiento de mis datos personales para finalidades promocionales de productos y servicios de Pages o de terceras empresas, incluyendo el envío por medios electrónicos de comunicaciones comerciales o equivalentes por parte de Pages, incluso aunque no llegue a contratar.</strong></label>
                                                    </div>
                                                    <div class="col-sm-2 text-right">
                                                        <div class="choice"  style="display: inline-block;"data-input="promociones" data-value="Si" data-other="choice_promociones_no" data-div="div_promociones" onclick="tratamientoDatos(this)" id="choice_promociones_si">
                                                            <input type="radio" name="promociones" value="Si" id="promociones_si">
                                                            <div class="icon">
                                                                <i class="fa fa-check"></i>
                                                            </div>
                                                        </div>
                                                        <div class="choice" style="display: inline-block;" data-input="promociones"  data-value="No" data-other="choice_promociones_si" data-div="div_promociones" onclick="tratamientoDatos(this)" id="choice_promociones_no">
                                                            <input type="radio" name="promociones" value="No" id="promociones_no">
                                                            <div class="icon">
                                                                <i class="fa fa-close"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group label-floating">
                                                    <div class="col-sm-10">
                                                    <label style="text-align: justify;"><strong><i class="fa fa-question-circle-o"></i> Consiento la cesión y el tratamiento de mis datos personales por las entidades del grupo de Pages con fines de investigación cientifica y/o estadistica y fines comerciales, así como de las terceras empresas colaboradoras identificadas en la Información Adicional con la finalidad de remitirme información comercial relacionada con productos y servicios financieros, seguros, servicios socio-sanitarios y/o de salud o bienestar, incluyendo el envio de comunicaciones comerciales por medios electrónicos.</strong></label>
                                                    </div>
                                                    <div class="col-sm-2 text-right">
                                                        <div class="choice"  style="display: inline-block;"data-input="terceros" data-value="Si" data-other="choice_terceros_no" data-div="div_terceros" onclick="tratamientoDatos(this)" id="choice_terceros_si">
                                                            <input type="radio" name="terceros" value="Si" id="terceros_si">
                                                            <div class="icon">
                                                                <i class="fa fa-check"></i>
                                                            </div>
                                                        </div>
                                                        <div class="choice" style="display: inline-block;" data-input="terceros"  data-value="No" data-other="choice_terceros_si" data-div="div_terceros" onclick="tratamientoDatos(this)" id="choice_terceros_no">
                                                            <input type="radio" name="terceros" value="No" id="terceros_no">
                                                            <div class="icon">
                                                                <i class="fa fa-close"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group label-floating">
                                                    <div class="col-sm-10">
                                                    <label style="text-align: justify;"><strong><i class="fa fa-question-circle-o"></i> Consiento el tratamiento de mis datos personales con el fin de que Pages lleve a cabo un análisis de mis intereses y necesidades con base en los datos proporcionados por mi incluyendo pero sin limitarse a mis datos de salud, aquellos datos personales que se hayan generado como consecuencia del servicio prestado por Pages o que haya obtenido Pages por otros medios, pudiendo incluir dicho tratamiento la toma de decisiones automatizadas.</strong></label>
                                                    </div>
                                                    <div class="col-sm-2 text-right">
                                                        <div class="choice"  style="display: inline-block;"data-input="automatizacion" data-value="Si" data-other="choice_automatizacion_no" data-div="div_automatizacion" onclick="tratamientoDatos(this)" id="choice_automatizacion_si">
                                                            <input type="radio" name="automatizacion" value="Si" id="automatizacion_si">
                                                            <div class="icon">
                                                                <i class="fa fa-check"></i>
                                                            </div>
                                                        </div>
                                                        <div class="choice" style="display: inline-block;" data-input="automatizacion"  data-value="No" data-other="choice_automatizacion_si" data-div="div_automatizacion" onclick="tratamientoDatos(this)" id="choice_automatizacion_no">
                                                            <input type="radio" name="automatizacion" value="No" id="automatizacion_no">
                                                            <div class="icon">
                                                                <i class="fa fa-close"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="datos_cotizacion">
                                        <a class="btn btn-info steps">5/5</a>
                                        <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="col-sm-6 col-sm-offset-3">
                                                        <div style="border-color:#214285; border-radius: 6px; padding: 5px;">
                                                          <div class="cotizacion cot-numero">Cotización: <?php echo($numero_cotizacion) ?>                  
                                                          </div>
                                                          <div>
                                                            <h5 class="card-title cotizacion cot-producto"><?php echo(str_replace("_", " ", $producto)); ?></h5>
                                                            <p class="card-text cotizacion cot-mensual"><?php echo($mensual) ?> &#8364 / mes</p>
                                                                <div class="col-sm-4 cotizacion cot-detalle">
                                                                    <p class="cot-icons"><i class="fa fa-users" aria-hidden="true"></i></p>
                                                                    <p class="cot-icons"><?php echo($cant_familiares+1) ?></p>
                                                                </div>
                                                                <div class="col-sm-4 cotizacion cot-detalle">
                                                                    <p class="cot-icons"><i class="fa fa-flag" aria-hidden="true"></i></p>
                                                                    <p class="cot-icons"><?php echo($pais) ?></p>
                                                                </div>
                                                                <div class="col-sm-4 cotizacion cot-detalle">
                                                                    <p class="cot-icons"><i class="fa fa-eur" aria-hidden="true"></i></p>
                                                                    <p class="cot-icons"><?php echo($anual) ?></p>
                                                                </div>
                                                          </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <!--
                                            <div class="col-sm-4">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">adjust</i>
                                                    </span>                                                
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Número Cotización</label>
                                                        <input type="text" class="form-control" id="num_cot" name="num_cot" size="40" readonly value=<?= isset($numero_cotizacion)?htmlspecialchars($numero_cotizacion):'' ?>>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">adjust</i>
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">País</label>
                                                        <input type="text" class="form-control" id="pais" name="pais" readonly value=<?= isset($pais)?htmlspecialchars($pais):'' ?>>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">adjust</i>
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Producto</label>
                                                        <input type="text" class="form-control" id="producto" name="producto" readonly value=<?= isset($producto)?htmlspecialchars($producto):'' ?>>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">adjust</i>
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Prima Mensual</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" id="prima_mensual" name="prima_mensual" readonly value=<?= isset($mensual)?htmlspecialchars($mensual):'' ?>>
                                                            <span class="input-group-addon">$</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">                                                
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">adjust</i>
                                                    </span>

                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Prima Anual</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" id="prima_anual" name="prima_anual" readonly value=<?= isset($anual)?htmlspecialchars($anual):'' ?>>
                                                            <span class="input-group-addon">$</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>-->
                                            <input id="num_cot" name="num_cot" type="hidden" value=<?= isset($numero_cotizacion)?htmlspecialchars($numero_cotizacion):'' ?>>
                                            <input id="pais" name="pais" type="hidden" value=<?= isset($pais)?htmlspecialchars($pais):'' ?>>
                                            <input id="producto" name="producto" type="hidden" value=<?= isset($producto)?htmlspecialchars($producto):'' ?>>
                                            <input id="prima_mensual" name="prima_mensual" type="hidden" value=<?= isset($mensua)?htmlspecialchars($mensua):'' ?>>
                                            <input id="prima_anual" name="prima_anual" type="hidden" value=<?= isset($anual)?htmlspecialchars($anual):'' ?>>
                                            <input id="cant_familiares" name="cant_familiares" type="hidden" value=<?= isset($cant_familiares)?htmlspecialchars($cant_familiares):'' ?>>
                                        </div>
                                    </div>
                                </div>
                                <div class="wizard-footer">
                                    <div class="pull-right">
                                        <input type='button' class='btn btn-next btn-fill btn-info btn-wd' name='next' value='Siguiente' />
                                        <input type='submit' class='btn btn-finish btn-fill btn-info btn-wd' name='finish' value='Finalizar'/>
                                    </div>
                                    <div class="pull-left">
                                        <input type='button' class='btn btn-previous btn-fill btn-default btn-wd' name='previous' value='Anterior' />
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </form>
                        </div>
                    </div> <!-- wizard container -->
                </div>
            </div> <!-- row -->
        </div> <!--  big container -->

        <div class="footer">
            <div class="container text-center">
                 <!--Made by <a href="http://www.creative-tim.com">Creative Tim</a>.-->
            </div>
        </div>
    </div>

</body>
    <!--   Core JS Files   -->
    <script src="assets/wizard/js/jquery-2.2.4.min.js" type="text/javascript"></script>
    <script src="assets/wizard/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/wizard/js/jquery.bootstrap.js" type="text/javascript"></script>

    <!--  Plugin for the Wizard -->
    <script src="assets/wizard/js/material-bootstrap-wizard.js"></script>

    <!--  More information about jquery.validate here: http://jqueryvalidation.org/  -->
    <script src="assets/wizard/js/jquery.validate.min.js"></script>
    <script src="assets/formulario/js/validaciones.js"></script>


    <script src="assets/bootstrap-fileinput/js/plugins/piexif.js" type="text/javascript"></script>
    <script src="assets/bootstrap-fileinput/js/plugins/sortable.js" type="text/javascript"></script>
    <script src="assets/bootstrap-fileinput/js/fileinput.js" type="text/javascript"></script>
    <script src="assets/bootstrap-fileinput/js/locales/fr.js" type="text/javascript"></script>
    <script src="assets/bootstrap-fileinput/js/locales/es.js" type="text/javascript"></script>
    <script src="assets/bootstrap-fileinput/themes/gly/theme.js" type="text/javascript"></script>
    <script src="assets/bootstrap-fileinput/themes/fas/theme.js" type="text/javascript"></script>
    <script src="assets/bootstrap-fileinput/themes/explorer-fas/theme.js" type="text/javascript"></script>
    <script>$.fn.fileinput.defaults.theme = 'gly';</script>

    <script src="assets/flatpickr/flatpickr.min.js" type="text/javascript"></script>
    <script src="assets/flatpickr/dist/es.js" type="text/javascript"></script>
    <script src="assets/imask/imask.js" type="text/javascript"></script>
    <script src="assets/sweetalert/sweetalert2.all.min.js"></script>

    <script>

    window.onload = function() {
        Swal.fire({
            title: 'La solicitud no implica aceptación inmediata de la misma. Para que tú seguro entre en vigor debe ser aceptado por la aseguradora y posteriormente aceptado y autorizado por ti.',
            icon: 'info',
            iconColor: '#214285',
            confirmButtonText: 'Ok',
            confirmButtonColor: '#214285'
        })
    };

    var iban = document.getElementById('iban');
    var optionsIBAN = {
      mask: 'ES00 0000 0000 00 0000000000'
    };
    var mask = IMask(iban, optionsIBAN);

    $(".file-images").fileinput({
        //showPreview: false,
        showUpload: false,
        showCancel: false,
        dropZoneEnabled: false,
        allowedFileExtensions: ["jpg", "jpeg", "png", "pdf"],
        language: 'es',
        maxFileSize: 8192,
        maxFileCount:1,        
        browseClass: "btn btn-info btn-sm",
        removeClass: "btn btn-danger btn-sm",
    });

    $(".flatpickr").flatpickr({
        defaultDate: new Date(),
        dateFormat: "d/m/Y",
        locale: "es",
    }); 

    $(".flatpickr-poliza").flatpickr({
        defaultDate: new Date().fp_incr(1),   
        minDate: new Date().fp_incr(1),
        dateFormat: "d/m/Y",
        locale: "es",
        //enable: ["30/07/2021", "15/08/2021", "30/08/2021"]
    }); 

    </script>
</html>
