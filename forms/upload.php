<?php
require('../init.php');

if (!isset($_SESSION['auth'])) 
{
  header("Location: ../404.php");
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
  <link rel="stylesheet" href="../styles/upload.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="../JS/upload.js"></script>
  <script src="../JS/menu.js"></script>
</head>

<body>

<?php include '../components/menu.html';?>

<!-- <form method="POST" action="../api/post/upload.php" id="profileData" enctype="multipart/form-data"> -->

<div class="main">

  <p id="error-message"></p>
  
  <div class="upload-img">
    <img id="output" />
  </div>
  <div class="d-flex flex-row elements">
    
    <form method="post" enctype="multipart/form-data">
      <div class="mb-3">
        <input type="file" name="files[]" accept="image/jpeg, image/png, image/jpg" id="uploaded" class="form-control" multiple>
      </div>
      <!-- <input type="submit" name="submit" value="Upload" id="uploaded"> -->
      <div class="d-flex flex-column">
  
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
        <button id="upload" type="submit" value="Upload File" class="btn btn-save ml-3 mt-4" disabled>Upload</button>
  
      </div>
    </form>
</div>


</div>

<footer style="position: fixed;">Ikrkharb Camagru !SilentCorner 2021-2022</footer>

</body>

</html>