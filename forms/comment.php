<?php
@require('../init.php');


echo $_GET['link'];

// var_dump($_GET['path']);
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
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <script src="../JS/comment.js"></script>
  <link rel="stylesheet" href="../styles/comment.css">
</head>

<body>

<?php include '../components/menu.html';?>

<div class="container d-flex flex-row align-content-center flex-wrap">

<div id="cmt-img" class="mt-10">

</div>

<div class="cmt-section mt-15">

<div class="smaller">
<h3 class="fs-3">Comments</h3>
<input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="input" value="">
<button type="submit" value="" class="btn btn-primary btn custom-btn" id="comment">Comment</button>

<div class="comments" id="comments"></div>

</div>


</div>

</div>


</body>

</html>