<?php
include 'signup.min.php';
if (isset($success)) {
  header("Location: success.html");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="styles/bootstrap-4.1.3/bootstrap.css">
  <link href="plugins/fontawesome-free-5.13.0-web/css/all.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="styles/signup.css">
  <title>Signup</title>
</head>

<body>
  <div class="login-container">
    <form class="login-form" method="post">
      <div class="close" onclick="document.location.href='index.php'"><i class="fas fa-times"></i></div>
      <h1 class="header">Sign Up</h1>

      <div class="name_container d-flex">
        <div class="name mr-auto">
          <!-- Textbox name -->
          <div class="textbox">
            <i class="fas fa-user"></i>
            <input type="text" class="inputan" name="fname" placeholder="First Name" required="required" autocomplete="off">
          </div>
        </div>
        <div class="name ml-auto">
          <!-- Textbox name-->
          <div class="textbox">
            <i class="fas fa-user"></i>
            <input type="text" class="inputan" name="lname" placeholder="Last Name" required="required" autocomplete="off">
          </div>
        </div>
      </div>
      <!-- Textbox email-->
      <div class="textbox mail">
        <i class="fas fa-envelope"></i>
        <input id="email" class="inputan" name="email" type="email" placeholder="Email" required="required" autocomplete="off">
      </div>
      <?php if (isset($emailError)) { ?>
        <div class="warn mail" role="alert" style="display:block;"> Email is already registered. </div>
      <?php } ?>


      <!-- Textbox phone-->
      <div class=" textbox phone">
        <i class="fas fa-phone-alt"></i>
        <input type="tel" class="inputan" name="telpon" placeholder="Telephone" required="required" autocomplete="off">
      </div>
      <?php if (isset($telpError)) { ?>
        <div class="warn phone" role="alert" style="display:block;"> Telp Number is already registered. </div>
      <?php } ?>

      <!-- Textbox pass-->
      <div class="textbox">
        <i class="fas fa-lock"></i>
        <input id="pass" class="inputan pw" name="passwd" type="password" placeholder="Password" required="required" autocomplete="off">
        <span toggle="#pass" class="fas fa-eye toggle-pass"></span>
      </div>

      <!-- Textbox pass2-->
      <div class="textbox">
        <i class="fas fa-lock"></i>
        <input id="pass_conf" class="inputan pw" type="password" placeholder="Confirm Password" required="required" autocomplete="off">
        <span toggle="#pass_conf" class="fas fa-eye toggle-pass"></span>
      </div>

      <!-- pass warn -->
      <div class="warn pw" role="alert">
        Password doesn't match
      </div>

      <!-- Terms -->
      <div class="cbox">
        <input type="checkbox" name="Terms" value="" required="required">
        <span>i've read and agree the <a href="terms.html" class="terms">Terms of service</a></span>
      </div>

      <!-- Submit -->
      <div class="action_btn d-flex">
        <button id="submitBtn" class="submit_btn rounded" type="submit" name="submit">Join Now!</button>
        <a href="login.php" class="help ml-auto mr-auto">Already a member?</a>
      </div>
      <?php if (isset($success)) { ?>
        <!-- <div class="success" role="alert" style="display:block;"> Successfully Registered! </div> -->
      <?php }; ?>

    </form>
  </div>
  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="styles/bootstrap-4.1.3/bootstrap.min.js"></script>
  <script src="js/signup.js"></script>
</body>

</html>