function required() {
    var nombreBool = false;
    var correoBool = false;
    var contraseñaBool = false;
    var numeroBool = false;
  
    var nombreCompleto = document.form1.nombreBox.value;
    var correoElectronico = document.form1.correoBox.value;
    var contraseña = document.form1.contraseñaBox.value;
    var numero = document.form1.numeroBox.value;
  
    var passw = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    var emailw = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
  
    if (nombreCompleto === "") {
      alert("Porfavor ingresa un nombre");
      nombreBool = false;
    } else {
      nombreBool = true;
    }
  
    if (correoElectronico != "") {
      if (emailw.test(correoElectronico)) {
        correoBool = true;
      } else {
        alert("El correo es invalido");
        correoBool = false;
      }
    } else {
      alert("Porfavor ingresa un email");
      contraseñaBool = false;
    }
  
    if (contraseña != "") {
      if (contraseña.match(passw)) {
        contraseñaBool = true;
      } else {
        contraseñaBool = false;
        alert(
          "La contraseña debe contener una mayuscula, un numero y un caracter especial"
        );
      }
    } else {
      alert("Porfavor ingresa una contraseña");
      contraseñaBool = false;
    }

    if (numero === "") {
        alert("Porfavor ingresa un telefono");
        numeroBool = false;
      } else {
        numeroBool = true;
      }
  
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    if (
      nombreBool === true &&
      correoBool === true && 
      contraseñaBool === true &&
      numeroBool === true
    ) {
        window.location.href = "index.html";
      return true;
    } else {
      alert("Revisar los datos");
      return false;
    }
  }