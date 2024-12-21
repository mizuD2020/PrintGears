<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <title>PrintGears Sign Up</title>
  <style>
    body {
      background-color: #f8f9fa;
      font-family: Arial, sans-serif;
    }

    .logo-container {
      text-align: center;
      margin: 30px 0;
    }

    .logo-container img {
      max-width: 150px;
    }

    .logo-container h1 {
      margin-top: 10px;
      font-size: 32px;
      font-weight: bold;
      color: rgb(0, 0, 0);
    }

    .signup-container {
      max-width: 500px;
      margin: 0 auto;
      padding: 30px;
      background: white;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }

    label {
      font-weight: bold;
    }

    input {
      margin-bottom: 20px;
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: 5px;
      width: 100%;
    }

    button {
      width: 100%;
      background-color: #007bff;
      color: white;
      border: none;
      padding: 10px;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
    }

    button:hover {
      background-color: #0056b3;
    }

    .error-message {
      color: red;
      font-size: 14px;
      display: none;
      margin-top: -15px;
      margin-bottom: 10px;
    }
  </style>
</head>

<body>
  <div class="logo-container">
    <img src="../images/LogoPNG.png" alt="PrintGears Logo" />
    <h1>PrintGears</h1>
  </div>

  <div class="signup-container">
    <form action="InsertUser.php" method="POST" onsubmit="return validateForm()">
      <h2>Sign Up</h2>
      <div>
        <label for="fullname">Name:</label>
        <input type="text" id="fullname" name="fullname" pattern="[A-Za-z\s]+" title="Name should not contain numbers"
          required />
      </div>
      <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required />
      </div>
      <div>
        <label for="phone">Phone Number:</label>
        <input type="text" id="phone" name="phone" pattern="[0-9]{10}" title="Phone number should be 10 digits"
          required />
      </div>
      <div>
        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required />
      </div>
      <div>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required />
        <div id="usernameTaken" class="error-message">Username is already taken</div>
      </div>
      <div>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required />
      </div>
      <div>
        <label for="confirmPassword">Confirm Password:</label>
        <input type="password" id="confirmPassword" name="confirmPassword" oninput="checkPasswordMatch()" required />
        <div id="passwordMismatch" class="error-message">Passwords do not match</div>
      </div>
      <div>
        <button type="submit" name="signUp">Sign Up</button>
      </div>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script>
    function checkPasswordMatch() {
      var password = document.getElementById("password").value;
      var confirmPassword = document.getElementById("confirmPassword").value;
      var mismatchDiv = document.getElementById("passwordMismatch");
      mismatchDiv.style.display = password === confirmPassword ? "none" : "block";
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