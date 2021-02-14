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
  <link rel="stylesheet" href="../styles/gallery.css">
  <link rel="stylesheet" href="../styles/welcome.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
  <script src="../JS/comment.js"></script>
  <script src="../JS/menu.js"></script>
  <link rel="stylesheet" href="../styles/comment.css">
</head>

<body>

<?php include '../components/menu.html';?>

<div class="container d-flex flex-column flex-wrap">

<!-- Div of the image -->
<div id="cmt-img" class="mt-10"></div>

<!-- Div of the comment section -->

<div class="cmt-section mt-15">

<!-- Div of the upper assets -->

<div class="upper-div d-flex flex-row">
  <button class="btn btn-primary btn" id="sharebutton">Share On Facebook</button>
  <img src="../assets/heart-32.png" alt="" class="heart-icon">
  <span></span>
</div>

<!-- Div of the lower component -->

<div class="smaller" id="smaller">

<h3 class="fs-3">Comments</h3>
<form>
  <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="input" value="" required>
  <button type="submit" class="btn btn-primary btn custom-btn" id="comment">Comment</button>
</form>
<div class="comments" id="comments">
</div>

</div>

</div>

</div>

<footer style="position: fixed;">!Silent corner 1337 2021 Covid-19 ikrkharb</footer>
</body>

</html>