/*!

 =========================================================
 * Material Bootstrap Wizard - v1.0.2
 =========================================================
 
 * Product Page: https://www.creative-tim.com/product/material-bootstrap-wizard
 * Copyright 2017 Creative Tim (http://www.creative-tim.com)
 * Licensed under MIT (https://github.com/creativetimofficial/material-bootstrap-wizard/blob/master/LICENSE.md)
 
 =========================================================
 
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 */

// Material Bootstrap Wizard Functions

var searchVisible = 0;
var transparent = true;
var mobile_device = false;


$(".siguiente").click(function(){
setTimeout("verificarProductos()",1)

});

function verificarProductos(){
     if ($(".producto").hasClass('error')){
        $("#errorProducto").show();
    }else{
         $("#errorProducto").hide();
    }
    //alert("funcion")
}



$(document).ready(function(){


    $.material.init();

    /*  Activate the tooltips      */
    $('[rel="tooltip"]').tooltip();

    jQuery.validator.addMethod("texto", function(value, element) {
      return this.optional(element) || /^[a-záéóóúàèìòùäëïöüñ\s]+$/i.test(value);
      }); 

        jQuery.validator.addMethod("texto_number", function(value, element) {
      return this.optional(element) || /^[0-9a-záéóóúàèìòùäëïöüñ\s]+$/i.test(value);
      }); 

    jQuery.validator.addMethod("int", function(value, element) {
      return this.optional(element) || /^[0-9]+$/i.test(value);
      }); 
    jQuery.validator.addMethod("edad", function(value, element) {
      return this.optional(element) || /^[0-9]+$/i.test(value);
      }); 

    // Code for the Validator
    var $validator = $('.wizard-card form').validate({
		  rules: {
            country_ventana_1:{
                required: true
            },
            provincia_ventana_1: {
                required: true,
                //minlength: 3,
                //texto_number:true
            },
            localidad_ventana_1: {
                required: true,
                //minlength: 3,
                //texto:true
            },
            nombre_ventana_1: {
                required: true,
                minlength: 3,
                texto:true
            },
            apellido_ventana_1: {
                required: true,
                minlength: 3,
                texto:true
            },
            edad_ventana_1: {
                required: true,
                minlength: 1,
                maxlength: 2,
                number: true,
                //MINIMO Y MAXIMO DE EDAD TITULAR
                min:25,
                max:70,
                edad: true
            },
            email_ventana_1: {
                required: true,
                minlength: 3,
                email: true
            },
            telefono_ventana_1: {
                required: true,
                minlength: 3,
                number: true,
            },
            cant_beneficiario_ventana_1: {
                required: true,
                minlength: 1,
                number: true,
                int: true,
                max:5
            },
            producto_ventana:{
                required: true,
            },
            /*DATOS DEL TITULAR VENTANA NUMERI 3*/
            country_titular_ventana_3:{
                required: true
            },
            provincia_titular_ventana_3:{
                required: true
                //minlength: 3,
                //texto_number:true
            },
            localidad_titular_ventana_3:{
                required: true
               // minlength: 3,
               // texto:true
            },
            nombre_titular_ventana_3:{
                required: true,
                minlength: 3,
                texto:true
            },
            apellido_titular_ventana_3:{
                required: true,
                minlength: 3,
                texto:true
            },
            edad_titular_ventana_3:{
                required: true,
                minlength: 1,
                maxlength: 2,
                number: true,
                 min:1,
                max:99,
                edad: true
            },
            tipo_doc_titular_ventana_3:{
                required: true,
            },
            documento_titular_ventana_3:{
                required: true,
                minlength: 3
               // number: true
            },
            sexo_titular_ventana_3:{
                required: true,
            },
            fecha_nacimiento_ventana_3:{
                required: true,
            },
            email_titular_ventana_3:{
                required: true,
                minlength: 3,
                email: true
            },
            telefono_titular_ventana_3:{
                required: true,
                minlength: 3,
                number: true
            },



            //BENEFICIARIOS DINAMICOS //LIMITE DE 5 HASTA LOS MOMENTOS
            edad_beneficiario_1:{
                required: true,
                minlength: 1,
                maxlength: 2,
                number: true,
                 min:1,
                max:99,
                edad: true
            },
             parentesco_beneficiario_1:{
                required: true
               
            },
            country_beneficiario_1:{
                required: true
            },
            localidad_beneficiario_1:{
               required: true
               // minlength: 3,
               // texto_number:true
            },
            provincia_beneficiario_1:{
               required: true
               // minlength: 3,
               // texto_number:true
            },
            edad_beneficiario_2:{
                required: true,
                minlength: 1,
                maxlength: 2,
                number: true,
                 min:1,
                max:99,
                edad: true
            }, 
            parentesco_beneficiario_2:{
                required: true
               
            },
            country_beneficiario_2:{
                required: true
            },
            localidad_beneficiario_2:{
               required: true
                //minlength: 3,
                //texto_number:true
            },
            provincia_beneficiario_2:{
               required: true
               // minlength: 3,
               // texto_number:true
            },
            edad_beneficiario_3:{
                required: true,
                minlength: 1,
                maxlength: 2,
                number: true,
                 min:1,
                max:99,
                edad: true
            },
             parentesco_beneficiario_3:{
                required: true
               
            },
            country_beneficiario_3:{
                required: true
            },
            localidad_beneficiario_3:{
               required: true
               // minlength: 3,
               // texto_number:true
            },
            provincia_beneficiario_3:{
               required: true
               // minlength: 3,
               // texto_number:true
            },
            edad_beneficiario_4:{
                required: true,
                minlength: 1,
                maxlength: 2,
                number: true,
                 min:1,
                max:99,
                edad: true
            },
             parentesco_beneficiario_4:{
                required: true
               
            },
            country_beneficiario_4:{
                required: true
            },
            localidad_beneficiario_4:{
               required: true
               // minlength: 3,
               // texto_number:true
            },
            provincia_beneficiario_4:{
               required: true
               // minlength: 3,
               // texto_number:true
            },
            edad_beneficiario_5:{
                required: true,
                minlength: 1,
                maxlength: 2,
                number: true,
                 min:1,
                max:99,
                edad: true
            },
             parentesco_beneficiario_5:{
                required: true
               
            },
            country_beneficiario_5:{
                required: true
            },
            localidad_beneficiario_5:{
               required: true
              //  minlength: 3,
              //  texto_number:true
            },
            provincia_beneficiario_5:{
               required: true
               // minlength: 3,
               // texto_number:true
            },
            numero_cuenta:{
                number: true
            },
            num_tarjeta:{
                number: true
            },
            mm_yy_tarjeta:{
                number: true
            },
            cvv_tarjeta:{
                number: true
            },
             //VENTANA NUMERO 4 BENEFICIARIOS LIMITE 5 HASTA LOS MOMENTOS
             //BENFICIARIO 1
                country_beneficiario_ventana_4_1:{
                     required: true
                },
                provincia_beneficiario_ventana_4_1:{
                     required: true
                 //   minlength: 3,
                 //  texto_number:true
                },
                localidad_beneficiario_ventana_4_1:{
                    required: true
                    //minlength: 3,
                    //texto_number:true
                },
                nombre_beneficiario_ventana_4_1:{
                    required: true,
                    minlength: 3,
                    texto:true
                },
                apellido_beneficiario_ventana_4_1:{
                    required: true,
                    minlength: 3,
                    texto:true
                },
                edad_beneficiario_ventana_4_1:{
                    required: true,
                    minlength: 1,
                    maxlength: 2,
                    number: true,
                     min:1,
                    max:99,
                    edad: true
                },
                 parentesco_beneficiario_ventana_4_1:{
                required: true
               
                },
                fecha_nac_beneficiario_ventana_4_1:{
                required: true
               
                },
                tipo_doc_beneficiario_ventana_4_1:{
                    required: true
                },
                documento_beneficiario_ventana_4_1:{
                     required: true,
                    minlength: 3
                    //number: true
                },
                sexo_beneficiario_ventana_4_1:{
                    required: true
                },
                //BENFICIARIO 2
                country_beneficiario_ventana_4_2:{
                     required: true
                },
                provincia_beneficiario_ventana_4_2:{
                     required: true
                    //minlength: 3,
                    //texto_number:true
                },
                localidad_beneficiario_ventana_4_2:{
                    required: true
                   // minlength: 3,
                   // texto_number:true
                },
                nombre_beneficiario_ventana_4_2:{
                    required: true,
                    minlength: 3,
                    texto:true
                },
                apellido_beneficiario_ventana_4_2:{
                    required: true,
                    minlength: 3,
                    texto:true
                },
                edad_beneficiario_ventana_4_2:{
                    required: true,
                    minlength: 1,
                    maxlength: 2,
                    number: true,
                     min:1,
                max:99,
                    edad: true
                }, parentesco_beneficiario_ventana_4_2:{
                required: true
               
                },

                fecha_nac_beneficiario_ventana_4_2:{
                required: true
               
                },
                tipo_doc_beneficiario_ventana_4_2:{
                    required: true
                },
                documento_beneficiario_ventana_4_2:{
                     required: true,
                    minlength: 3
                   // number: true
                },
                sexo_beneficiario_ventana_4_2:{
                    required: true
                },

                 //BENFICIARIO 3
                country_beneficiario_ventana_4_3:{
                     required: true
                },
                provincia_beneficiario_ventana_4_3:{
                     required: true
                   // minlength: 3,
                  // texto_number:true
                },
                localidad_beneficiario_ventana_4_3:{
                    required: true
                    //minlength: 3,
                    //texto_number:true
                },
                nombre_beneficiario_ventana_4_3:{
                    required: true,
                    minlength: 3,
                    texto:true
                },
                apellido_beneficiario_ventana_4_3:{
                    required: true,
                    minlength: 3,
                    texto:true
                },
                edad_beneficiario_ventana_4_3:{
                    required: true,
                    minlength: 1,
                    maxlength: 2,
                    number: true,
                     min:1,
                max:99,
                    edad: true
                }, 
                parentesco_beneficiario_ventana_4_3:{
                required: true
               
                },

                fecha_nac_beneficiario_ventana_4_3:{
                required: true
               
                },
                tipo_doc_beneficiario_ventana_4_3:{
                    required: true
                },
                documento_beneficiario_ventana_4_3:{
                     required: true,
                    minlength: 3
                    //number: true
                },
                sexo_beneficiario_ventana_4_3:{
                    required: true
                },

                      //BENFICIARIO 4
                country_beneficiario_ventana_4_4:{
                     required: true
                },
                provincia_beneficiario_ventana_4_4:{
                     required: true
                  //  minlength: 3,
                  //  texto_number:true
                },
                localidad_beneficiario_ventana_4_4:{
                    required: true
                    //minlength: 3,
                    //texto_number:true
                },
                nombre_beneficiario_ventana_4_4:{
                    required: true,
                    minlength: 3,
                    texto:true
                },
                apellido_beneficiario_ventana_4_4:{
                    required: true,
                    minlength: 3,
                    texto:true
                },
                edad_beneficiario_ventana_4_4:{
                    required: true,
                    minlength: 1,
                    maxlength: 2,
                    number: true,
                     min:1,
                max:99,
                    edad: true
                }, 
                parentesco_beneficiario_ventana_4_4:{
                required: true
               
                },

                fecha_nac_beneficiario_ventana_4_4:{
                required: true
               
                },
                tipo_doc_beneficiario_ventana_4_4:{
                    required: true
                },
                documento_beneficiario_ventana_4_4:{
                     required: true,
                    minlength: 3
                    //number: true
                },
                sexo_beneficiario_ventana_4_4:{
                    required: true
                },

                       //BENFICIARIO 5
                country_beneficiario_ventana_4_5:{
                     required: true
                },
                provincia_beneficiario_ventana_4_5:{
                     required: true
                   // minlength: 3,
                   //texto_number:true
                },
                localidad_beneficiario_ventana_4_5:{
                    required: true
                   // minlength: 3,
                   // texto_number:true
                },
                nombre_beneficiario_ventana_4_5:{
                    required: true,
                    minlength: 3,
                    texto:true
                },
                apellido_beneficiario_ventana_4_5:{
                    required: true,
                    minlength: 3,
                    texto:true
                },
                edad_beneficiario_ventana_4_5:{
                    required: true,
                    minlength: 1,
                    maxlength: 2,
                    number: true,
                     min:1,
                max:99,
                    edad: true
                },
                 parentesco_beneficiario_ventana_4_5:{
                required: true
               
                },

                fecha_nac_beneficiario_ventana_4_5:{
                required: true
               
                },
                tipo_doc_beneficiario_ventana_4_5:{
                    required: true
                },
                documento_beneficiario_ventana_4_5:{
                     required: true,
                    minlength: 3
                    //number: true
                },
                sexo_beneficiario_ventana_4_5:{
                    required: true
                }

        },
        messages: {
             country_ventana_1: {
                required: 'Por favor seleccione un pais'
             },
             provincia_ventana_1:{   
                required: 'Por favor seleccione una provincia',
                //minlength: 'La provincia debe tener por lo menos 3 caracteres',
                //texto_number: "Por favor solo ingresa caracteres permitidos para una provincia"
             },
             localidad_ventana_1:{   
                required: 'Por favor seleccione una localidad',
                //minlength: 'La localidad debe tener por lo menos 3 caracteres',
                // texto: "Por favor solo ingresa caracteres permitidos para una localidad"
             },
             nombre_ventana_1:{   
                required: 'Por favor escriba su nombre',
                minlength: 'Su nombre debe tener por lo menos 3 caracteres',
                 texto: "Por favor solo ingresa caracteres permitidos para un nombre"
             
             },
             apellido_ventana_1:{   
                required: 'Por favor escriba su apellido',
                minlength: 'Su apellido debe tener por lo menos 3 caracteres',
                texto: "Por favor solo ingresa caracteres permitidos para un apellido"
             },
             edad_ventana_1: {  
                required: 'Por favor escriba su edad',
                minlength: 'Su edad debe tener por lo menos de 1 numero',
                maxlength: 'Su edad no debe tener mas de 2 caracteres',
                number: 'Su edad debe ser numerica',
                 //MINIMO Y MAXIMO DE EDAD TITULAR
                min: 'La edad no puede ser menor a 25',
                max:'La edad no puede ser mayor de 70 años',
                edad: 'La edad debe ser un numero entero'
             },
             email_ventana_1: {  
                required: 'Por favor escriba su email',
                minlength: 'Su email debe tener por lo menos 3 caracteres',
                email: 'Su email debe tener formato de correo electronico'
             },
             telefono_ventana_1:{   
                required: 'Por favor escriba su telefono',
                minlength: 'Su telefono debe tener por lo menos 3 caracteres',
                number: 'Su telefono debe ser numerico'
             },
             cant_beneficiario_ventana_1: {
                required: 'Por favor escriba la cantidad de beneficiarios',
                minlength: 'Los beneficiarios deben ser mayor o igual a 0',
                number: 'La cantidad de beneficiarios debe ser numerica',
                int: 'La cantidad debe ser un numero entero',
                max: 'La cantidad maxima de beneficiarios permitidos es de 5'
            },

            producto_ventana:{
                required: 'Debe seleccionar un producto',
            },

             /*DATOS DEL TITULAR VENTANA NUMERI 3*/
            country_titular_ventana_3:{
                  required: 'Por favor seleccione un pais'
            },
            provincia_titular_ventana_3:{
               required: 'Por favor escriba una provincia'
               // minlength: 'La provincia debe tener por lo menos 3 caracteres',
                //texto_number: "Por favor solo ingresa caracteres permitidos para una provincia"
            },
            localidad_titular_ventana_3:{
               required: 'Por favor escriba una localidad'
               // minlength: 'La localidad debe tener por lo menos 3 caracteres',
               //  texto: "Por favor solo ingresa caracteres permitidos para una localidad"
            },
            nombre_titular_ventana_3:{
                required: 'Por favor escriba su nombre',
                minlength: 'Su nombre debe tener por lo menos 3 caracteres',
                 texto: "Por favor solo ingresa caracteres permitidos para un nombre"
            },
            apellido_titular_ventana_3:{
                required: 'Por favor escriba su apellido',
                minlength: 'Su apellido debe tener por lo menos 3 caracteres',
                texto: "Por favor solo ingresa caracteres permitidos para un apellido"
            },
            edad_titular_ventana_3:{
               required: 'Por favor escriba su edad',
                minlength: 'Su edad debe tener por lo menos de 1 numero',
                maxlength: 'Su edad no debe tener mas de 2 caracteres',
                number: 'Su edad debe ser numerica',
                 min: 'La edad no puede ser menor o igual a 0',
                max:'La edad no puede ser mayor de 99 años',
                edad: 'La edad debe ser un numero entero'
            },
            tipo_doc_titular_ventana_3:{
               required: 'Por favor seleccione su tipo de doc'
            },
            documento_titular_ventana_3:{
            
                required: 'Por favor escriba su numero de doc',
                minlength: 'Su documento debe tener por lo menos de 1 numero'
               // number: 'Su documento debe ser numerico'
                
            },
            sexo_titular_ventana_3:{
               required: 'Debe seleccionar su sexo'
            },
            fecha_nacimiento_ventana_3:{
               required: 'Debe completar su fecha de nacimiento'
            },
            email_titular_ventana_3:{
                required: 'Por favor escriba su email',
                minlength: 'Su email debe tener por lo menos 3 caracteres',
                email: 'Su email debe tener formato de correo electronico'
            },
            telefono_titular_ventana_3:{
                 required: 'Por favor escriba su telefono',
                minlength: 'Su telefono debe tener por lo menos 3 caracteres',
                 number: 'Su telefono debe ser numerico'
            },

            //BENEFICIARIOS DINAMICOS //LIMITE DE 5 HASTA LOS MOMENTOS

            edad_beneficiario_1:{
                  required: 'Este campo del beneficiario es requerido', 
                   minlength: 'La edad debe tener por lo menos de 1 numero',
                   maxlength: 'La edad debe tener mas de 2 caracteres',
                   number: 'La edad debe ser numerica',
                    min: 'La edad no puede ser menor o igual a 0',
                max:'La edad no puede ser mayor de 99 años',
                   edad: 'La edad debe ser un numero entero'
            },
            country_beneficiario_1:{
                  required: 'Este campo del beneficiario es requerido'
            },
            localidad_beneficiario_1:{
                 required: 'Este campo del beneficiario es requerido'
                // minlength: 'La localidad debe tener por lo menos 3 caracteres',
               // texto_number: "Por favor solo ingresa caracteres permitidos para una provincia"
            },
            provincia_beneficiario_1:{
                 required: 'Este campo del beneficiario es requerido'
                // minlength: 'La localidad debe tener por lo menos 3 caracteres',
               // texto_number: "Por favor solo ingresa caracteres permitidos para una provincia"
            },
             edad_beneficiario_2:{
                  required: 'Este campo del beneficiario es requerido', 
                   minlength: 'La edad debe tener por lo menos de 1 numero',
                   maxlength: 'La edad debe tener mas de 2 caracteres',
                   number: 'La edad debe ser numerica',
                    min: 'La edad no puede ser menor o igual a 0',
                max:'La edad no puede ser mayor de 99 años',
                   edad: 'La edad debe ser un numero entero'
            },
            country_beneficiario_2:{
                  required: 'Este campo del beneficiario es requerido'
            },
            localidad_beneficiario_2:{
                 required: 'Este campo del beneficiario es requerido'
                 //minlength: 'La localidad debe tener por lo menos 3 caracteres',
               // texto_number: "Por favor solo ingresa caracteres permitidos para una provincia"
            },
            provincia_beneficiario_2:{
                 required: 'Este campo del beneficiario es requerido'
                // minlength: 'La localidad debe tener por lo menos 3 caracteres',
               // texto_number: "Por favor solo ingresa caracteres permitidos para una provincia"
            },
             edad_beneficiario_3:{
                  required: 'Este campo del beneficiario es requerido', 
                   minlength: 'La edad debe tener por lo menos de 1 numero',
                   maxlength: 'La edad debe tener mas de 2 caracteres',
                   number: 'La edad debe ser numerica',
                    min: 'La edad no puede ser menor o igual a 0',
                max:'La edad no puede ser mayor de 99 años',
                   edad: 'La edad debe ser un numero entero'
            },
            country_beneficiario_3:{
                  required: 'Este campo del beneficiario es requerido'
            },
            localidad_beneficiario_3:{
                 required: 'Este campo del beneficiario es requerido'
               //  minlength: 'La localidad debe tener por lo menos 3 caracteres',
               // texto_number: "Por favor solo ingresa caracteres permitidos para una provincia"
            },

            provincia_beneficiario_3:{
                 required: 'Este campo del beneficiario es requerido'
                // minlength: 'La localidad debe tener por lo menos 3 caracteres',
               // texto_number: "Por favor solo ingresa caracteres permitidos para una provincia"
            },
             edad_beneficiario_4:{
                  required: 'Este campo del beneficiario es requerido', 
                   minlength: 'La edad debe tener por lo menos de 1 numero',
                   maxlength: 'La edad debe tener mas de 2 caracteres',
                   number: 'La edad debe ser numerica',
                    min: 'La edad no puede ser menor o igual a 0',
                max:'La edad no puede ser mayor de 99 años',
                   edad: 'La edad debe ser un numero entero'
            },
            country_beneficiario_4:{
                  required: 'Este campo del beneficiario es requerido'
            },
            localidad_beneficiario_4:{
                 required: 'Este campo del beneficiario es requerido'
                // minlength: 'La localidad debe tener por lo menos 3 caracteres',
               // texto_number: "Por favor solo ingresa caracteres permitidos para una provincia"
            },
            provincia_beneficiario_4:{
                 required: 'Este campo del beneficiario es requerido'
                // minlength: 'La localidad debe tener por lo menos 3 caracteres',
               // texto_number: "Por favor solo ingresa caracteres permitidos para una provincia"
            },
             edad_beneficiario_5:{
                  required: 'Este campo del beneficiario es requerido', 
                   minlength: 'La edad debe tener por lo menos de 1 numero',
                   maxlength: 'La edad debe tener mas de 2 caracteres',
                   number: 'La edad debe ser numerica',
                    min: 'La edad no puede ser menor o igual a 0',
                max:'La edad no puede ser mayor de 99 años',
                   edad: 'La edad debe ser un numero entero'
            },
            country_beneficiario_5:{
                  required: 'Este campo del beneficiario es requerido'
            },
            localidad_beneficiario_5:{
                 required: 'Este campo del beneficiario es requerido'
                // minlength: 'La localidad debe tener por lo menos 3 caracteres',
               // texto_number: "Por favor solo ingresa caracteres permitidos para una provincia"
            },

            provincia_beneficiario_5:{
                 required: 'Este campo del beneficiario es requerido'
                // minlength: 'La localidad debe tener por lo menos 3 caracteres',
               // texto_number: "Por favor solo ingresa caracteres permitidos para una provincia"
            },

             numero_cuenta:{
                number: "Solo numeros"
            },
            num_tarjeta:{
                number: "Solo numeros"
            },
            mm_yy_tarjeta:{
                number: "Solo numeros"
            },
            cvv_tarjeta:{
                number: "Solo numeros"
            },
            //VENTANA NUMERO 4 BENEFICIARIOS LIMITE 5 HASTA LOS MOMENTOS
           // BENEFICIARIO NUMERO 1
                country_beneficiario_ventana_4_1:{
                       required: 'Este campo del beneficiario es requerido'
                },
                provincia_beneficiario_ventana_4_1:{
                     required: 'Este campo del beneficiario es requerido'
                    // minlength: 'La provincia debe tener por lo menos 3 caracteres',
                    // texto_number: "Por favor solo ingresa caracteres permitidos para una provincia"
                },
                localidad_beneficiario_ventana_4_1:{
                  required: 'Este campo del beneficiario es requerido'
                    // minlength: 'La provincia debe tener por lo menos 3 caracteres',
                    // texto_number: "Por favor solo ingresa caracteres permitidos para una localidad"
                },
                nombre_beneficiario_ventana_4_1:{
                     required: 'Por favor escriba su nombre',
                     minlength: 'Su nombre debe tener por lo menos 3 caracteres',
                    texto: "Por favor solo ingresa caracteres permitidos para un nombre"
                },
                apellido_beneficiario_ventana_4_1:{
                  required: 'Por favor escriba su apellido',
                  minlength: 'Su apellido debe tener por lo menos 3 caracteres',
                  texto: "Por favor solo ingresa caracteres permitidos para un apellido"
                },
                edad_beneficiario_ventana_4_1:{
                   required: 'Este campo del beneficiario es requerido', 
                   minlength: 'La edad debe tener por lo menos de 1 numero',
                   maxlength: 'La edad debe tener mas de 2 caracteres',
                   number: 'La edad debe ser numerica',
                    min: 'La edad no puede ser menor o igual a 0',
                max:'La edad no puede ser mayor de 99 años',
                   edad: 'La edad debe ser un numero entero'
                },
                tipo_doc_beneficiario_ventana_4_1:{
                   required: 'Este campo del beneficiario es requerido'
                },
                documento_beneficiario_ventana_4_1:{
                    required: 'Por favor escriba su numero de doc',
                minlength: 'Su documento debe tener por lo menos de 1 numero'
               // number: 'Su documento debe ser numerico'
                },

                sexo_beneficiario_ventana_4_1:{
                     required: 'Este campo del beneficiario es requerido'
                },


                //BENEFICIARIO NUMERO 2
                country_beneficiario_ventana_4_2:{
                       required: 'Este campo del beneficiario es requerido'
                },
                provincia_beneficiario_ventana_4_2:{
                     required: 'Este campo del beneficiario es requerido'
                    // minlength: 'La provincia debe tener por lo menos 3 caracteres',
                    // texto_number: "Por favor solo ingresa caracteres permitidos para una provincia"
                },
                localidad_beneficiario_ventana_4_2:{
                  required: 'Este campo del beneficiario es requerido'
                    // minlength: 'La provincia debe tener por lo menos 3 caracteres',
                    // texto_number: "Por favor solo ingresa caracteres permitidos para una localidad"
                },
                nombre_beneficiario_ventana_4_2:{
                     required: 'Por favor escriba su nombre',
                     minlength: 'Su nombre debe tener por lo menos 3 caracteres',
                    texto: "Por favor solo ingresa caracteres permitidos para un nombre"
                },
                apellido_beneficiario_ventana_4_2:{
                  required: 'Por favor escriba su apellido',
                  minlength: 'Su apellido debe tener por lo menos 3 caracteres',
                  texto: "Por favor solo ingresa caracteres permitidos para un apellido"
                },
                edad_beneficiario_ventana_4_2:{
                   required: 'Este campo del beneficiario es requerido', 
                   minlength: 'La edad debe tener por lo menos de 1 numero',
                   maxlength: 'La edad debe tener mas de 2 caracteres',
                   number: 'La edad debe ser numerica',
                    min: 'La edad no puede ser menor o igual a 0',
                max:'La edad no puede ser mayor de 99 años',
                   edad: 'La edad debe ser un numero entero'
                },
                tipo_doc_beneficiario_ventana_4_2:{
                   required: 'Este campo del beneficiario es requerido'
                },
                documento_beneficiario_ventana_4_2:{
                    required: 'Por favor escriba su numero de doc',
                minlength: 'Su documento debe tener por lo menos de 1 numero'
              //  number: 'Su documento debe ser numerico'
                },
                sexo_beneficiario_ventana_4_2:{
                     required: 'Este campo del beneficiario es requerido'
                },

                //BENEFICIARIO NUMERO 3
                 country_beneficiario_ventana_4_3:{
                       required: 'Este campo del beneficiario es requerido'
                },
                provincia_beneficiario_ventana_4_3:{
                     required: 'Este campo del beneficiario es requerido'
                    // minlength: 'La provincia debe tener por lo menos 3 caracteres',
                    // texto_number: "Por favor solo ingresa caracteres permitidos para una provincia"
                },
                localidad_beneficiario_ventana_4_3:{
                  required: 'Este campo del beneficiario es requerido'
                    // minlength: 'La provincia debe tener por lo menos 3 caracteres',
                    // texto_number: "Por favor solo ingresa caracteres permitidos para una localidad"
                },
                nombre_beneficiario_ventana_4_3:{
                     required: 'Por favor escriba su nombre',
                     minlength: 'Su nombre debe tener por lo menos 3 caracteres',
                    texto: "Por favor solo ingresa caracteres permitidos para un nombre"
                },
                apellido_beneficiario_ventana_4_3:{
                  required: 'Por favor escriba su apellido',
                  minlength: 'Su apellido debe tener por lo menos 3 caracteres',
                  texto: "Por favor solo ingresa caracteres permitidos para un apellido"
                },
                edad_beneficiario_ventana_4_3:{
                   required: 'Este campo del beneficiario es requerido', 
                   minlength: 'La edad debe tener por lo menos de 1 numero',
                   maxlength: 'La edad debe tener mas de 2 caracteres',
                   number: 'La edad debe ser numerica',
                    min: 'La edad no puede ser menor o igual a 0',
                max:'La edad no puede ser mayor de 99 años',
                   edad: 'La edad debe ser un numero entero'
                },
                tipo_doc_beneficiario_ventana_4_3:{
                   required: 'Este campo del beneficiario es requerido'
                },
                documento_beneficiario_ventana_4_3:{
                    required: 'Por favor escriba su numero de doc',
                minlength: 'Su documento debe tener por lo menos de 1 numero'
                //number: 'Su documento debe ser numerico'
                },
                sexo_beneficiario_ventana_4_3:{
                     required: 'Este campo del beneficiario es requerido'
                },

                 //BENEFICIARIO NUMERO 4
                 country_beneficiario_ventana_4_4:{
                       required: 'Este campo del beneficiario es requerido'
                },
                provincia_beneficiario_ventana_4_4:{
                     required: 'Este campo del beneficiario es requerido'
                   //  minlength: 'La provincia debe tener por lo menos 3 caracteres',
                   //  texto_number: "Por favor solo ingresa caracteres permitidos para una provincia"
                },
                localidad_beneficiario_ventana_4_4:{
                  required: 'Este campo del beneficiario es requerido'
                    // minlength: 'La provincia debe tener por lo menos 3 caracteres',
                    // texto_number: "Por favor solo ingresa caracteres permitidos para una localidad"
                },
                nombre_beneficiario_ventana_4_4:{
                     required: 'Por favor escriba su nombre',
                     minlength: 'Su nombre debe tener por lo menos 3 caracteres',
                    texto: "Por favor solo ingresa caracteres permitidos para un nombre"
                },
                apellido_beneficiario_ventana_4_4:{
                  required: 'Por favor escriba su apellido',
                  minlength: 'Su apellido debe tener por lo menos 3 caracteres',
                  texto: "Por favor solo ingresa caracteres permitidos para un apellido"
                },
                edad_beneficiario_ventana_4_4:{
                   required: 'Este campo del beneficiario es requerido', 
                   minlength: 'La edad debe tener por lo menos de 1 numero',
                   maxlength: 'La edad debe tener mas de 2 caracteres',
                   number: 'La edad debe ser numerica',
                    min: 'La edad no puede ser menor o igual a 0',
                max:'La edad no puede ser mayor de 99 años',
                   edad: 'La edad debe ser un numero entero'
                },
                tipo_doc_beneficiario_ventana_4_4:{
                   required: 'Este campo del beneficiario es requerido'
                },
                documento_beneficiario_ventana_4_4:{
                    required: 'Por favor escriba su numero de doc',
                minlength: 'Su documento debe tener por lo menos de 1 numero'
               // number: 'Su documento debe ser numerico'
                },
                sexo_beneficiario_ventana_4_4:{
                     required: 'Este campo del beneficiario es requerido'
                },

                 //BENEFICIARIO NUMERO 5

                 country_beneficiario_ventana_4_5:{
                       required: 'Este campo del beneficiario es requerido'
                },
                provincia_beneficiario_ventana_4_5:{
                     required: 'Este campo del beneficiario es requerido'
                   //  minlength: 'La provincia debe tener por lo menos 3 caracteres',
                   //  texto_number: "Por favor solo ingresa caracteres permitidos para una provincia"
                },
                localidad_beneficiario_ventana_4_5:{
                  required: 'Este campo del beneficiario es requerido'
                     //minlength: 'La provincia debe tener por lo menos 3 caracteres',
                    // texto_number: "Por favor solo ingresa caracteres permitidos para una localidad"
                },
                nombre_beneficiario_ventana_4_5:{
                     required: 'Por favor escriba su nombre',
                     minlength: 'Su nombre debe tener por lo menos 3 caracteres',
                    texto: "Por favor solo ingresa caracteres permitidos para un nombre"
                },
                apellido_beneficiario_ventana_4_5:{
                  required: 'Por favor escriba su apellido',
                  minlength: 'Su apellido debe tener por lo menos 3 caracteres',
                  texto: "Por favor solo ingresa caracteres permitidos para un apellido"
                },
                edad_beneficiario_ventana_4_5:{
                   required: 'Este campo del beneficiario es requerido', 
                   minlength: 'La edad debe tener por lo menos de 1 numero',
                   maxlength: 'La edad debe tener mas de 2 caracteres',
                   number: 'La edad debe ser numerica',
                    min: 'La edad no puede ser menor o igual a 0',
                max:'La edad no puede ser mayor de 99 años',
                   edad: 'La edad debe ser un numero entero'
                },
                tipo_doc_beneficiario_ventana_4_5:{
                   required: 'Este campo del beneficiario es requerido'
                },
                documento_beneficiario_ventana_4_5:{
                    required: 'Por favor escriba su numero de doc',
                minlength: 'Su documento debe tener por lo menos de 1 numero'
               // number: 'Su documento debe ser numerico'
                },
                sexo_beneficiario_ventana_4_5:{
                     required: 'Este campo del beneficiario es requerido'
                }
             
        },

        errorPlacement: function(error, element) {
          $(element).parent('div').addClass('has-error');
          error.appendTo(element.parent().find("span"));
            
         }
	});

    // Wizard Initialization
  	$('.wizard-card').bootstrapWizard({
        'tabClass': 'nav nav-pills',
        'nextSelector': '.btn-next',
        'previousSelector': '.btn-previous',

        onNext: function(tab, navigation, index) {
        	var $valid = $('.wizard-card form').valid();
        	if(!$valid) {
        		$validator.focusInvalid();
        		return false;
        	}
        },

        onInit : function(tab, navigation, index){
            //check number of tabs and fill the entire row
            var $total = navigation.find('li').length;
            var $wizard = navigation.closest('.wizard-card');

            $first_li = navigation.find('li:first-child a').html();
            $moving_div = $('<div class="moving-tab">' + $first_li + '</div>');
            $('.wizard-card .wizard-navigation').append($moving_div);

            refreshAnimation($wizard, index);

            $('.moving-tab').css('transition','transform 0s');
       },

        onTabClick : function(tab, navigation, index){
            var $valid = $('.wizard-card form').valid();

            if(!$valid){
                return false;
            } else{
                return true;
            }
        },

        onTabShow: function(tab, navigation, index) {
            var $total = navigation.find('li').length;
            var $current = index+1;

            var $wizard = navigation.closest('.wizard-card');

            // If it's the last tab then hide the last button and show the finish instead
            if($current >= $total) {
                $($wizard).find('.btn-next').hide();
                $($wizard).find('.btn-finish').show();
            } else {
                $($wizard).find('.btn-next').show();
                $($wizard).find('.btn-finish').hide();
            }

            button_text = navigation.find('li:nth-child(' + $current + ') a').html();

            setTimeout(function(){
                $('.moving-tab').text(button_text);
            }, 150);

            var checkbox = $('.footer-checkbox');

            if( !index == 0 ){
                $(checkbox).css({
                    'opacity':'0',
                    'visibility':'hidden',
                    'position':'absolute'
                });
            } else {
                $(checkbox).css({
                    'opacity':'1',
                    'visibility':'visible'
                });
            }

            refreshAnimation($wizard, index);
        }
  	});


    // Prepare the preview for profile picture
    $("#wizard-picture").change(function(){
        readURL(this);
    });

    $('[data-toggle="wizard-radio"]').click(function(){
        wizard = $(this).closest('.wizard-card');
        wizard.find('[data-toggle="wizard-radio"]').removeClass('active');
        $(this).addClass('active');
        $(wizard).find('[type="radio"]').removeAttr('checked');
        $(this).find('[type="radio"]').attr('checked','true');
    });

    $('[data-toggle="wizard-checkbox"]').click(function(){
        if( $(this).hasClass('active')){
            $(this).removeClass('active');
            $(this).find('[type="checkbox"]').removeAttr('checked');
        } else {
            $(this).addClass('active');
            $(this).find('[type="checkbox"]').attr('checked','true');
        }
    });

    $('.set-full-height').css('height', 'auto');

});



 //Function to show image before upload

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$(window).resize(function(){
    $('.wizard-card').each(function(){
        $wizard = $(this);

        index = $wizard.bootstrapWizard('currentIndex');
        refreshAnimation($wizard, index);

        $('.moving-tab').css({
            'transition': 'transform 0s'
        });
    });
});

