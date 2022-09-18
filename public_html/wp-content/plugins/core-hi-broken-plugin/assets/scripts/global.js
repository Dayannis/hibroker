/* 
* To change this license header, choose License Headers in Project Properties.
* To change this template file, choose Tools | Templates
* and open the template in the editor.
*/


HBAPI = {
  __callService__ : function (parameters, callback_success, callback_error){
    var data = parameters || {};
    var success = callback_success || function(data) {
      console.log(data);
    };
    var error = callback_error || function(errorThrown){
      console.log(errorThrown);
    };
        
    data.action = "hb_api";
    jQuery.ajax({
      url: "/wp-admin/admin-ajax.php",
      method: "post",
      data: data,
      success: function(data){
        var result = data;
        if (typeof (result) == "string")
          result = JSON.parse(data);
        success(result);
      },
      error: error
    });
  },
  test : function () {
    var parameters = {}
    parameters.endpoint = "test"
    var callback = function (data) { console.log(data); };
    HBAPI.__callService__(parameters, callback, callback);
  },
  getCountries : function (callback_success, callback_error) {
    var parameters = {}
    parameters.endpoint = "getCountries"
    HBAPI.__callService__(parameters, callback_success, callback_error);
  },
  getProvinces : function (input, callback_success, callback_error) {
    var parameters = HBUtils.secureObject(input) || {}
    parameters.endpoint = "getProvinces";
    HBAPI.__callService__(parameters, callback_success, callback_error);
  },
  fetchQuotes : function (input, callback_success, callback_error) {
    var parameters = HBUtils.secureObject(input) || {}
    parameters.endpoint = "fetchQuotes"
    HBAPI.__callService__(parameters, callback_success, callback_error);
  }
};

HBUtils = {
  secureObject: function(input){
    if (typeof(input) == "object"){
      return input
    } 
  },
  getFormData: function($form){
    var fields = $form.serializeArray();
    var obj = {};

    fields.forEach(n => {
      if (n['value'] != ""){
        const value = obj[n['name']]
        if (value == null){
          obj[n['name']] = n['value'];
        }else{
          if (!(typeof(value) == "object" && value.length > 0)){
            obj[n['name']] = []
            obj[n['name']].push(value)
          }
          obj[n['name']].push(n['value'])
        }
      }
    });
    return obj;
  },
  allowCharacter: function(e){
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
    especiales = "8-37-39-46";

    tecla_especial = false
    for (var i in especiales) {
      if (key == especiales[i]) {
        tecla_especial = true;
        break;
      }
    }

    if (letras.indexOf(tecla) == -1 && !tecla_especial) {
      return false;
    }
  }
}