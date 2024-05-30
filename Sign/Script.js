function checkUsername() {
  var username = document.getElementById('username').value;
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'checkUsername.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var response = JSON.parse(xhr.responseText);
      var usernameTaken = document.getElementById('usernameTaken');
      if (response.taken) {
        usernameTaken.style.display = 'block';
      } else {
        usernameTaken.style.display = 'none';
      }
    }
  };
  xhr.send('username=' + encodeURIComponent(username));
}




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


  document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('username').addEventListener('input', checkUsername);
  });
  


