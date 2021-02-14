<?php
  require('../init.php');

  if (!isset($_SESSION['auth'])) 
  {
    header("Location: ./singin.php");
    exit();
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Camagru</title>
  <link rel="stylesheet" href="../styles/welcome.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="../JS/camera.js"></script>
  <script src="../JS/menu.js"></script>
</head>

<body>

  
  <?php include '../components/menu.html';?>

  <!-- Add all page content inside this div if you want the side nav to push page content to the right (not used if you only want the sidenav to sit on top of the page -->
  <div class="main">
    <div class="camera d-flex flex-column">
      <video id="video">Video stream not available.</video>
      <div class="dropdown text-left ml-3 mt-3">
        <p>Choose a filter</p>
        <!-- <button class="btn btn-secondary">Filters</button> -->
        <!-- <div class="dropdown-content"> -->
          <label>Love</label><br /><input type="radio" name="filter" value="Love" id="filter1"><br />
          <label>Happy</label><br /><input type="radio" name="filter" value="Happy" id="filter2"> <br />
          <label>Sad</label><br /><input type="radio" name="filter" value="Sad" id="filter3"> <br />
          <!-- <p id="filter1" value="love">Love</p>
          <p id="filter2" value="happy">Happy</p>
          <p id="filter3" value="sad">Sad</p> -->
        <!-- </div> -->
      </div>
    
    <div class="d-flex flex-row">
        <!-- <button id="startbutton" type="button" class="btn btn-take ml-3 mt-4">Take photo</button> -->
        <button id="savebutton" type="button" class="btn btn-save ml-3 mt-4" disabled>Save</button>
        <!-- <button id="uploadbutton" type="button" class="btn btn-save ml-3 mt-4">Upload</button> -->
        <a href="./upload.php" class="btn btn-save ml-3 mt-4" role="button">Upload</a>
    </div>
    <canvas id="canvas">
    </canvas>
    </div>

    <div class="pictures" id="pictures">
      <h3 class="mt-4 text-center">Your shots</h3>
    <div class="output" id="output">
      <img id="photo" alt="The screen capture will appear in this box.">
    </div>
    <div id="x"></div>
    <div id="my-image"></div>
    </div>
    
  </div>
  </div>

  <footer>Ikrkharb Camagru !SilentCorner 2021-2022</footer>
</body>

</html>