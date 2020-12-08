<?php
@require('../init.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome Page</title>
  <link rel="stylesheet" href="../styles/welcome.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <script src="./camera.js"></script>
</head>

<body>

  <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <h1>Camagru</h1>
    <a href="../index.php">Home</a>
    <a href="#">Gallery</a>
    <a href="#">Profile</a>
    <a href="#">Settings</a>
    <a href="../logout.php">Logout</a>
  </div>

  <!-- Use any element to open the sidenav -->
  <span onclick="openNav()"><i class="fas fa-bars"></i>
  </span>

  <div class="user-details d-flex flex-row">
    <img src="../assets/avatar.png" alt="Avatar" class="avatar">
    <p class="font-weight-bold ml-1">Ikram Kharbouch</p>
  </div>


  <!-- Add all page content inside this div if you want the side nav to push page content to the right (not used if you only want the sidenav to sit on top of the page -->
  <div class="main d-flex flex-row">
    <div class="camera d-flex flex-column">
      <video id="video">Video stream not available.</video>
      <div class="dropdown text-left ml-3 mt-3">
        <p>Choose a filter</p>
        <button class="btn btn-secondary">Filters</button>
        <div class="dropdown-content">
          <p>Love</p>
          <p>Happy</p>
          <p>Sad</p>
        </div>
      </div>
    <div class="d-flex flex-row">
        <button id="startbutton" type="button" class="btn btn-take ml-3 mt-4">Take photo</button>
        <button id="savebutton" type="button" class="btn btn-save ml-3 mt-4">Save</button>
    </div>
    <canvas id="canvas">
    </canvas>
    </div>

    <div class="pictures">
      <h3 class="mt-4 text-center">Your shots</h3>
    <div class="output">
      <img id="photo" alt="The screen capture will appear in this box.">
    </div>
    <div id="my-image"></div>
    </div>
  </div>
  </div>

</body>

</html>