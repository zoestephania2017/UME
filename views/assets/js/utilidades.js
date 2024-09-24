
//Funcion ajax para obtener la ciudad segun el departamento seleccionado
function getciudad() {
    $("#departamento").ready(function () {
        $("#departamento option:selected").each(function () {
            departamento = $(this).val();
            $.post("http://localhost/ume/ciudad/getciudad", {departamento: departamento}, function (data) {
                $("#ciudad").html(data);
                getpunto();
                getpaciente();
                getophs();
                getcentroasistencial();
                getambulancia();
                getambulancias();


            });
        });

    });

}

//Funcion ajax para obtener la ciudad segun el departamento seleccionado
function getunaciudad() {
    $("#departamento").ready(function () {
        $("#departamento option:selected").each(function () {
            departamento = $(this).val();
            $.post("http://localhost/ume/ciudad/getunaciudad", {departamento: departamento}, function (data) {
                $("#ciudad").html(data);
                getpunto();
                getpaciente();
                getophs();
                getcentroasistencial();
                 reportecentro() ;
                getambulancia();
                getambulancias();

            });
        });

    });

}




//Funcion ajax para obtener la ciudad segun el departamento seleccionado
function reporteciudad() {
    $("#departamento").ready(function () {
        $("#departamento option:selected").each(function () {
            departamento = $(this).val();
            $.post("http://localhost/ume/ciudad/reporteciudad", {departamento: departamento}, function (data) {
                $("#ciudad").html(data);
                
         


            });
        });

    });

}



//Funcion ajax para obtener la ciudad segun el departamento seleccionado
function getciudadestado() {
    $("#departamento").ready(function () {
        $("#departamento option:selected").each(function () {
            departamento = $(this).val();
            $.post("http://localhost/ume/ciudad/getunaciudad", {departamento: departamento}, function (data) {
                $("#ciudad").html(data);
                getpuntoestado();
            });
        });

    });

}








//Funcion ajax para obtener los puntos estrategicos segun la ciudad seleccionada
function getpunto() {
    $("#ciudad").ready(function () {
        $("#ciudad option:selected").each(function () {
            ciudad = $(this).val();
            estado = 5;
            $.post("http://localhost/ume/puntoestrategico/getpunto", {ciudad: ciudad}, function (data) {
                $("#punto").html(data);
                getambulancia();
                getpaciente();
                getophs();
                getconductor();
                getparamedico();
                getcentroasistencial();

            });
        });

    });
}


//Funcion ajax para obtener los puntos estrategicos segun la ciudad seleccionada
function getpuntoestado() {
    $("#ciudad").ready(function () {
        $("#ciudad option:selected").each(function () {
            ciudad = $(this).val();
            estado = 5;
            $.post("http://localhost/ume/puntoestrategico/getpunto", {ciudad: ciudad}, function (data) {
                $("#punto").html(data);
                getambulancias();
                getconductores();
                getparamedicos();


            });
        });

    });
}












//Funcion ajax para obtener el paciente segun la ciudad seleccionado
function getpaciente() {
    $("#ciudad").ready(function () {
        $("#ciudad option:selected").each(function () {
            ciudad = $(this).val();
            $.post("http://localhost/ume/paciente/getpaciente", {ciudad: ciudad}, function (data) {
                $("#paciente").html(data);

            });
        });

    });

}





//Funcion ajax para obtener el ophs segun el departamento seleccionado
function getophs() {
    $("#ciudad").ready(function () {
        $("#ciudad option:selected").each(function () {
            ciudad = $(this).val();
            $.post("http://localhost/ume/medico/getmedico", {ciudad: ciudad}, function (data) {
                $("#ophs").html(data);

            });
        });

    });

}


//Funcion ajax para obtener el ophs segun el departamento seleccionado
function getcentroasistencial() {
    $("#ciudad").ready(function () {
        $("#ciudad option:selected").each(function () {
            ciudad = $(this).val();
            $.post("http://localhost/ume/centroasistencial/getcentroasistencial", {ciudad: ciudad}, function (data) {
                $("#centroasistencial").html(data);

            });
        });

    });

}


//Funcion ajax para obtener el ophs segun la ciudad seleccionada
function reportecentro() {
    $("#ciudad").ready(function () {
        $("#ciudad option:selected").each(function () {
            ciudad = $(this).val();
            $.post("http://localhost/ume/centroasistencial/reportecentro", {ciudad: ciudad}, function (data) {
                $("#centroasistencial").html(data);

            });
        });

    });

}



//Funcion ajax para obtener la ambulancia segun el punto estrategico seleccionado
function getambulancia() {
    $("#punto").ready(function () {
        $("#punto option:selected").each(function () {
            punto = $(this).val();
            $.post("http://localhost/ume/ambulancia/getambulancia", {punto: punto}, function (data) {
                $("#ambulancia").html(data);

            });
        });

    });

}


