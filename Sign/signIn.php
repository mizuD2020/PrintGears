<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../static/css/signIn.css">
  <title>MiZu_Stickers Sign In</title>
</head>

<body>
  <?php if (isset($_GET['error'])): ?>
    <div class="error-popup" id="errorPopup"><?php echo htmlspecialchars($_GET['error']); ?></div>
  <?php endif; ?>

  <div class="container">
    <div class="left">
      <form action="signIncheck.php" method="POST">
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
        <?php if (isset($_SESSION['message']) && $_SESSION['message_type'] == 'success'): ?>
          <div class="tick-icon">&#10003;</div>
        <?php endif; ?>
      </form>
      <div>
        <p>Not registered yet? <a href="SignUp.php">Create an account</a></p>
      </div>
    </div>
    <div class="right">
      <img src="../images/Saitama.png" alt="Saitama Picture" />
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
        });
          <?php unset($_SESSION['message']);
          unset($_SESSION['message_type']); ?>
      <?php } ?>
    });
  </script>
  <script src="Scripts.js"></script>
</body>
</html>
