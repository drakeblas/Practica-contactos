var expresion = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i; //formato de email
var expresiontel=/^([0-9]+){9}$/;//con esto vamos a validar el numero
var expresionesp=/\s/;//con esto vamos a validar que no tenga espacios en blanco

//Esta función me permite aplicar las respectivas validaciones del formulario
function validacionRegistro(){
    //Obtengo los datos en variables
    var nombre = document.getElementById("nombre").value;
    var apellidoP = document.getElementById("apellidoP").value;
    var telefono = document.getElementById("telefono").value;
    var correo = document.getElementById("correo").value;
    var foto = document.getElementById("foto").value;
    
    //Reviso que los campos no estén vacíos y después lo comparo
    if(nombre === "" || apellidoP === "" || telefono === "" || correo === "" || foto === "" ){
        if(foto === "" ){
            window.alert("Tienes que agregar una foto.");
            return false;
        } else {
        window.alert("No puede dejar campos vacíos");
        return false;
        }
    }else if(telefono.length != 10){//Longitud del campo telefono
        window.alert("El numero de teléfono debe de tener 10 dígitos.");
        return false;
    }else if(!expresiontel.test(telefono)){
        window.alert("El teléfono sólo debe contener números.");//Comprueba si son numeros ingresados
        return false;
    }else if(expresionesp.test(telefono)){//Comrpueba los espacios
        window.alert("El teléfono no debe tener espacios.");
        return false;
    }else if(!expresion.test(correo)){//Comprueba el correo
        window.alert("El correo electrónico debe tener el siguiente formato: \n ejemplo@correo.com");
        return false;
    }
}
//Una funcion para optimizar no implementada
function validarNum(te){
    var num=/^([0-9]+){9}$/;
    if(!num.test(te)){
    window.alert("El teléfono sólo debe contener números.");
    return false;
    }
}