//Funcion ajax para obtener la ambulancia segun el punto estrategico seleccionado
function getambulancias() {
    $("#punto").ready(function () {
        $("#punto option:selected").each(function () {
            punto = $(this).val();
            $.post("http://localhost/ume/ambulancia/getambulancias", {punto: punto}, function (data) {
                $("#ambulancia").html(data);

            });
        });

    });

}

//Funcion ajax para obtener la ambulancia segun el punto estrategico seleccionado
function reporteambulancia() {
    $("#punto").ready(function () {
        $("#punto option:selected").each(function () {
            punto = $(this).val();
            $.post("http://localhost/ume/ambulancia/reporteambulancia", {punto: punto}, function (data) {
                $("#ambulancia").html(data);

            });
        });

    });

}





//Funcion ajax para obtener el paramedico segun la ciudad seleccionado
function getparamedico() {
    $("#ciudad").ready(function () {
        $("#ciudad option:selected").each(function () {
            ciudad = $(this).val();
            $.post("http://localhost/ume/paramedico/getparamedico", {ciudad: ciudad}, function (data) {
                $("#paramedico").html(data);



            });
        });

    });

}

//Funcion ajax para obtener el paramedico segun la ciudad seleccionado
function getparamedicos() {
    $("#ciudad").ready(function () {
        $("#ciudad option:selected").each(function () {
            ciudad = $(this).val();
            $.post("http://localhost/ume/paramedico/getparamedicos", {ciudad: ciudad}, function (data) {
                $("#paramedico").html(data);



            });
        });

    });

}



//Funcion ajax para obtener el conductor segun la ciudad seleccionado
function getconductor() {
    $("#ciudad").ready(function () {
        $("#ciudad option:selected").each(function () {
            ciudad = $(this).val();
            $.post("http://localhost/ume/conductor/getconductor", {ciudad: ciudad}, function (data) {
                $("#conductor").html(data);

            });
        });

    });

}

//Funcion ajax para obtener el conductor segun la ciudad seleccionado
function getconductores() {
    $("#ciudad").ready(function () {
        $("#ciudad option:selected").each(function () {
            ciudad = $(this).val();
            $.post("http://localhost/ume/conductor/getconductores", {ciudad: ciudad}, function (data) {
                $("#conductor").html(data);

            });
        });

    });

}


//Funcion para validar que la contraseña es igual
function confirmarcontraseña() {


    var contrasena1 = document.formulario.nuevacontrasena.value;
    var contrasena2 = document.formulario.confirmarcontrasena.value;

    if (contrasena1 != contrasena2) {
        confirmarcontrasena.value = "";
        confirmarcontrasena.focus();
        return Swal.fire("Advertencia", "La nueva contraseña y la confirmación de contraseña no coinciden, vuelva a intentarlo.", "warning");

        return false;

    } else {
        return true;
    }
}


function mensaje(tabla, accion) {

    Swal.fire(
            tabla,
            accion + ' Exitosamente!',
            'success'
            )
}



function mensajeadvertencia() {

    Swal.fire("Advertencia", "Algunos campos son requeridos.", "warning");
}



function mensajeerror(tabla) {

    Swal.fire(tabla, " la identidad y/o correo electronico que se desea ingresar ya existen.", "warning");
}
function messageDuplicated($message) {

    Swal.fire("Advertencia", $message, "warning");
}


//Funcion para limitar la cantidad de caracteres que puede ingresar segun el MaxLenght que se define en el elemento HTML
function limitarlongitud(obj) {

    console.log(obj.value);

    if (obj.value.length > obj.maxLength) {

        obj.value = obj.value.slice(0, obj.maxLength);
    }
}

function validarlogin() {

    var usuario = $("#usuario").val();
    var contrasena = $("#contrasena").val();

    if (usuario.length === 0 || contrasena.length === 0) {
        return Swal.fire("Advertencia", "Todos los Campos deben ser completados", "warning");
    }

    $.ajax({
        url: '../../controller/usuarioController.php?index()',
        type: 'POST',
        data: {
            usuario: usuario,
            contrasena: contrasena
        }
    });

}




function guardarestado() {

    var descripcion = $("#descripcion").val();


    if (descripcion.length === 0) {
        return Swal.fire("Advertencia", "Todos los campos deben ser completados", "warning");


    } else {

        $.ajax({
            url: "http://localhost/ume/estado/guardar",
            type: 'POST',
            data: {
                descripcion: descripcion
            }


        });

        return Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Estado Guardado Exitosamente',
            showConfirmButton: false,
            timer: 1500
        });

    }
}




function cambiarcontrasena() {

    var nueva = $("#nuevacontrasena").val();
    var confirmar = $("#confirmarcontrasena").val();

    if (nueva === confirmar) {
        $.ajax({
            url: "http://localhost/ume/usuario/cambiarcontrasena",
            type: 'POST',
            data: {
                nueva: nueva
            }


        });

    } else {

        return Swal.fire("Advertencia", "Las contraseñas no coinciden", "warning");
    }


}































