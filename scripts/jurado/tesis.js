document.getElementById("submitForm").addEventListener("click", function(event) {
    event.preventDefault();

    var formTitle = document.getElementById("formTitle").value;
    var formDate = document.getElementById("formDate").value;
    var formStatus = document.getElementById("formStatus").value;
    var formObservations = document.getElementById("formObservations").value;

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "enviar_formulario.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
      if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {

        if (this.responseText === "success") {
          alert("Formulario enviado exitosamente");
        } else {
          alert("Error al enviar el formulario");
        }
        $("#formModal").modal("hide");
      }
    };
    xhr.send("titulo=" + formTitle + "&fecha=" + formDate + "&estado=" + formStatus + "&observaciones=" + formObservations);
  });

