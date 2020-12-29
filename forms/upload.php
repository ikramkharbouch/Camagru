<?php
@require('../init.php');

var_dump($_SESSION['auth']);
var_dump($_SESSION['id']);

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
</head>

<body>

<input type="file" name="file" accept="image/jpeg, image/png" id="uploaded">
<!-- <input type="submit" name="submit" value="Upload" id="uploaded"> -->
<button id="upload" type="button" class="btn btn-save ml-3 mt-4">Upload</button>

</body>

</html>