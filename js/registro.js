function togglePasswordVisibility() {
    var input = document.getElementById("input");
    var verPassword = document.getElementById("verPassword");

    if (input.type === "password") {
      input.type = "text";
      verPassword.className = "fas fa-eye-slash";
    } else {
      input.type = "password";
      verPassword.className = "fas fa-eye";
    }
  }