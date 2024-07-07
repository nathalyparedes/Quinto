
function procesar(){8
    var correo = document.getElementById("correo").value;
    var contrasenia =document.getElementById("contrasenia").value;

    if(correo== "nathaly@hotmail.com" &&contrasenia == "123"){
        alert("Bienvenido");
    }else{
        alert("El usuario o la contraseña son incorrectos");
    }



}