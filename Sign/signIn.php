<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PrintGears Sign In</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .container {
      width: 450px;
      background-color: white;
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    .logo-container {
      text-align: center;
      margin-bottom: 20px;
    }

    .logo-container img {
      width: 150px;
    }

    .logo-container h1 {
      font-size: 24px;
      color: #333;
      margin-top: 10px;
    }

    form {
      display: flex;
      flex-direction: column;
      align-items: stretch;
    }

    form h1 {
      text-align: center;
      font-size: 20px;
      color: #333;
      margin-bottom: 20px;
    }

    .form-group {
      display: flex;
      flex-direction: column;
      margin-bottom: 15px;
    }

    .form-group label {
      font-size: 14px;
      color: #666;
      margin-bottom: 5px;
    }

    .form-group input {
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 14px;
      width: 95%;
    }

    .button-container {
      text-align: center;
    }

    button {
      padding: 10px 20px;
      border: none;
      background-color: #007bff;
      color: white;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    button:hover {
      background-color: #0056b3;
    }

    .footer {
      text-align: center;
      margin-top: 15px;
      font-size: 14px;
    }

    .footer a {
      color: #007bff;
      text-decoration: none;
    }

    .footer a:hover {
      text-decoration: underline;
    }

    .error-popup {
      background-color: #f8d7da;
      color: #842029;
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #f5c2c7;
      border-radius: 5px;
      text-align: center;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="logo-container">
      <img src="../images/LogoPNG.png" alt="PrintGears Logo">
      <h1>PrintGears</h1>
    </div>
    <form action="signIncheck.php" method="POST">
      <h1>Sign In</h1>
      <?php if (isset($_GET['error'])): ?>
        <div class="error-popup"><?php echo htmlspecialchars($_GET['error']); ?></div>
      <?php endif; ?>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required />
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required />
      </div>
      <div class="button-container">
        <button type="submit" name="signIn">Sign In</button>
      </div>
    </form>
    <div class="footer">
      <p>Not registered yet? <a href="SignUp.php">Create an account</a></p>
    </div>
  </div>
</body>

</html>