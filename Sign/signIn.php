<!DOCTYPE html>
<html lang="en">

<head>

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=\, initial-scale=1.0" />
    <link rel="stylesheet" href="../static/css/signIn.css">
    <title>MiZu_Stickers Sign In</title>

  <body>
    <?php if (isset($_GET['error'])) : ?>
      <div class="error-popup" id="errorPopup"><?php echo htmlspecialchars($_GET['error']); ?></div>
    <?php endif; ?>
    <div class="container">
      <div class="left">


        <form action="SignIncheck.php" method="POST">
          <h1>Sign In</h1>

          <div>
            <label for="email">Email:</label> <br />
            <input type="email" id="email" name="email" required />
          </div>
          <div>
            <label for="password">Password:</label> <br />
            <input type="password" id="password" name="password" required />
          </div>
          <div class="button-container">
            <button type="submit" name="signIn">Sign In</button>
          </div>
        </form>
        <div>
          <p>It's not registered yet?<a href="SignUp.php">Create an account</a></p>
        </div>
      </div>
      <div class="right">
        <img src="../images/Saitama.png" alt="" />
      </div>
    </div>
    <script src="Scripts.js"></script>
  </body>

</html>