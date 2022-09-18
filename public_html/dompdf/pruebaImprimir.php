
<?php
   
  require_once("dompdf/dompdf_config.inc.php");
  ini_set('memory_limit', '2048M'); // or you could use 1G
  ini_set('max_execution_time', 1800);

  

  
   $html='<!doctype html>
<html class="no-js" lang="">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Reporte Ejecutivo de Cliente</title>
    <meta name="description" content="">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <link rel="manifest" href="site.webmanifest">
    <link rel="apple-touch-icon" href="icon.png">
    <!-- Place favicon.ico in the root directory -->
    <link rel="stylesheet" href="2018/css/normalize.css">
    <link rel="stylesheet" href="2018/css/reportes.css">
    <link rel="stylesheet" href="2018/css/fonts/fonts-ruben.css">
    <link rel="stylesheet" href="2018/css/app.css">

  </head>
  <body>
    
    <!-- PORTADA -->
    <div class="seccion">
      <div class="contenedor1">
        <a class="btn btn-primary" target="_blank" href="imprimir_reporte_cliente.php">Exportar PDF</a>
        <img src="img/DIGISALUD_BLANCO.svg" alt="" class="logo-portada">

        <div class="imagen-portada"></div>
        <div class="info-portada">
          <div class="logo-empresa">
            <img src="img/logo-empresa-reporte.png" alt="">
          </div>
          <div class="titulo-reporte">
            <p>Informe de Resultados Antropométricos <br>
            <span>Mes 2018</span></p>
          </div>
        </div>
      </div>
    </div>
    
    <!-- lamina 1 -->
    <div class="seccion">
      <div class="contenedor2">
        <div class="encabezado-seccion">
          <div class="icono-izquierda">
            <img src="img/iconoDigisalud-blanco.svg" alt="">
          </div>
          <div class="titulo-pagina">
            <p>Jornadas Antropométricas</p>
          </div>
          <div class="icono-derecha">
            <img src="img/antripometria-blanco.svg" alt="">
          </div>
        </div>
        <div class="contenidos">

          <div class="fila-contenidos">

            <div class="col">
              <p class="icono"><img src="img/beneficiariosEvaluados.svg" alt=""></p>
              <p class="info" style="height: 60px">Beneficiarios <br>Evaluados</p>
              <p class="valor">XXX</p>
            </div>

            <div class="col">
              <div class="subfila-contenidos">
                <div class="subcol text-center"><img src="img/masculino.svg" alt=""></div>
                <div class="subcol text-center"><img src="img/femenino.svg" alt=""></div>
              </div>
              <div class="subfila-contenidos" style="height: 60px">
                <div class="subcol text-center">M</div>
                <div class="subcol text-center">F</div>
              </div>
              <div class="equis" style="display: flex; flex-direction: row; justify-content: space-evenly; width: 100%; padding-top: 10px; position: relative; top: 8px; ">
                <p class="valor">XXX</p>
                <p class="valor">XXX</p>
              </div>
            </div>

          </div>

          <div class="fila-contenidos clearfix">

            <div class="col">
              <p class="icono"><img src="img/beneficiariosEvaluados.svg" alt=""></p>
              <p class="info">< de 5 años</p>
              <p class="valor">XXX</p>
            </div>

            <div class="col">
              <p class="icono"><img src="img/5-19.svg" alt=""></p>
              <p class="info">5-19 años</p>
              <p class="valor">XXX</p>
            </div>

            <div class="col">
              <p class="icono"><img src="img/mayores19.svg" alt=""></p>
              <p class="info">Adultos</p>
              <p class="valor">XXX</p>
            </div>

            <div class="col">
              <p class="icono"><img src="img/embarazada-azul.svg" alt=""></p>
              <p class="info">Embarazadas</p>
              <p class="valor">XXX</p>
            </div>

          </div>
          
          <br class="clearfix">

          <div class="tabla clearfix">
              <div class="fila-tabla encabezado-tabla">
                <div class="colummna-tabla">Localidades</div>
                <div class="colummna-tabla">Fechas de <br>Evaluación</div>
                <div class="colummna-tabla">Beneficiarios <br>Evaluados</div>
              </div>

              <div class="fila-tabla">
                <div class="colummna-tabla bold">xxx</div>
                <div class="colummna-tabla bold">xx, xx Mes</div>
                <div class="colummna-tabla bold">xxx</div>
              </div>

              <div class="fila-tabla">
                <div class="colummna-tabla bold">xxx</div>
                <div class="colummna-tabla bold">xx Mes</div>
                <div class="colummna-tabla bold">xxx</div>
              </div>

              <div class="fila-tabla">
                <div class="colummna-tabla bold">xxx</div>
                <div class="colummna-tabla bold">xx Mes</div>
                <div class="colummna-tabla bold">xxx</div>
              </div>

            </div>

        </div>
      </div>
    </div>
  
    <!--  lamina 2 -->
    <div class="seccion">
      <div class="contenedor3">
        <div class="encabezado-seccion">
          <div class="icono-izquierda">
            <img src="img/iconoDigisalud-blanco.svg" alt="">
          </div>
          <div class="titulo-pagina">
            <p>Resultados por EDAD y condición fisiológica <br>
            <span>Puntaje Z</span></p>
          </div>
          <div class="icono-derecha">
          </div>
        </div>
        <div class="contenidos">
            
            <div class="titulo-pretabla">
              <div class="col-titulo-pretabla">Beneficiarios < de 5 Años</div>
              <div class="col-titulo-pretabla"><img src="img/menores5.svg" alt="" width="36"></div>
            </div>

            <div class="tabla clearfix">
              <div class="fila-tabla encabezado-tabla">
                <div class="colummna-tabla">Interpretación</div>
                <div class="colummna-tabla">Cantidad</div>
              </div>

              <div class="fila-tabla" style="align-items: center;">
                <div class="colummna-tabla"><img src="img/pesoTallaAdecuado.svg" alt="" height="54"> Peso y Talla Adecuada</div>
                <div class="colummna-tabla">xx | xx%</div>
              </div>

              <div class="fila-tabla">
                <div class="colummna-tabla"><img src="img/PesoTallaenRiesgo.svg" alt="" height="54"> Peso y Talla en Riesgo</div>
                <div class="colummna-tabla">xx | xx%</div>
              </div>

              <div class="fila-tabla">
                <div class="colummna-tabla"><img src="img/PesoTallaLeveModerado.svg" alt="" height="54"> Peso y Talla Leve/Moderado</div>
                <div class="colummna-tabla">xx | xx%</div>
              </div>
              
              <div class="fila-tabla">
                <div class="colummna-tabla"><img src="img/PesoTallaAtencionInmediata.svg" alt="" height="54"> Peso y Talla de Atención Inmediata</div>
                <div class="colummna-tabla">xx | xx%</div>
              </div>

            </div>

            <hr>
            
            <div class="titulo-pretabla">
              <div class="col-titulo-pretabla">Beneficiarios 5-19 Años</div>
              <div class="col-titulo-pretabla"><img src="img/5-19.svg" alt="" width="36"></div>
            </div>
            <div class="tabla clearfix">
              <div class="fila-tabla encabezado-tabla">
                <div class="colummna-tabla">Interpretación</div>
                <div class="colummna-tabla">Cantidad</div>
              </div>

              <div class="fila-tabla">
                <div class="colummna-tabla"><img src="img/pesoTallaAdecuado.svg" alt="" height="54"> Peso y Talla Adecuada</div>
                <div class="colummna-tabla">xx | xx%</div>
              </div>

              <div class="fila-tabla">
                <div class="colummna-tabla"><img src="img/PesoTallaenRiesgo.svg" alt="" height="54"> Peso y Talla en Riesgo</div>
                <div class="colummna-tabla">xx | xx%</div>
              </div>

              <div class="fila-tabla">
                <div class="colummna-tabla"><img src="img/PesoTallaLeveModerado.svg" alt="" height="54"> Peso y Talla Leve/Moderado</div>
                <div class="colummna-tabla">xx | xx%</div>
              </div>
              
              <div class="fila-tabla">
                <div class="colummna-tabla"><img src="img/PesoTallaAtencionInmediata.svg" alt="" height="54"> Peso y Talla de Atención Inmediata</div>
                <div class="colummna-tabla">xx | xx%</div>
              </div>

            </div>

        </div>
      </div>
    </div>
    
    <!-- lamina 3 -->
    <div class="seccion">
      <div class="contenedor4">
        <div class="encabezado-seccion">
          <div class="icono-izquierda">
            <img src="img/iconoDigisalud-blanco.svg" alt="">
          </div>
          <div class="titulo-pagina">
            <p>Resultados por EDAD y condición fisiológica <br>
            <span>Puntaje Z</span></p>
          </div>
          <div class="icono-derecha">
            <img src="img/antripometria-blanco.svg" alt="">
          </div>
        </div>
        <div class="contenidos">
        
        <div class="titulo-pretabla">
          <div class="col-titulo-pretabla">Beneficiarios <em>Adultos</em></div>
          <div class="col-titulo-pretabla"><img src="img/mayores19.svg" alt="" width="36"></div>
        </div>        
        <div class="tabla clearfix">
              <div class="fila-tabla encabezado-tabla">
                <div class="colummna-tabla">Interpretación</div>
                <div class="colummna-tabla">Cantidad</div>
              </div>

              <div class="fila-tabla">
                <div class="colummna-tabla"><img src="img/pesoTallaAdecuado.svg" alt="" height="54"> Peso adecuado y riesgo de ECNT bajo</div>
                <div class="colummna-tabla">xx | xx%</div>
              </div>

              <div class="fila-tabla">
                <div class="colummna-tabla"><img src="img/PesoTallaenRiesgo.svg" alt="" height="54"> Peso y riesgo de ECNT leve</div>
                <div class="colummna-tabla">xx | xx%</div>
              </div>

              <div class="fila-tabla">
                <div class="colummna-tabla"><img src="img/PesoTallaLeveModerado.svg" alt="" height="54"> Peso y riesgo de ECNT Moderado</div>
                <div class="colummna-tabla">xx | xx%</div>
              </div>
              
              <div class="fila-tabla">
                <div class="colummna-tabla"><img src="img/PesoTallaAtencionInmediata.svg" alt="" height="54"> Peso y riesgo de ECNT de Atención Inmediata</div>
                <div class="colummna-tabla">xx | xx%</div>
              </div>

            </div>

            <hr>

            <div class="titulo-pretabla">
              <div class="col-titulo-pretabla">Beneficiarios <em>Embarazadas</em></div>
              <div class="col-titulo-pretabla"><img src="img/embarazada-azul.svg" alt="" width="36"></div>
            </div>
            <div class="tabla clearfix">
              <div class="fila-tabla encabezado-tabla">
                <div class="colummna-tabla">Interpretación</div>
                <div class="colummna-tabla">Cantidad</div>
              </div>

              <div class="fila-tabla">
                <div class="colummna-tabla"><img src="img/embarazada_GananciaPesoAdecuada.svg" alt="" height="54"> Ganancia en Peso Adecuada</div>
                <div class="colummna-tabla">xx | xx%</div>
              </div>
