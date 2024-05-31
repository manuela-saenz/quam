function validateEmail(email) {
  const re =
    /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(String(email).toLowerCase());
}

function containsForbiddenCharacters(inputValue) {
  var regex =
    /<script|<\/script>|<\?php|eval\(|base64_decode|printf\(|system\(|passthru\(|shell_exec\(|exec\(|assert\(|preg_replace\(|assert\(|insert|update|delete|modify|echo|select|join|create|drop|alter|file_put_contents\(|fwrite\(/i;
  return regex.test(inputValue);
}

function ShowError(menssage) {
  const btn_error = document.getElementById("error_alert");
  btn_error.innerHTML = menssage;
  btn_error.style.display = "block";
  setTimeout(function () {
    btn_error.style.display = "none";
  }, 5000);
}

function ShowSuccess(menssage) {
  const btn_success = document.getElementById("success_alert");
  btn_success.innerHTML = menssage;
  btn_success.style.display = "block";
  setTimeout(function () {
    btn_success.style.display = "none";
  }, 5000);
}

function sendForm() {
  $("#btnSend").on("click", function (e) {
    e.preventDefault();
    var $submitButton = $(this);
    var form = $("#contact-form");
    var nameField = $("#txtName");
    var emailField = $("#txtEmail");
    var messageField = $("#txtMessage");
    var phoneField = $("#txtPhone");
    var orderReference = $("#txtConsult");

    if ($submitButton.hasClass("disabled")) {
      return;
    }

    if (nameField.val() == "" || containsForbiddenCharacters(nameField.val())) {
      if (nameField.val() == "") {
        ShowError("Por favor ingrese su nombre");
      } else {
        ShowError("Caracteres no permitidos en el nombre");
      }
      nameField.focus();
      return false;
    } else if (
      emailField.val() == "" ||
      containsForbiddenCharacters(emailField.val())
    ) {
      if (emailField.val() == "") {
        ShowError("Por favor ingrese su correo");
      } else {
        ShowError("Caracteres no permitidos en el correo");
      }
      emailField.focus();
      return false;
    } else if (!validateEmail(emailField.val())) {
      ShowError("Por favor ingrese un correo válido");
      emailField.focus();
      return false;
    } else if (
      phoneField.val() == "" ||
      containsForbiddenCharacters(phoneField.val())
    ) {
      if (phoneField.val() == "") {
        ShowError("Por favor ingrese su teléfono");
      } else {
        ShowError("Caracteres no permitidos en el teléfono");
      }
      phoneField.focus();
      return false;
    } else if (
      orderReference.val() == "" ||
      containsForbiddenCharacters(orderReference.val())
    ) {
      if (orderReference.val() == "") {
        ShowError("Por favor ingrese el número de orden");
      } else {
        ShowError("Caracteres no permitidos en el código del país");
      }
      orderReference.focus();
      return false;
    } else if (
      messageField.val() == "" ||
      containsForbiddenCharacters(messageField.val())
    ) {
      if (messageField.val() == "") {
        messageField.val() == "Sin datos";
      } else {
        ShowError("Caracteres no permitidos en el mensaje");
      }
      messageField.focus();
      return false;
    }

    $submitButton.addClass("disabled").text("Enviando...").css({
      cursor: "not-allowed",
      opacity: "0.5",
    });

    var formData = {
      action: "send_mail_contact",
      name: nameField.val(),
      email: emailField.val(),
      message: messageField.val(),
      phone: phoneField.val(),
      consult: orderReference.val(),
    };

    function handleResponse(status, message) {
      if (status === "200") {
        ShowSuccess(message);
        form[0].reset();
        $submitButton.removeClass("disabled").text("Enviar mensaje").css({
          cursor: "pointer",
          opacity: "1",
        });
      } else if (status != "200") {
        ShowError(message);
      }
    }

    $.ajax({
      type: "POST",
      url: ajaxUrl,
      data: formData,
      dataType: "json",
      encode: true,
      success: function (data) {
        handleResponse(data.status, data.message);
      },
      error: function (response) {
        handleResponse(response.status, response.message);
      },
    });
  });
}

//Predeterminado
sendForm();
