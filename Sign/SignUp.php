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
          <label for="fullname">Fullname:</label> <br />
          <input type="text" id="fullname" name="fullname" required />
        </div>
        <div>
          <label for="email">Email:</label> <br />
          <input type="email" id="email" name="email" required />
        </div>

        <div>
          <label for="username">Username:</label> <br />
          <input type="text" id="username" name="username" required />
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

  <script src="Scripts.js">

  </script>
</body>

</html>