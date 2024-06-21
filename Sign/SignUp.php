<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../static/css/signUp.css">
  <title>MiZu_Stickers Sign up</title>
</head>

<body>
  <div class="container">
    <div class="left">
      <form action="InsertUser.php" method="POST" onsubmit="return validateForm()">
        <h1>Sign up</h1>
        <div>
          <label for="fullname">Name:</label> <br />
          <input type="text" id="fullname" name="fullname" pattern="[A-Za-z\s]+" title="Name should not contain numbers"
            required />
        </div>
        <div>
          <label for="email">Email:</label> <br />
          <input type="email" id="email" name="email" required />
        </div>

        <div>
          <label for="username">Username:</label> <br />
          <input type="text" id="username" name="username" required />
          <div id="usernameTaken" style="color: red; display: none;">Username is already taken</div>

        </div>

        <div class="password-field">
          <label for="password">Password:</label> <br />
          <input type="password" id="password" name="password" required />
        </div>
        <div class="password-field">
          <label for="confirmPassword">Confirm Password:</label> <br />
          <input type="password" id="confirmPassword" name="confirmPassword" oninput="checkPasswordMatch()" required />
          <div id="passwordMismatch" style="color: red; display: none;">Passwords do not match</div>
        </div>
        <div class="button-container">
          <button type="submit" name="signUp">Sign Up</button>
        </div>
      </form>
    </div>
    <div class="right">
      <img src="../images/Saitama ok.png" alt="Saitama Picture" />
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script>
    $(document).ready(function () {
      <?php session_start();
      if (isset($_SESSION['message'])) { ?>
        Swal.fire({
          title: '<?php echo $_SESSION['message']; ?>',
          icon: '<?php echo $_SESSION['message_type']; ?>'
        }).then(() => {
          <?php if (isset($_GET['redirect']) && $_SESSION['message_type'] == 'success') { ?>
            window.location.href = 'signIn.php';
          <?php } ?>
        });
        <?php unset($_SESSION['message']);
        unset($_SESSION['message_type']); ?>
      <?php } ?>
    });

    function checkPasswordMatch() {
      var password = document.getElementById("password").value;
      var confirmPassword = document.getElementById("confirmPassword").value;
      var mismatchDiv = document.getElementById("passwordMismatch");
      if (password !== confirmPassword) {
        mismatchDiv.style.display = "block";
      } else {
        mismatchDiv.style.display = "none";
      }
    }

    function validateForm() {
      var password = document.getElementById("password").value;
      var confirmPassword = document.getElementById("confirmPassword").value;
      if (password !== confirmPassword) {
        Swal.fire({
          title: 'Passwords do not match!',
          icon: 'warning'
        });
        return false;
      }
      return true;
    }
  </script>
</body>

</html>