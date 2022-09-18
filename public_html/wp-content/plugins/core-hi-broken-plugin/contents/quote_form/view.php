<div class="quote-form">
  <form id="searchForm" class="wpcf7-form" >
    <input type="hidden" name="user_id" value="<?php echo $_COOKIE['idMediador']; ?>"/>
    <div class="columns_wrap">
      <div class="column-1">
        <span class="wpcf7-form-control-wrap">
          <div class="select_container">
            <select required onchange=""  name="categoria" id="categoria" class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required filled fill_inited" aria-required="true" aria-invalid="false">
              <option value="">¿Qué tipo de seguro buscas?</option>
              <option value="1">Salud</option>
              <option value="2">Repatriación</option>
              <option value="3">Estudiantes</option>
              <option value="4">Salud + reembolso</option>
              <option value="5">Salud internacional</option>
            </select>
          </div>
          <p id="errorCategoria" style="color:red;font-size:12px;"></p>
        </span>
      </div>
      <div class="column-1_2">
        <span class="wpcf7-form-control-wrap">
          <div class="select_container">
            <select required name="pais" id="pais" class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required filled fill_inited" aria-required="true" aria-invalid="false">
            </select>
            <input type="hidden" name="nombre_pais" id="nombre_pais"/>
          </div>
          <p id="errorPais" style="color:red;font-size:12px;"></p>
        </span>
      </div>
      <div class="column-1_2">
        <span class="wpcf7-form-control-wrap"><div
            class="select_container">
            <select style="display:none" name="provincia" id="provincia" class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required filled fill_inited" aria-invalid="false">
            </select>
            <input type="hidden" name="nombre_provincia" id="nombre_provincia"/>
          </div>
          <p id="errorProvincia" style="color:red;font-size:12px;"></p>
        </span>
      </div>
    </div>
    <div class="columns_wrap">
      <div class="column-1_2">
        <span class="wpcf7-form-control-wrap">
          <input required id="nombres" type="text" name="nombres" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required fill_inited" aria-required="true" aria-invalid="false" placeholder="Nombres"/>
          <p id="errorNombre" style="color:red;font-size:12px;"></p></span>
      </div>
      <div class="column-1_2">
        <span class="wpcf7-form-control-wrap">
          <input required id="apellidos" type="text" name="apellidos" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required fill_inited" aria-required="true" aria-invalid="false" placeholder="Apellidos"/>
          <p id="errorApellido" style="color:red;font-size:12px;"></p></span>
      </div>

      <div class="column-1_2">
        <span class="wpcf7-form-control-wrap">
          <input required id="fecha_nac" type="text" name="fecha_nac" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required fill_inited" aria-required="true" aria-invalid="false" placeholder="Fecha de nacimiento"  data-inputmask="'alias': 'dd-mm-yyyy'" data-mask/>
          <p id="errorFechaNac" style="color:red;font-size:12px;"></p></span>
      </div>
      <div class="column-1_2">
        <span class="wpcf7-form-control-wrap">
          <!--<input required id="movil" type="text" name="movil" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-tel wpcf7-validates-as-required wpcf7-validates-as-tel" aria-required="true" aria-invalid="false" placeholder="Movil" data-inputmask='"mask": "(+99) 999-9999999"' data-mask/>-->
          <input required id="movil" name="movil" type="tel" size="40" class="wpcf7-form-control wpcf7-text wpcf7-tel wpcf7-validates-as-required wpcf7-validates-as-tel" aria-required="true" aria-invalid="false"/>
          <p id="errormovil" style="color:red;font-size:12px;"></p></span>
        
      </div>
      <div class="column-1_2">
        <span class="wpcf7-form-control-wrap">
          <input required id="email" type="email" name="email" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required fill_inited" aria-required="true" aria-invalid="false" placeholder="Email"/>
          <p id="errorEmail" style="color:red;font-size:12px;"></p></span>
      </div>

      <!--<div class="column-1_2">
        <span class="wpcf7-form-control-wrap">
          <input required id="emailVerificacion" type="email" name="emailVerificacion" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required fill_inited" aria-required="true" aria-invalid="false" placeholder="EmailVerificacion"/>
          <p id="errorEmail" style="color:red;font-size:12px;"></p></span>

        <input id="phone" name="phone" type="text" size="40" class="wpcf7-form-control wpcf7-text wpcf7-tel wpcf7-validates-as-required wpcf7-validates-as-tel" aria-required="true" aria-invalid="false"/>
      </div>-->
      
      <div class="column-1_2">
        <span class="wpcf7-form-control-wrap">
          <div class="select_container">
            <select required name="cant_familiares" id="beneficiarios" class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required filled fill_inited" aria-required="true" aria-invalid="false">
              <option value="">¿Asegurados adicionales al solicitante?</option>
              <option value="0">0</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
            </select>
          </div>
          <p id="errorBeneficiario" style="color:red;font-size:12px;"></p>
        </span>
      </div>
      
      <!--SECCION DE FAMILIARES-->
      <!--<div class="seccion_familiares">-->
      <div class="column-1_3" style="display:none" id="div_fechanac1" >
        <span class="wpcf7-form-control-wrap">
          <span class="wpcf7-form-control wpcf7-nro">
            <span class="wpcf7-form-control-wrap">
              <input id="fechanac1" type="text" name="fechanac[]" value="" size="5" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required fill_inited" aria-required="true" aria-invalid="false" placeholder="fechanac1"/>
            </span>
          </span>
        </span>
      </div>
      <div class="column-1_3" style="display:none" id="div_fechanac2">
        <span class="wpcf7-form-control-wrap">
          <span class="wpcf7-form-control wpcf7-nro">	
            <span class="wpcf7-form-control-wrap">
              <input type="text" id="fechanac2" name="fechanac[]" value="" size="5" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required fill_inited" aria-required="true" aria-invalid="false" placeholder="fechanac2"/>
            </span>	
          </span>	
        </span>
      </div>
      <div class="column-1_3" style="display:none" id="div_fechanac3">
        <span class="wpcf7-form-control-wrap">
          <span class="wpcf7-form-control wpcf7-nro">
            <span class="wpcf7-form-control-wrap">
              <input id="fechanac3" type="text" name="fechanac[]" value="" size="5" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required fill_inited" aria-required="true" aria-invalid="false" placeholder="fechanac3"/>
            </span>
          </span>
        </span>
      </div>
      <div class="column-1_3" style="display:none" id="div_fechanac4">
        <span class="wpcf7-form-control-wrap nro">
          <span class="wpcf7-form-control wpcf7-nro">
            <span class="wpcf7-form-control-wrap">
              <input id="fechanac4" type="text" name="fechanac[]" value="" size="5" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required fill_inited" aria-required="true" aria-invalid="false" placeholder="fechanac4"/>
            </span>
          </span>
        </span>
      </div>
      <div class="column-1_3" style="display:none" id="div_fechanac5">
        <span class="wpcf7-form-control-wrap">
          <span class="wpcf7-form-control wpcf7-nro">
            <span class="wpcf7-form-control-wrap">
              <input id="fechanac5" type="text" name="fechanac[]" value="" size="5" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required fill_inited" aria-required="true" aria-invalid="false" placeholder="fechanac5"/>
            </span>
          </span>
        </span>
      </div>
      <div class="column-1_3" style="display:none" id="div_fechanac6">
        <span class="wpcf7-form-control-wrap">
          <span class="wpcf7-form-control wpcf7-nro">
            <span class="wpcf7-form-control-wrap">
              <input id="fechanac6" type=text name="fechanac[]" value=""  class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required fill_inited" aria-required="true" aria-invalid="false" placeholder="fechanac6"/>
            </span>
          </span>
        </span>
      </div>
      <!--FIN DE SECCION DE FAMILIARES-->
      <div class="column-1_2">
        <span class="wpcf7-form-control-wrap">			  
          <span class="wpcf7-form-control">
            <span class="wpcf7-list-item">
              <label>
                <input type="checkbox" id="tomador" name="tomador" value="1" aria-invalid="false"/>
                <span class="wpcf7-list-item-label">
                  ¿El tomador es un asegurado?
                </span>
              </label>
            </span>
          </span>
        </span>
      </div>
      <div class="column-1_1">
        <span class="wpcf7-form-control-wrap">
          <span class="wpcf7-form-control">
            <span class="wpcf7-list-item">
              <label>
                <input type="checkbox" id="acepto" name="acepto" value="1" aria-invalid="false"/>
                <span class="wpcf7-list-item-label">
                  Acepto que mis datos enviados se recopilan y almacenan.
                </span>
              </label>
            </span>
            <p id="errorAcepto" style="color:red;font-size:12px;"></p>
          </span>
        </span>
      </div>
      <div class="column-1_1">
        <input id="btn-fetch-quote" type="button" value="CONSULTAR TARIFAS" class="buton-hb" style="width:100%"/>
      </div>
    </div>
  </form>
  <div id="output_quote_form_result" class="closed" data-parent="<?php echo $args["output_container_selector"] ?? ""; ?>">
    <h5 style="text-align: center">Esperando respuesta</h5>
    <div class="mobileHide">
      <div id="table-container">
        <table id="results" class="table hidden-md-down" width="100%">
          <thead>
            <tr class="table-result">
              <th>ASEGURADORA</th>
              <th>PRECIO MENSUAL <span class="currency"></span></th>
              <th>PRECIO ANUAL <span class="currency"></span></th>
              <th>PROMOCION</th>
              <th>COPAGO</th>
              <th>EDAD ASEGURABLE</th>
              <th>SUMA ASEGURADA</th>
              <th>DESCRIPCI&Oacute;N</th>
              <th style="width: 200px;"></th>
            </tr>
          </thead>
          <tbody class="content">
          </tbody>
        </table>
        <br>
      </div>
    </div>
    <div class="mobileShow">
      <section id="results" class="mobileShow wpb_wrapper">
      </section>
    </div>
    <button class="close-result">Realizar otra consulta</button>
  </div>
  
</div>

