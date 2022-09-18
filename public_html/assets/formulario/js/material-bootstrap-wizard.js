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

$(document).ready(function(){

    $.material.init();

    /*  Activate the tooltips      */
    $('[rel="tooltip"]').tooltip();

    // Code for the Validator
    var $validator = $('.wizard-card form').validate({
          
        rules: {
            nombre: {
                required: true,
                minlength: 3
            },
            apellido1: {
                required: true,
                minlength: 3
            },
            sexo: {
                required: true,
            },
            peso: {
                required: true,
            },
            altura: {
                required: true,
            },
            email: {
                required: true,
            },
            documento_identidad: {
                required: true,
            },
            no_documento_identidad: {
                required: true,
            },
            movil: {
                required: true,
            },
            direccion: {
                required: true,
            },
            numero: {
                required: true,
            },
            tipo_numero: {
                required: true,
            },
            municipio: {
                required: true,
            },
            file: {
                required: true,
            },
            asegurado_tomador: {
                required: true,
            },
            otra_direccion: {
                required: true,
            },
            metodo_pago: {
                required: true,
            },
            iban: {
                required: true,
            },
            promociones: {
                required: true,
            },
            terceros: {
                required: true,
            },
            automatizacion: {
                required: true,
            },
            enfermedad_accidente: {
                required: true,
            },
            hospitalizado: {
                required: true,
            },
            tratamiento_actual: {
                required: true,
            },
            sintoma_actual: {
                required: true,
            },
        },

        errorPlacement: function(error, element) {
            $(element).parent('div').addClass('has-error');
         }
    });

    // Wizard Initialization
    $('.wizard-card').bootstrapWizard({
        'tabClass': 'nav nav-pills',
        'nextSelector': '.btn-next',
        'previousSelector': '.btn-previous',

        onNext: function(tab, navigation, index) {
            var $total = navigation.find('li').length;
            var $current = index;            
            var $valid = $('.wizard-card form').valid();

            switch ($current) {
                case 1:
                    var $completed = insured_fields();

                    if (!$completed) {
                        Swal.fire({
                            title: 'Solicitud Incompleta',
                            text: 'Debes llenar la información de todos los asegurados y subir su documentación.',
                            icon: 'error',
                            iconColor: '#214285',
                            confirmButtonText: 'Ok',
                            confirmButtonColor: '#214285'
                        })

                        $valid = false;
                    }
                    break;
                case 2:
                    var $completed = health_questionnaire();

                    if (!$completed || !$valid) {
                        Swal.fire({
                            title: 'Solicitud Incompleta',
                            text: 'Debes responder el cuestionario de salud de todos los asegurados.',
                            icon: 'error',
                            iconColor: '#214285',
                            confirmButtonText: 'Ok',
                            confirmButtonColor: '#214285'
                        })

                        $valid = false;
                    }

                    break;
                case 3:
                    var titular = policyholder();

                    if (!titular) {
                        Swal.fire({
                            title: 'Solicitud Incompleta',
                            text: 'Debes indicar si titular asegurado es el tomador de la póliza.',
                            icon: 'error',
                            iconColor: '#214285',
                            confirmButtonText: 'Ok',
                            confirmButtonColor: '#214285'
                        })

                        $valid = false;

                        break;
                    }

                    var informacion = information_address();
                    if(!informacion){
                        Swal.fire({
                            title: 'Solicitud Incompleta',
                            text: 'Debes indicar si deseas recibir la información de alta en una dirección distina a la indicada anteriormente.',
                            icon: 'error',
                            iconColor: '#214285',
                            confirmButtonText: 'Ok',
                            confirmButtonColor: '#214285'
                        })

                        $valid = false;
                    }
                    break;
                case 4:
                    var datos = data_treatment();
                    if(!datos){
                        Swal.fire({
                            title: 'Solicitud Incompleta',
                            text: 'Debes responder todos los items.',
                            icon: 'error',
                            iconColor: '#214285',
                            confirmButtonText: 'Ok',
                            confirmButtonColor: '#214285'
                        })

                        $valid = false;
                    }
                    break;
                default:
                    break;
            }

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



var asegurados_adicionales = document.getElementById("cant_familiares").value;

function insured_fields(){
    var valid = true;

    if (asegurados_adicionales > 0) {

        var items = document.getElementsByClassName("asegurado");

        Array.prototype.forEach.call(items, function(item) {  
            if (item.value == "") {
                valid = false;
            }                
        });
    }
    return valid;
}

function health_questionnaire(){
    var valid = true;
    if (asegurados_adicionales > 0) {

        for (var i = 0; i < asegurados_adicionales; i++) {

            
            var enfermedad_accidente_si = document.getElementById("enfermedad_accidente_asegurado_"+i+"_si").checked;
            var enfermedad_accidente_no = document.getElementById("enfermedad_accidente_asegurado_"+i+"_no").checked;

            if (!enfermedad_accidente_si && !enfermedad_accidente_no) {
                valid = false;
                break;
            }

            var hospitalizado_si = document.getElementById("hospitalizado_asegurado_"+i+"_si").checked;
            var hospitalizado_no = document.getElementById("hospitalizado_asegurado_"+i+"_no").checked;


            if (!hospitalizado_si && !hospitalizado_no) {
                valid = false;
                break;
            }

            var tratamiento_actual_si = document.getElementById("tratamiento_actual_asegurado_"+i+"_si").checked;
            var tratamiento_actual_no = document.getElementById("tratamiento_actual_asegurado_"+i+"_no").checked;


            if (!tratamiento_actual_si && !tratamiento_actual_no) {
                valid = false;
                break;
            }

            var sintoma_actual_si = document.getElementById("sintoma_actual_asegurado_"+i+"_si").checked;
            var sintoma_actual_no = document.getElementById("sintoma_actual_asegurado_"+i+"_no").checked;


            if (!sintoma_actual_si && !sintoma_actual_no) {
                valid = false;
                break;
            }

        }

    }

    return valid;
}

function policyholder(){
    var valid = true;
      
    var asegurado_tomador_si = document.getElementById("asegurado_tomador_si").checked;
    var asegurado_tomador_no = document.getElementById("asegurado_tomador_no").checked;

    if (!asegurado_tomador_si && !asegurado_tomador_no) {
        valid = false;
    }

    return valid;
}

function information_address(){
    var valid = true;
      
    var otra_direccion_si = document.getElementById("otra_direccion_si").checked;
    var otra_direccion_no = document.getElementById("otra_direccion_no").checked;

    if (!otra_direccion_si && !otra_direccion_no) {
        valid = false;
    }

    return valid;
}

function data_treatment(){
    var valid = true;

    var promociones_si = document.getElementById("promociones_si").checked;
    var promociones_no = document.getElementById("promociones_no").checked;

    if (!promociones_si && !promociones_no) {
        valid = false;
    }

    var terceros_si = document.getElementById("terceros_si").checked;
    var terceros_no = document.getElementById("terceros_no").checked;

    if (!terceros_si && !terceros_no) {
        valid = false;
    }

    var automatizacion_si = document.getElementById("automatizacion_si").checked;
    var automatizacion_no = document.getElementById("automatizacion_no").checked;

    if (!automatizacion_si && !automatizacion_no) {
        valid = false;
    }

    return valid;
}