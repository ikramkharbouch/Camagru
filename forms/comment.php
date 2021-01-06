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


<h3 class="fs-4">Comments</h3>
<input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="input" value="">
<button type="submit" value="" class="btn btn-primary btn-lg custom-btn" id="comment">Comment</button>

<div class="comments" id="comments"></div>

</div>

</div>


</body>

</html>