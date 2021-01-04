<?php
@require('../init.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Camagru</title>
  <link rel="stylesheet" href="../styles/gallery.css">
  <link rel="stylesheet" href="../styles/welcome.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <script src="../JS/gallery.js"></script>
  <script src="../JS/menu.js"></script>
</head>

<body>

<!-- <div class="container"> -->

<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <h1>Camagru</h1>
    <a href="../index.php">Home</a>
    <a href="./gallery.php">Gallery</a>
    <a href="./profile.php">Profile</a>
    <a href="./settings.php">Settings</a>
    <a href="../logout.php">Logout</a>
  </div>

  <!-- Use any element to open the sidenav -->
  <span onclick="openNav()"><i class="fas fa-bars"></i>
  </span>

  <div class="user-details d-flex flex-row">
    <img src="../assets/avatar.png" alt="Avatar" class="avatar">
    <p class="font-weight-bold ml-1">Ikram Kharbouch</p>
  </div>

  <!-- <a href="#" class="btn btn-primary text-center" id="getimages">Get Images</a> -->

  <div class="container d-flex flex-wrap" id="container">
  
  <!-- <div class="card" id="card" style="width: 17rem;">
  <img src="../img/8HvrVh.png" class="card-img-top" alt="myImg"> -->
  <!-- <div class="card-body" id="card-body">
    <a href="#" class="btn btn-primary">Go somewhere</a> -->
    <!-- <h4>Hello</h4> -->
  <!-- </div>
    <div class="card-footer">
      <small class="text-muted">Last updated 3 mins ago</small>
    </div>
  </div>

  </div> -->

<!-- </div> -->

</body>

</html>