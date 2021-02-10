<?php

require('../init.php');

if (isset($_SESSION['auth']))
{
  header("Location: ../forms/welcome.php");
  exit();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Camagru</title>
    <link rel="stylesheet" href="../styles/sign.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="../JS/change_password.js"></script>
</head>

<body>
  <div class="sign-in d-flex flex-column">
    <img src="../assets/Sign-in.png" alt="">

    <p id="error-message"></p>
    <div class="container">
      <h1>Reset your password</h1>
      <form id="checkUser">
      <div class="row">
        <input type="password" id="password" class="form-control form-control-lg form-control-sm" placeholder="Password" value="" required>
      </div>
      <div class="row">
        <input type="password" id="passwordConfirmation" class="form-control form-control-lg form-control-sm" placeholder="Repeat Password" value="" required>
      </div>
      <div class="row">
        <button type="submit" value="Login" class="btn btn-primary btn-lg custom-btn">Reset Password</button>
      </div>
    </div>
    </form>
    </div>
<!-- 
    <button class="btn btn-warning mt-4" id="getUsers">Get API Data</button> -->
    <p id="message" class="text-danger mt-2"></p>
    <footer style="">!Silent corner 1337 2021 Covid-19 ikrkharb</footer>
</body>

</html>
