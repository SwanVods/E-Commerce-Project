<?php
if (isset($_SESSION['email'])) {
  header('Location: index.php');
} else {
  include 'login.min.php';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="e-commerce project">
  <link rel="stylesheet" type="text/css" href="styles/bootstrap-4.1.3/bootstrap.css">
  <link href="plugins/fontawesome-free-5.13.0-web/css/all.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="styles/login.css">

  <title>Login</title>
  <script src="https://www.googleapis.com/auth/plus.login"></script>

</head>

<body>
  <div class="login-container">
    <form class="login-form" method="post">
      <div class="close" onclick="document.location.href='index.php'"><i class="fas fa-times"></i></div>
      <h1 class="header">Welcome back!</h1>
      <div class="textbox">
        <i class="fas fa-envelope"></i>
        <input id="email" class="inputan" name="email" type="email" placeholder="Email" required="required">
      </div>
      <div class="textbox">
        <i class="fas fa-lock"></i>
        <input id="pass" class="inputan " name="pass" type="password" placeholder="Password" required="required">
        <span toggle="#pass" class="fas fa-eye toggle-pass"></span>
      </div>
      <?php if (isset($error)) { ?>
        <div class="warn" role="alert" style="display:block;"> Incorrect Email or Password. </div>
      <?php } ?>

      <!-- Button -->
      <div class="action_btn d-flex justify-content-between">
        <div class="login-btn">
          <button class="submit_button mr-auto rounded" type="submit" name="submit">Login</button>
        </div>
        <div class="login-btn">
          <div class="submit_button mr-auto rounded" onclick="document.location.href='<?= $auth_url ?>'">Login With <i class="fab fa-google fa-sm"></i> </div>
        </div>
      </div>
      <div class="action_btn d-flex justify-content-between">
        <a href="signup.php" class="help signup">Not a member yet?</a>
        <a href="#" class="help">Forgot your password?</a>
      </div>
    </form>
  </div>

  <script src="https://apis.google.com/js/platform.js" async defer></script>
  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="styles/bootstrap-4.1.3/bootstrap.min.js"></script>
  <script src="js/signup.js"></script>
</body>

</html>