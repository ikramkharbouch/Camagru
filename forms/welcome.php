<?php


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
      <a href="#">Logout</a>
    </div>

  <!-- Use any element to open the sidenav -->
  <span onclick="openNav()"><i class="fas fa-bars"></i>
</span>

<div class="user-details d-flex flex-row">
<p>Ikram Kharbouch</p>
<img src="../assets/avatar.png" alt="Avatar" class="avatar">
</div>


  <!-- Add all page content inside this div if you want the side nav to push page content to the right (not used if you only want the sidenav to sit on top of the page -->
  <div id="main">
  <div class="camera">
    <video id="video">Video stream not available.</video>
    <button id="startbutton" type="button" class="btn btn-success">Take photo</button> 
  </div>
  <canvas id="canvas">
  </canvas>
  <div class="output">
    <img id="photo" alt="The screen capture will appear in this box."> 
  </div>
  <div id="my-image"></div>

  <div class="emojis">
    <h3>Add Emojis</h3>
    <div class="container">
  <div class="row row-cols-2">
    <div class="col"><img src="../assets/emoji-inlove.png" alt=""></div>
    <div class="col"><img src="../assets/emoji-inlove.png" alt=""></div>
    <div class="col"><img src="../assets/emoji-inlove.png" alt=""></div>
    <div class="col"><img src="../assets/emoji-inlove.png" alt=""></div>
    <div class="col"><img src="../assets/emoji-inlove.png" alt=""></div>
    <div class="col"><img src="../assets/emoji-inlove.png" alt=""></div>
    <div class="col"><img src="../assets/emoji-inlove.png" alt=""></div>
    <div class="col"><img src="../assets/emoji-inlove.png" alt=""></div>
    <div class="col"><img src="../assets/emoji-inlove.png" alt=""></div>
    <div class="col"><img src="../assets/emoji-inlove.png" alt=""></div>
  </div>
</div>
  </div>
  </div>
  </div>
</body>

</html>
