<?php
@require('../init.php');


echo $_GET['link'];

var_dump($_GET['path']);
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
  <script src="../JS/comment.js"></script>
</head>

<body>

<div id="cmt-img">

</div>

<h3>Write a comment...</h3>
<input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="input" value="">

<div class="comments"></div>

</body>

</html>