<!-- 
              <div class="fila-tabla">
                <div class="colummna-tabla"><img src="img/embarazada_GananciaPesoInsuficiente.svg" alt="" height="54"> Peso y Talla en Riesgo</div>
                <div class="colummna-tabla">xx | xx%</div>
              </div> -->

              <div class="fila-tabla">
                <div class="colummna-tabla"><img src="img/embarazada_GananciaPesoExcesiva.svg" alt="" height="54"> Ganancia en peso insuficiente o excesiva</div>
                <div class="colummna-tabla">xx | xx%</div>
              </div>

            </div>

        </div>
      </div>
    </div>
    
    <!-- lamina 4 -->
    <div class="seccion">
      <div class="contenedor5">
        <div class="encabezado-seccion">
          <div class="icono-izquierda">
            <img src="img/iconoDigisalud-blanco.svg" alt="">
          </div>
          <div class="titulo-pagina">
            <p>Resultados por LOCALIDAD <br>
            <span>Puntaje Z</span></p>
          </div>
          <div class="icono-derecha">
            <img src="img/antripometria-blanco.svg" alt="">
          </div>
        </div>
        <div class="contenidos">
          
        <div class="titulo-pretabla">
          <div class="col-titulo-pretabla">Beneficiarios <em>< de 5 Años</em></div>
          <div class="col-titulo-pretabla"><img src="img/menores5.svg" alt="" width="36"></div>
        </div>
        <div class="tabla tipo2 clearfix">
          <div class="fila-tabla encabezado-tabla">
            <div class="colummna-tabla">Localidades</div>
            <div class="colummna-tabla"><img src="img/pesoTallaAdecuado.svg" alt="" height="32"></div>
            <div class="colummna-tabla"><img src="img/PesoTallaenRiesgo.svg" alt="" height="32"></div>
            <div class="colummna-tabla"><img src="img/PesoTallaLeveModerado.svg" alt="" height="32"></div>
            <div class="colummna-tabla"><img src="img/PesoTallaAtencionInmediata.svg" alt="" height="32"></div>
          </div>

          <div class="fila-tabla">
            <div class="colummna-tabla"> XXX</div>
            <div class="colummna-tabla">xx | xx%</div>
            <div class="colummna-tabla">xx | xx%</div>
            <div class="colummna-tabla">xx | xx%</div>
            <div class="colummna-tabla">xx | xx%</div>
          </div>

          <div class="fila-tabla">
            <div class="colummna-tabla"> XXX</div>
            <div class="colummna-tabla">xx | xx%</div>
            <div class="colummna-tabla">xx | xx%</div>
            <div class="colummna-tabla">xx | xx%</div>
            <div class="colummna-tabla">xx | xx%</div>
          </div>

          <div class="fila-tabla">
            <div class="colummna-tabla"> XXX</div>
            <div class="colummna-tabla">xx | xx%</div>
            <div class="colummna-tabla">xx | xx%</div>
            <div class="colummna-tabla">xx | xx%</div>
            <div class="colummna-tabla">xx | xx%</div>
          </div>
          
          <div class="fila-tabla">
            <div class="colummna-tabla"> XXX</div>
            <div class="colummna-tabla">xx | xx%</div>
            <div class="colummna-tabla">xx | xx%</div>
            <div class="colummna-tabla">xx | xx%</div>
            <div class="colummna-tabla">xx | xx%</div>
          </div>

        </div>

        <hr>

        <div class="titulo-pretabla">
          <div class="col-titulo-pretabla">Beneficiarios <em>5 a 19 Años</em></div>
          <div class="col-titulo-pretabla"><img src="img/5-19.svg" alt="" width="36"></div>
        </div>
        <div class="tabla tipo2 clearfix">
          <div class="fila-tabla encabezado-tabla">
            <div class="colummna-tabla">Localidades</div>
            <div class="colummna-tabla"><img src="img/pesoTallaAdecuado.svg" alt="" height="32"></div>
            <div class="colummna-tabla"><img src="img/PesoTallaenRiesgo.svg" alt="" height="32"></div>
            <div class="colummna-tabla"><img src="img/PesoTallaLeveModerado.svg" alt="" height="32"></div>
            <div class="colummna-tabla"><img src="img/PesoTallaAtencionInmediata.svg" alt="" height="32"></div>
          </div>

          <div class="fila-tabla">
            <div class="colummna-tabla"> XXX</div>
            <div class="colummna-tabla">xx | xx%</div>
            <div class="colummna-tabla">xx | xx%</div>
            <div class="colummna-tabla">xx | xx%</div>
            <div class="colummna-tabla">xx | xx%</div>
          </div>

          <div class="fila-tabla">
            <div class="colummna-tabla"> XXX</div>
            <div class="colummna-tabla">xx | xx%</div>
            <div class="colummna-tabla">xx | xx%</div>
            <div class="colummna-tabla">xx | xx%</div>
            <div class="colummna-tabla">xx | xx%</div>
          </div>

          <div class="fila-tabla">
            <div class="colummna-tabla"> XXX</div>
            <div class="colummna-tabla">xx | xx%</div>
            <div class="colummna-tabla">xx | xx%</div>
            <div class="colummna-tabla">xx | xx%</div>
            <div class="colummna-tabla">xx | xx%</div>
          </div>
          
          <div class="fila-tabla">
            <div class="colummna-tabla"> XXX</div>
            <div class="colummna-tabla">xx | xx%</div>
            <div class="colummna-tabla">xx | xx%</div>
            <div class="colummna-tabla">xx | xx%</div>
            <div class="colummna-tabla">xx | xx%</div>
          </div>

        </div>
   
        </div>
      </div>
    </div>
    
    <!-- lamina 5 -->
    <div class="seccion">
      <div class="contenedor6">
        <div class="encabezado-seccion">
          <div class="icono-izquierda">
            <img src="img/iconoDigisalud-blanco.svg" alt="">
          </div>
          <div class="titulo-pagina">
            <p>Resultados por LOCALIDAD <br>
            <span>Puntaje Z</span></p>
          </div>
          <div class="icono-derecha">
            <img src="img/antripometria-blanco.svg" alt="">
          </div>
        </div>
        <div class="contenidos">
          
        <div class="titulo-pretabla">
          <div class="col-titulo-pretabla">Beneficiarios <em>Adultos</em></div>
          <div class="col-titulo-pretabla"><img src="img/mayores19.svg" alt="" width="36"></div>
        </div>
        <div class="tabla tipo2 clearfix">
          <div class="fila-tabla encabezado-tabla">
            <div class="colummna-tabla">Localidades</div>
            <div class="colummna-tabla"><img src="img/pesoTallaAdecuado.svg" alt="" height="32"></div>
            <div class="colummna-tabla"><img src="img/PesoTallaenRiesgo.svg" alt="" height="32"></div>
            <div class="colummna-tabla"><img src="img/PesoTallaLeveModerado.svg" alt="" height="32"></div>
            <div class="colummna-tabla"><img src="img/PesoTallaAtencionInmediata.svg" alt="" height="32"></div>
          </div>

          <div class="fila-tabla">
            <div class="colummna-tabla"> XXX</div>
            <div class="colummna-tabla">xx | xx%</div>
            <div class="colummna-tabla">xx | xx%</div>
            <div class="colummna-tabla">xx | xx%</div>
            <div class="colummna-tabla">xx | xx%</div>
          </div>

          <div class="fila-tabla">
            <div class="colummna-tabla"> XXX</div>
            <div class="colummna-tabla">xx | xx%</div>
            <div class="colummna-tabla">xx | xx%</div>
            <div class="colummna-tabla">xx | xx%</div>
            <div class="colummna-tabla">xx | xx%</div>
          </div>

          <div class="fila-tabla">
            <div class="colummna-tabla"> XXX</div>
            <div class="colummna-tabla">xx | xx%</div>
            <div class="colummna-tabla">xx | xx%</div>
            <div class="colummna-tabla">xx | xx%</div>
            <div class="colummna-tabla">xx | xx%</div>
          </div>
          
          <div class="fila-tabla">
            <div class="colummna-tabla"> XXX</div>
            <div class="colummna-tabla">xx | xx%</div>
            <div class="colummna-tabla">xx | xx%</div>
            <div class="colummna-tabla">xx | xx%</div>
            <div class="colummna-tabla">xx | xx%</div>
          </div>

        </div>

        <hr>

        <div class="titulo-pretabla">
          <div class="col-titulo-pretabla">Beneficiarios <em>Embarazadas</em></div>
          <div class="col-titulo-pretabla"><img src="img/embarazada-azul.svg" alt="" width="36"></div>
        </div>
        <div class="tabla tipo2 clearfix">
          <div class="fila-tabla encabezado-tabla">
            <div class="colummna-tabla">Localidades</div>
            <div class="colummna-tabla"><img src="img/embarazada_GananciaPesoAdecuada.svg" alt="" height="32"></div>

            <div class="colummna-tabla"><img src="img/embarazada_GananciaPesoExcesiva.svg" alt="" height="36"></div>
          </div>
          
          <div class="fila-tabla">
            <div class="colummna-tabla"> XXX</div>
            <div class="colummna-tabla">xx | xx%</div>

            <div class="colummna-tabla">xx | xx%</div>
          </div>
          
          <div class="fila-tabla">
            <div class="colummna-tabla"> XXX</div>
            <div class="colummna-tabla">xx | xx%</div>

            <div class="colummna-tabla">xx | xx%</div>
          </div>

        </div>

        </div>
      </div>
    </div>
    
    <!-- lamina 6 -->
    <div class="seccion">
      <div class="contenedor7">
        <div class="encabezado-seccion">
          <div class="icono-izquierda">
            <img src="img/iconoDigisalud-blanco.svg" alt="">
          </div>
          <div class="titulo-pagina">
            <p>Hallazgos</p>
          </div>
          <div class="icono-derecha">
            <img src="img/antripometria-blanco.svg" alt="">
          </div>
        </div>
        <div class="contenidos">
          
        <div class="titulo-pretabla">
          <div class="col-titulo-pretabla">Talla para la Edad | <19 años</div>
          <div class="col-titulo-pretabla"></div>
        </div>
        <div class="contenidos-texto-imagen">
          <div class="col-texto-imagen">
            <p>La Talla / Edad refleja el crecimiento de los niños, niñas y adolescentes. Este es un indice que permite identificar de forma ágil, económica y sencilla los problemas de desnutrición crónica para una muestra de Pacientes. Cuando el Promedio del Indice por Edad se aleja del valor cero (Media o valor ideal) hacia los valores negativos, nos indica que la muestra de pacientes en ese rango presenta un alto porcentaje de retardo de crecimiento o desnutrición crónica, mientras que cuando el promedio tiende a valores positivos presenta una población de Pacientes altos, de estaturas superiores a la Población de Referencia.</p>
            <p>El Indice de Masa Corporal (IMC) refleja la corpulencia de los niños, niñas y adolescentes con respecto a su talla. Este es un indice que permite identificar de forma ágil, económica y sencilla los problemas de desnutrición aguda y sobrepeso para una muestra de Pacientes. Cuando el Promedio del Indice se aleja del valor cero (Media o valor ideal) hacia los valores negativos, nos indica que la muestra de pacientes en ese rango presenta un alto porcentaje de desnutrición aguda, mientras que cuando el promedio tiende a valores positivos presenta una población de Pacientes con sobrepeso u obesidad.</p>
          </div>
          <div class="col-texto-imagen">
            <table class="data">
              <thead>
                <tr>
                  <th>Edad (en años)</th>
                  <th>Promedio por Indicador por Edad</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>0</td>
                  <td>1.70</td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>1.70</td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>1.70</td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>1.70</td>
                </tr>
                <tr>
                  <td>4</td>
                  <td>1.70</td>
                </tr>
                <tr>
                  <td>5</td>
                  <td>1.70</td>
                </tr>
                <tr>
                  <td>6</td>
                  <td>1.70</td>
                </tr>
                <tr>
                  <td>7</td>
                  <td>1.70</td>
                </tr>
                <tr>
                  <td>8</td>
                  <td>1.70</td>
                </tr>
                <tr>
                  <td>9</td>
                  <td>1.70</td>
                </tr>
                <tr>
                  <td>10</td>
                  <td>1.70</td>
                </tr>
                <tr>
                  <td>11</td>
                  <td>1.70</td>
                </tr>
                <tr>
                  <td>12</td>
                  <td>1.70</td>
                </tr>
                <tr>
                  <td>13</td>
                  <td>1.70</td>
                </tr>
                <tr>
                  <td>14</td>
                  <td>1.70</td>
                </tr>
                <tr>
                  <td>15</td>
                  <td>1.70</td>
                </tr>
                <tr>
                  <td>16</td>
                  <td>1.70</td>
                </tr>
                <tr>
                  <td>17</td>
                  <td>1.70</td>
                </tr>
                <tr>
                  <td>18</td>
                  <td>1.70</td>
                </tr>
                <tr>
                  <td>19</td>
                  <td>1.70</td>
                </tr>
              </tbody>
            </table>

            <!-- <p><img src="img/puntaje-talla-edades.png" alt=""></p> -->

          </div>
        </div>

       <!--  <hr>
        <div class="titulo-pretabla">
          <div class="col-titulo-pretabla">Índice de Masa Corporal | &lt;19 años</div>
          <div class="col-titulo-pretabla"></div>
        </div>

        <p><img src="img/imc-por-edades.png" alt="" width="60%"></p> -->


        </div>
      </div>
    </div>

    <div class="seccion">
      <div class="contenedor7">
        <div class="encabezado-seccion">
          <div class="icono-izquierda">
            <img src="img/iconoDigisalud-blanco.svg" alt="">
          </div>
          <div class="titulo-pagina">
            <p>Hallazgos</p>
          </div>
          <div class="icono-derecha">
            <img src="img/antripometria-blanco.svg" alt="">
          </div>
        </div>
        <div class="contenidos">

         <div class="titulo-pretabla">
          <div class="col-titulo-pretabla">Talla para la Edad | <19 años</div>
          <div class="col-titulo-pretabla"></div>
        </div>

       <p class="text-center"><img src="img/puntaje-talla-edades.png" alt="" width="60%"></p>
       
      <hr>  

        <div class="titulo-pretabla">
          <div class="col-titulo-pretabla">Índice de Masa Corporal | &lt;19 años</div>
          <div class="col-titulo-pretabla"></div>
        </div>

        <p class="text-center"><img src="img/imc-por-edades.png" alt="" width="60%"></p>


        </div>
      </div>
    </div>

    <div class="seccion">
      <div class="contenedor8">
        <div class="encabezado-seccion">
          <div class="icono-izquierda">
            <img src="img/iconoDigisalud-blanco.svg" alt="">
          </div>
          <div class="titulo-pagina">
            <p>Hallazgos</p>
          </div>
          <div class="icono-derecha">
            <img src="img/antripometria-blanco.svg" alt="">
          </div>
        </div>
        <div class="contenidos">
          
        <div class="titulo-pretabla">
          <div class="col-titulo-pretabla">Interpretación Combinada | Adultos</div>
          <div class="col-titulo-pretabla"></div>
        </div>

        <div class="contenidos-solo-imagen">
          <p><img src="img/interpretacion-adultos-combinada.png" alt=""></p>
          <p><img src="img/pie-adultos-combinada.png" alt=""></p>
        </div>

        <hr>

        <div class="titulo-pretabla">
          <div class="col-titulo-pretabla">Interpretación Combinada | Embarazadas</div>
          <div class="col-titulo-pretabla"></div>
        </div>

        <div class="contenidos-solo-imagen">
          <p><img src="img/interpretacion-embarazadas-combinada.png" alt=""></p>
          <p><img src="img/pie-embarazadas-combinada.png" alt=""></p>
        </div>

        </div>
      </div>
    </div>

    <div class="seccion">
      <div class="contenedor9">
        
        <img src="img/DIGISALUD_BLANCO.svg" alt="" class="logo-portada">

        <div class="titulo-pretabla iconos-redes">
          <div class="col-titulo-pretabla"><img src="img/redesSocialesDigisalud.svg" alt=""  width="240"></div>
          <div class="col-titulo-pretabla"><img src="img/paginaWebDigisalud.svg" alt=""  width="220"></div>
        </div>

      </div>
    </div>


    <div class="ocultar">
      <p class="lead">A fin de ver el resultado de salida del reporte <a href="" onclick="window.print()">imprima esta página</a></p>
    </div>
  </body>
</html>';
  


  $dompdf = new DOMPDF();

  $dompdf->load_html($html);
  $dompdf->set_paper("a4","portrait");
  //$dompdf->set_paper("a4","portrait");

  $dompdf->render();
  $dompdf->stream("Listado de personas.pdf", array("Attachment" => 0));

  ?>
   
