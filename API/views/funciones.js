const miniAlerta = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 5500,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.onmouseenter = Swal.stopTimer;
    toast.onmouseleave = Swal.resumeTimer;
  },
});

if (document.getElementById("formulario")) {
  document
    .getElementById("formulario")
    .addEventListener("submit", function (event) {
      event.preventDefault(); // Evita el envío del formulario por defecto
    });
}

window.addEventListener("load", () => {
  if (document.getElementById("cod-verificador")) {
    if (document.getElementById("cod-verificador").value == "no") {
      Swal.fire({
        icon: "error",
        title: "¡ERROR!",
        text: "No se ha encontrado el usuario.",
        showConfirmButton: true,
        footer: "Guillermo Granadino ©",
        timer: 4000,
      }).then(() => {
        window.location.href = "/API/";
      });
    }
  } else if (document.getElementById("eliminar-h")) {
    if (document.getElementById("eliminar-h").value == "OK") {
      Swal.fire({
        icon: "success",
        title: "¡ÉXITO!",
        text: "Se ha eliminado el usuario con éxito.",
        footer: "Guillermo Granadino ©",
        timer: 2500,
      }).then(() => {
        window.location.href = "/API/listar";
      });
    } else {
      Swal.fire({
        icon: "error",
        title: "¡ERROR!",
        text: "No se ha encontrado el usuario.",
        footer: "Guillermo Granadino ©",
        timer: 2500,
      }).then(() => {
        window.location.href = "/API/listar";
      });
    }
  }
});

if (document.getElementById("btn-crear")) {
  document.getElementById("btn-crear").addEventListener("click", () => {
    console.log("Inicia la función");
    let nombre = document.getElementById("nombre").value;
    let apellido = document.getElementById("apellido").value;
    if (validarDatos()) {
      $.ajax({
        url: "/API/controller/ctrlUsuario.php",
        data: {
          nombre: nombre,
          apellido: apellido,
          accion: "crear",
        },
        type: "POST",
        dataType: "json",
      })
        .done((response) => {
          if (response == "OK") {
            alertaOn(
              "Se ha guardado el Usuario con éxito.",
              "mini",
              "success",
              "¡ÉXITO!"
            );
          } else {
            alertaOn(
              "Ha ocurrido un error al guardar el usuario.",
              "mini",
              "error",
              "¡ERROR!"
            );
            console.log(response);
          }
        })
        .fail((response) => {
          alertaOn(response, "completa", "error", "¡ERROR!");
          console.log(response);
        });
    }
  });
}

if (document.getElementById("btn-modificar")) {
  document.getElementById("btn-modificar").addEventListener("click", () => {
    let codigo = document.getElementById("codigo").value;
    let nombre = document.getElementById("nombre").value;
    let apellido = document.getElementById("apellido").value;
    if (validarDatos()) {
      $.ajax({
        url: "../controller/ctrlUsuario.php",
        data: {
          codigo: codigo,
          nombre: nombre,
          apellido: apellido,
          accion: "modificar",
        },
        type: "POST",
        dataType: "json",
      })
        .done((response) => {
          if (response == "OK") {
            alertaOn(
              "Se ha modificado el Usuario con éxito.",
              "mini",
              "success",
              "¡ÉXITO!"
            );
          } else {
            console.log(response);
            alertaOn(
              "Ha ocurrido un error al modificar el usuario.",
              "mini",
              "error",
              "¡ERROR!"
            );
          }
        })
        .fail((response) => {
          console.log(response);
          alertaOn(response, "completa", "error", "¡ERROR!");
        });
    }
  });
}

function modificarUser(cod) {
  window.location.href = "/API/modificar/" + cod;
}

function eliminarUser(cod) {
  Swal.fire({
    title: "¿Está seguro que desea eliminar este usuario?",
    showCancelButton: true,
    showConfirmButton: true,
    confirmButtonText: "Sí, eliminar",
    cancelButtonText: "Cancelar",
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    icon: "warning",
    footer: "Guillermo Granadino",
  }).then((resultado) => {
    if (resultado.value) {
      $.ajax({
        url: "/API/controller/ctrlUsuario.php",
        data: { codigo: cod, accion: "eliminar" },
        type: "POST",
        dataType: "json",
      })
        .done((response) => {
          if (response == "OK") {
            alertaOn(
              "Se ha eliminado el usuario con éxito",
              "mini",
              "success",
              "¡Éxito!"
            );
            setTimeout(() => {
              window.location.href = "/API/listar";
            }, 5500);
          } else {
            alertaOn(
              "Ha ocurrido un error al eliminar el usuario",
              "mini",
              "error",
              "¡ERROR!"
            );
            console.log(response);
          }
        })
        .fail((response) => {
          console.log(response);
        });
    }
  });
}

function validarDatos() {
  let expDatos = /^[a-zA-Z\u00C0-\u017F\s]+$/;

  if (
    !expDatos.test(document.getElementById("nombre").value) ||
    document.getElementById("nombre").value == ""
  ) {
    alertaOn(
      "El nombre que ha ingresado es inválido. Recuerde que no debe dejar el campo vacío ni colocar números ni caracteres especiales.",
      "mini",
      "error",
      "¡ERROR!"
    );
    return false;
  } else if (
    !expDatos.test(document.getElementById("apellido").value) ||
    document.getElementById("apellido").value == ""
  ) {
    alertaOn(
      "El apellido que ha ingresado es inválido. Recuerde que no debe dejar el campo vacío ni colocar números ni caracteres especiales.",
      "mini",
      "error",
      "¡ERROR!"
    );
    return false;
  } else return true;
}

function alertaOn(descrip, tipo, icono, titulo) {
  if (tipo != "mini") {
    Swal.fire({
      type: icono,
      title: titulo,
      text: descrip,
      footer: "Guillermo Granadino ©",
    });
  } else {
    miniAlerta.fire({
      icon: icono,
      title: titulo,
      text: descrip,
    });
  }
}
