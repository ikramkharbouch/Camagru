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
    <script src="../JS/signup.js"></script>
</head>

<body>

<div class="sign-in">
    <img src="../assets/Sign-in.png" alt="">
    <div class="error-message">
      <p id="message" class="text-danger mt-10"></p>
    </div>
    <div class="container">
      <h1>Sign Up to <span>Camagru</span></h1>
      <form id="addPost">
      <div class="col">
      <div class="row">
        <input type="text" id="email" class="form-control form-control-lg" placeholder="Email" required>
      </div>
      <div class="row">
        <input type="text" id="fullname" class="form-control form-control-lg" placeholder="Full name" required>
      </div>
      <div class="row">
        <input type="text" id="username" class="form-control form-control-lg" placeholder="Username" required>
      </div>
      <div class="row">
        <input type="password" id="pass" class="form-control form-control-lg" placeholder="Password" required>
      </div>
      <div class="row">
        <button type="submit" value="Register" class="btn btn-primary btn-lg custom-btn">Register</button>
      </div>
    </div>
    </form>
    </div>
    <footer style="position: fixed;">!Silent corner 1337 2021 Covid-19 ikrkharb</footer>
</body>

</html>
