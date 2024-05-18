function checkPasswordMatch() {
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirmPassword").value;
    var passwordMismatch = document.getElementById("passwordMismatch");

    if (password !== confirmPassword) {
      passwordMismatch.style.display = "block";
    } else {
      passwordMismatch.style.display = "none";
    }
  }



  function validateForm() {
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirmPassword").value;

    if (password !== confirmPassword) {
      document.getElementById("passwordMismatch").style.display = "block";
      return false;
    }

    return true;
  }

  document.addEventListener("DOMContentLoaded", function() {
      var errorPopup = document.getElementById("errorPopup");
      if (errorPopup) {
          errorPopup.style.display = "block";
          setTimeout(function() {
              errorPopup.style.display = "none";
          }, 3000); // Hide after 3 seconds
      }
  });
