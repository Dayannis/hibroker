function tratamientoDatos(radio) {
    var mostrar = radio.getAttribute("data-value");
    var input = radio.getAttribute("data-input");
    var other = radio.getAttribute("data-other");
    var texto_mostrar = radio.getAttribute("data-div");

    radio.classList.add("active");    
    document.getElementById(other).classList.remove("active");

    if (mostrar === "Si") {
          document.getElementById(input+"_si").checked = true;
          document.getElementById(input+"_no").checked = false;

    } else {
          document.getElementById(input+"_si").checked = false;
          document.getElementById(input+"_no").checked = true;  
    }
}

function paymentMethod(select){
  if (select.value == "Cuenta") {
    document.getElementById("div_datos_bancarios").style.display = "block";
  }
  else{
    document.getElementById("div_datos_bancarios").style.display = "none";
  }
}

function codigoPostal(select){
  var input = select.getAttribute("data-input");
  if (select.value == "1") {
    document.getElementById(input).required = true; 
  }
  else{
    document.getElementById(input).required = false; 
  }
}

function showText(radio) {
    var mostrar = radio.getAttribute("data-value");
    var input = radio.getAttribute("data-input");
    var other = radio.getAttribute("data-other");
    var texto_mostrar = radio.getAttribute("data-div");

    radio.classList.add("active");    
    document.getElementById(other).classList.remove("active");

    if (mostrar === "Si") {
          document.getElementById(texto_mostrar).style.display = "block";
          document.getElementById(input+"_si").checked = true;
          document.getElementById(input+"_no").checked = false;

    } else {
          document.getElementById(texto_mostrar).style.display = "none";
          document.getElementById(input+"_si").checked = false;
          document.getElementById(input+"_no").checked = true;  
    }
}