function refreshAnimation($wizard, index){
    $total = $wizard.find('.nav li').length;
    $li_width = 100/$total;

    total_steps = $wizard.find('.nav li').length;
    move_distance = $wizard.width() / total_steps;
    index_temp = index;
    vertical_level = 0;

    mobile_device = $(document).width() < 600 && $total > 3;

    if(mobile_device){
        move_distance = $wizard.width() / 2;
        index_temp = index % 2;
        $li_width = 50;
    }

    $wizard.find('.nav li').css('width',$li_width + '%');

    step_width = move_distance;
    move_distance = move_distance * index_temp;

    $current = index + 1;

    if($current == 1 || (mobile_device == true && (index % 2 == 0) )){
        move_distance -= 8;
    } else if($current == total_steps || (mobile_device == true && (index % 2 == 1))){
        move_distance += 8;
    }

    if(mobile_device){
        vertical_level = parseInt(index / 2);
        vertical_level = vertical_level * 38;
    }

    $wizard.find('.moving-tab').css('width', step_width);
    $('.moving-tab').css({
        'transform':'translate3d(' + move_distance + 'px, ' + vertical_level +  'px, 0)',
        'transition': 'all 0.5s cubic-bezier(0.29, 1.42, 0.79, 1)'

    });
}

materialDesign = {

    checkScrollForTransparentNavbar: debounce(function() {
                if($(document).scrollTop() > 260 ) {
                    if(transparent) {
                        transparent = false;
                        $('.navbar-color-on-scroll').removeClass('navbar-transparent');
                    }
                } else {
                    if( !transparent ) {
                        transparent = true;
                        $('.navbar-color-on-scroll').addClass('navbar-transparent');
                    }
                }
        }, 17)

}

function debounce(func, wait, immediate) {
	var timeout;
	return function() {
		var context = this, args = arguments;
		clearTimeout(timeout);
		timeout = setTimeout(function() {
			timeout = null;
			if (!immediate) func.apply(context, args);
		}, wait);
		if (immediate && !timeout) func.apply(context, args);
	};
};
