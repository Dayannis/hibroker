if ((document.cookie.search(/idMediador/) == -1 && (location.pathname.search(/(wp-admin|wp-login)/) == -1 && location.pathname != '/' && location.pathname != '/login/')) || (document.cookie.search(/idMediador/) != -1 && location.pathname == '/login/')) {
  window.stop(); 
  location.href='/logout.php';
} else if ((document.cookie.search(/idMediador/) != -1 && (location.pathname == '/' || location.pathname == '/login/'))) {
  window.stop(); 
  location.href='/home';
}

(function(){
  callback = function(){
    if (document.cookie.search(/idMediador/) != -1){
      jQuery("#userMediadorName").html("<b>Hola, "+Cookies.get("nombre").split("+").join(" ")+"!</b>");
      jQuery(".quote-form input[name=user_id]").val(Cookies.get("idMediador"))
    }
    if (jQuery(".quote-form").length){
    
      result_container = jQuery("#output_quote_form_result")
      jQuery(result_container.data("parent")).append(result_container)
      result_container.find("button.close-result").click(function(){
        result_container.addClass("closed")
        jQuery("#btn-fetch-quote").removeAttr("disabled")
        jQuery(".quote-form form")[0].reset()
        var position_scroll = 0;
        if ($(document).width() < 480)
          position_scroll = $("body header").height() + $("#output_quote_form_result").parent().offset().top - 100
        else
          position_scroll = $("#content-quote-form-result").offset().top-$("body header").height()+90
        jQuery([document.documentElement, document.body]).animate({
          scrollTop: position_scroll
        }, 500);
      })

      //Datemask dd-mm-yyyy
      jQuery('#fecha_nac').inputmask('dd-mm-yyyy', {
        'placeholder': 'dd-mm-yyyy'
      })
      jQuery('#fechanac1').inputmask('dd-mm-yyyy', {
        'placeholder': 'dd-mm-yyyy'
      })
      jQuery('#fechanac2').inputmask('dd-mm-yyyy', {
        'placeholder': 'dd-mm-yyyy'
      })
      jQuery('#fechanac3').inputmask('dd-mm-yyyy', {
        'placeholder': 'dd-mm-yyyy'
      })
      jQuery('#fechanac4').inputmask('dd-mm-yyyy', {
        'placeholder': 'dd-mm-yyyy'
      })
      jQuery('#fechanac5').inputmask('dd-mm-yyyy', {
        'placeholder': 'dd-mm-yyyy'
      })
      jQuery('#fechanac6').inputmask('dd-mm-yyyy', {
        'placeholder': 'dd-mm-yyyy'
      })
      jQuery('[data-mask]').inputmask()
      
      jQuery("#nombres").keypress(function(evt){
        return HBUtils.allowCharacter(evt)
      })
      jQuery("#apellidos").keypress(function(evt){
        return HBUtils.allowCharacter(evt)
      })

      var select_country = jQuery(".quote-form #pais")
      var select_province = jQuery(".quote-form #provincia")

      HBAPI.getCountries(function(data){
        select_country
        .empty()
        .append(jQuery("<option />", {value: ""}).html("¿En qué país está tu cliente?"))
        if (data.status.success){
          for (let index = 0; index < data.content.length; index++) {
            const country = data.content[index];
            select_country.append(jQuery("<option />", {value: country["id"]}).html(country["name"]))
          }
        }
      })

      select_country.change(function(evt){
        var idCountry = jQuery(evt.target).val();
        jQuery("#nombre_pais").val(
          jQuery(evt.target).children(":selected").html());

        if (idCountry != "" && idCountry != "2"){

          //$("#movil").inputmask({"mask": "(+34) 999-999999"});

          HBAPI.getProvinces({idCountry}, function(data){
            select_province
            .empty()
            .append(jQuery("<option />", {value: ""}).html("Provincia"))
            if (data.status.success){
              for (let index = 0; index < data.content.length; index++) {
                const province = data.content[index];
                select_province.append(jQuery("<option />", {value: province["id"]}).html(province["name"]))
              }
              select_province.show()
              select_province.attr("required", true);
            }
          })
        }/*else if(idCountry != "" && idCountry == "2"){
          $("#movil").inputmask({"mask": "(+58) 999-9999999"});
		      }   */     
        else{
          //$("#movil").inputmask({"mask": "(+99) 999-99999999"});
          select_province.removeAttr("required");
          select_province.val("");
          select_province.hide();
          jQuery("#nombre_provincia").val("");
        }
      })


      select_province.change(function(evt){
        jQuery("#nombre_provincia").val(
          jQuery(evt.target).children(":selected").html())
      })

      jQuery(".quote-form #beneficiarios").change(function(evt){
        jQuery("#tomador").prop("checked", true);
        var beneficiarios = parseInt(jQuery("#beneficiarios option:selected").val());
        if (beneficiarios) {
          if (beneficiarios > 0 && beneficiarios <= 6) {
            for (var i = 1; i <= 6; i++) {
              jQuery("#fechanac" + i).attr("required", false);
              jQuery("#fechanac" + i).val("");
              jQuery("#div_fechanac" + i).hide()
            }

            for (var i = 1; i <= beneficiarios; i++) {
              jQuery("#fechanac" + i).attr("required", true);
              jQuery("#div_fechanac" + i).show()
            }
          }
        } else {
          for (var i = 1; i <= 6; i++) {
            jQuery("#fechanac" + i).attr("required", false);
            jQuery("#fechanac" + i).val("");
            jQuery("#div_fechanac" + i).hide()
          }
        }
      })

      $("a").click(function(e) {
        e.preventDefault();
        var href = "https://www.google.com/";
        window.open(href);
        return false;
      });

      jQuery(".quote-form #btn-fetch-quote").click(function(evt){
        var inputs = HBUtils.getFormData(jQuery(".quote-form form"))
        
        has_error = false;

        if (jQuery("#categoria option:selected").val() != ""){
          jQuery("#errorCategoria").text("")
        } else {
          has_error = true
          jQuery("#errorCategoria").text("Debes indicar qué tipo de seguro buscas.")
        }

        if (jQuery("#pais option:selected").val() != ""){
          jQuery("#errorPais").text("")
        } else {
          has_error = true
          jQuery("#errorPais").text("Debes indicar el pais")
        }

        if (!jQuery("#provincia").is(":visible") || (jQuery("#provincia").is(":visible") && jQuery("#provincia option:selected").val() != "")){
          jQuery("#errorProvincia").text("")
        } else {
          has_error = true
          jQuery("#errorProvincia").text("Debes seleccionar una provincia")
        }

        if (jQuery("#nombres").val() != "" && jQuery("#nombres").val().length >= 3){
          jQuery("#errorNombre").text("")
        } else {
          has_error = true
          jQuery("#errorNombre").text("Debes completar tu nombre")
        }

        if (jQuery("#apellidos").val() != "" && jQuery("#apellidos").val().length >= 3){
          jQuery("#errorApellido").text("")
        } else {
          has_error = true
          jQuery("#errorApellido").text("Debes completar tu apellido")
        }

        if (jQuery("#fecha_nac").val() != ""){
          jQuery("#errorFechaNac").text("")
        } else {
          has_error = true
          jQuery("#errorFechaNac").text("Debes completar tu f. de nac ")
        }

          /*
              var movil = jQuery("#movil").val();

              var pais_selected = jQuery("#pais option:selected").val();

              if (movil != ""){
                movil = movil.replace('-', '');
                movil = movil.replace(' ', '');
                movil = movil.replace('_', '');
                movil = movil.replace('(', '');
                movil = movil.replace(')', '');

                if(pais_selected == 1){
                  var reg_exp_mobile = /^(\+34)(6|7)[0-9]{8}$/;
                }else if(pais_selected == 2){
                  var reg_exp_mobile = /^(\+58)(412|414|416|424|426)[0-9]{7}$/;
                }
                else{
                  jQuery("#errormovil").text("Selecciona un país e indica un movil válido")
            }*/
		  
          if (jQuery("#movil").val() != ""){
          jQuery("#errormovil").text("")
          } else {
          has_error = true
          jQuery("#errormovil").text("Debes completar el campo movil")
          }
        
		      /*
          if(reg_exp_mobile.test(movil) === false){
            jQuery("#errormovil").text("El movil introducido es inválido")
          }
          else{
            jQuery("#errormovil").text("")
          }
        } else {
          has_error = true
          jQuery("#errormovil").text("Debes completar el campo movil")
        }*/

        if (jQuery("#email").val() != ""){
          jQuery("#errorEmail").text("")
        } else {
          has_error = true
          jQuery("#errorEmail").text("Debes completar el campo correo")
        }

        if (jQuery("#beneficiarios option:selected").val() != ""){
          jQuery("#errorBeneficiario").text("")
          var beneficiarios = parseInt(jQuery("#beneficiarios option:selected").val());
          for (var i = 1; i <= beneficiarios; i++) {
            if (jQuery("#fechanac" + i).val() == ""){
              has_error = true
              jQuery("#errorBeneficiario").text("Debes completar la f. de nacimiento de los beneficiarios.")
            }
          }

        } else {
          has_error = true
          jQuery("#errorBeneficiario").text("Debes seleccionar cuantos beneficiarios son")
        }

        if (jQuery("#acepto").prop("checked")){
          jQuery("#errorAcepto").text("")
        } else {
          has_error = true
          jQuery("#errorAcepto").text("Debes aceptar nuestros terminos y condiciones")
        }

        if (!has_error){
          jQuery(evt.target).prop("disabled", "disabled")
          HBAPI.fetchQuotes(inputs, function(data){
          	result_container.removeClass("closed")
            result_container.find("h5").html(data.title ?? "RESULTADOS" )
            var table = jQuery("table#results .content").empty()
            var cards = jQuery("section#results").empty()
            
            
            
            if (data.status.success){
              jQuery("table#results .currency").html(data.content.currency)
              data.content.rows.forEach(row => {
                options = jQuery("<form />", {action:"https://hi-broker.com/cotizacionPDF.php", method:"post", target:"_blank"})
                .append(jQuery("<input/>", { type: "hidden", name: "producto", value: row.form.nombre }))
                .append(jQuery("<input/>", { type: "hidden", name: "anual", value: row.form.anual }))
                .append(jQuery("<input/>", { type: "hidden", name: "mensual", value: row.form.mensual }))
                .append(jQuery("<input/>", { type: "hidden", name: "nombre", value: row.form.nombre }))
                .append(jQuery("<input/>", { type: "hidden", name: "nombre_provincia", value: row.form.nombre_provincia }))
                .append(jQuery("<input/>", { type: "hidden", name: "nombre_pais", value: row.form.nombre_pais }))
                .append(jQuery("<input/>", { type: "hidden", name: "productosList", value: row.form.productosList }))
                .append(jQuery("<input/>", { type: "hidden", name: "mensualList", value: row.form.mensualList }))
                .append(jQuery("<input/>", { type: "hidden", name: "codigoProducto", value: row.form.codigoProducto }))
                .append(jQuery("<input/>", { type: "hidden", name: "tomador", value: row.form.tomador }))
                .append(jQuery("<input/>", { type: "hidden", name: "pais", value: row.form.pais }))
                .append(jQuery("<input/>", { type: "hidden", name: "provincia", value: row.form.provincia }))
                .append(jQuery("<input/>", { type: "hidden", name: "nombres", value: row.form.nombres }))
                .append(jQuery("<input/>", { type: "hidden", name: "apellidos", value: row.form.apellidos }))
                .append(jQuery("<input/>", { type: "hidden", name: "fecha_nac", value: row.form.fecha_nac }))
                .append(jQuery("<input/>", { type: "hidden", name: "movil", value: row.form.movil }))
                .append(jQuery("<input/>", { type: "hidden", name: "email", value: row.form.email }))
                .append(jQuery("<input/>", { type: "hidden", name: "categoria", value: row.form.categoria }))
                .append(jQuery("<input/>", { type: "hidden", name: "cant_familiares", value: row.form.cant_familiares }))
                .append(jQuery("<input/>", { type: "hidden", name: "fecha_nac_bene", value: row.form.fecha_nac_bene }))
                .append(jQuery("<input/>", { type: "hidden", name: "numero_cotizacion", value: row.form.numero_cotizacion }))
                .append(jQuery("<div />")
                  .append(jQuery("<input />", { type: "submit", id: "btn1", class: "buton-hb btn-rounded img view", value: "", title: "VER COTIZACIÓN", name:"button1"}))
                  .append(jQuery("<input />", { type: "submit", id: "btn2", class: "buton-hb btn-rounded img download", value: "", title: "DESCARGAR SOLICITUD", name:"button2"}))
                  //.append(jQuery("<input />", { type: "submit", id: "btn3", class: "buton-hb btn-rounded img see", value: "", title: "CUADRO MÉDICO", name:"button3"}))
                  //.append(jQuery("<input />", { type: "submit", id: "btnSol", class: "buton-hb btn-rounded img sol", value: "", title: "Solicitar", name:"button4"}))
                )

                table.append(
                  jQuery("<tr />")
                  .append(jQuery("<td />").append(jQuery("<img />", {src: row.imagen, width: "80%"})))
                  .append(jQuery("<td />").append(jQuery("<b />", {text: row.mensual}).css({"color":"orange"})))                                    
                  .append(jQuery("<td />").append(jQuery("<b />", {text: row.anual}).css({"color":"orange"})))
                  .append(jQuery("<td />").append(jQuery("<img />", {src: row.promo, width: "80%"})))
                  .append(jQuery("<td />").append(jQuery("<p />", {text: row.copago}).css({"text-align":"center"})))
                  .append(jQuery("<td />").append(jQuery("<p />", {text: row.e}).css({"text-align":"center"})))
                  .append(jQuery("<td />").append(jQuery("<p />", {text: row.sumaAsegurada}).css({"text-align":"center"})))
                  //.append(jQuery("<td />").append(jQuery("<p />", {text: row.descripcion.substring(0, 30) + '...'}).append("<a href='#'>(ver mas)</a>")))//+ 
                  .append(jQuery("<td />").append(jQuery("<p />", {text: row.descripcion})))//+ 
                  .append(jQuery("<td />").append(options))
                )
                
                cards.append(
                  jQuery("<div />", { class: "mobileShow" })
                  .append(jQuery("<div />", { id: "sc_price", class: "sc_price color_style_default sc_price_default" })
                    .append(jQuery("<div />", { class: "sc_price_content sc_item_content" })
                      .append(jQuery("<div />", { class: "sc_price_item sc_price_item_default" })
                        .append(jQuery("<div />", { class: "price-body" })
                          .append(jQuery("<div />", { class: "sc_price_item_details" })
                            .html(
                              "<b>ASEGURADORA: </b><br><img src="+row.imagen+" width=\"100px\"><br>" +
                              "<b>EDAD ASEGURABLE: </b>"+row.e+"<br>" +
                              "<b>SUMA ASEGURADA: </b>"+row.sumaAsegurada+"<br>" +
                              "<b>PRECIO MENSUAL: </b><br><b style=\"color:orange\">"+data.content.currency+" "+row.mensual+"</b><br>" +
                              "<b>PRECIO ANUAL:</b><br> <b style=\"color:orange\">"+data.content.currency+" "+row.anual + "</b><br>" +
                              "<b>PROMOCION: </b><br><img src="+row.promo+" width=\"100px\"><br>" +
                              "<b>COPAGO: </b>"+row.copago+"<br>" +
                              "<b>COBERTURAS: </b>"+row.descripcion+"<br><br>"
                            )
                            .append(options.clone())
                          )))))
                )
              });
            }
            else {
              table.append(
                jQuery("<tr />")
                .append(jQuery("<td />", {colspan: 7})
                   .append(jQuery("<p />", {text: data.status.message }).css({"text-align":"center"})))
              )
              
              cards.append(
                jQuery("<div />", { class: "mobileShow" })
                .append(jQuery("<div />", { id: "sc_price", class: "sc_price color_style_default sc_price_default" })
                  .append(jQuery("<div />", { class: "sc_price_content sc_item_content" })
                    .append(jQuery("<div />", { class: "sc_price_item sc_price_item_default" })
                      .append(jQuery("<div />", { class: "price-body" })
                        .append(jQuery("<div />", { class: "sc_price_item_details" })
                          .append(jQuery("<p />", {text: data.status.message }).css({"text-align":"center"}))
                        )))))
              )
            }
            
            var position_scroll = 0;
            if ($(document).width() < 480)
                position_scroll = $("#output_quote_form_result").parent().height() + $("#output_quote_form_result").parent().offset().top - $("#output_quote_form_result").height()
            else
               position_scroll = $("#content-quote-form-result").offset().top-$("body header").height()+90
            jQuery([document.documentElement, document.body]).animate({
                scrollTop: position_scroll
            }, 500);
          })
        }
      })
        var input = document.querySelector("#movil");
        var iti = window.intlTelInput(input, {
          // allowDropdown: false,
          // autoHideDialCode: false,
          // autoPlaceholder: "off",
          //dropdownContainer: document.body,
          // excludeCountries: ["us"],
          formatOnDisplay: true,
          // geoIpLookup: function(callback) {
          //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
          //     var countryCode = (resp && resp.country) ? resp.country : "";
          //     callback(countryCode);
          //   });
          // },
          hiddenInput: "full_number",
          // initialCountry: "auto",
          // localizedCountries: { 'de': 'Deutschland' },
          // nationalMode: false,
          // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
          // placeholderNumberType: "MOBILE",
          preferredCountries: ['es', 've'],
          // separateDialCode: true,
          utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.14/js/utils.js",
        });

        $(input).on("countrychange", function (event) {

                // Get the selected country data to know which country is selected.
                var selectedCountryData = iti.getSelectedCountryData();
                codeCountry = selectedCountryData.dialCode;
                // Get an example number for the selected country to use as placeholder.
                newPlaceholder = intlTelInputUtils.getExampleNumber(selectedCountryData.iso2, true, intlTelInputUtils.numberFormat.INTERNATIONAL),

                    // Reset the phone number input.
                    iti.setNumber("");

                // Convert placeholder as exploitable mask by replacing all 1-9 numbers with 0s
                var mask = newPlaceholder.replace(/[1-9]/g, "9");
                // Apply the new mask for the input
                $(input).inputmask(mask);
          });

          iti.promise.then(function () {
            $(input).trigger("countrychange");
          });
    }
  }
  document.addEventListener("DOMContentLoaded", callback);
})();
