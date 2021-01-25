<?php
@require('../init.php');

if (!isset($_SESSION['auth']) && $_SESSION['auth'] == false) 
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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <script src="../JS/upload.js"></script>
  <script src="../JS/menu.js"></script>
</head>

<body>

<?php include '../components/menu.html';?>

<!-- <form method="POST" action="../api/post/upload.php" id="profileData" enctype="multipart/form-data"> -->

<form method="post" enctype="multipart/form-data">
  <input type="file" name="files[]" accept="image/jpeg, image/png, image/jpg" id="uploaded" multiple>
  <!-- <input type="submit" name="submit" value="Upload" id="uploaded"> -->
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
</form>

<!-- </form> -->


  <!-- <input type="file" name="files[]" multiple />
  <input type="submit" value="Upload File" name="submit" /> -->


<img id="output" width="200" />	

</body>

</html>