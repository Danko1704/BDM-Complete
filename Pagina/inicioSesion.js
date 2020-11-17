function required() {
  var correoBool = false;
  var contraseñaBool = false;

  var correoElectronico = document.form1.correoBox.value;
  var contraseña = document.form1.contraseñaBox.value;

  if (correoElectronico === "") {
    alert("Porfavor ingresa un correo");
    correoBool = false;
  } else {
    correoBool = true;
  }

  if (contraseña === "") {
    alert("Porfavor ingresa una contraseña");
    contraseñaBool = false;
  } else {
    contraseñaBool = true;
  }

  ////////////////////////////////////////////////////////
  if (correoBool === true && contraseñaBool === true) {
    window.location.href = "index.html";
    return true;
  } else {
    alert("Te faltaron datos");
    return false;
  }
}
