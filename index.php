<?php

@require('./init.php');

if (isset($_SESSION['auth']) && $_SESSION['auth'] == true) 
{
  header("Location: ./forms/welcome.php");
  exit();
}

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Camagru</title>
    <link rel="stylesheet" href="./styles/main.css" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">
    <link
      href="https://fonts.googleapis.com/css?family=Raleway&display=swap"
      rel="stylesheet"
    />
    <link href="https://fonts.googleapis.com/css2?family=Jacques+Francois&display=swap" rel="stylesheet">

    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
      integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
      crossorigin="anonymous"
    />
    <link href="https://fonts.googleapis.com/css2?family=Jacques+Francois&family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">
  </head>

  <body>
    <?php include './components/header.html';?>
    <!-- <img src="./assets/landing-page-cover.png" alt=""> -->
 
    <div class="content">
     <h1>Welcome to Camagru</h1>
     <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Modi sint iste qui nulla illum molestias, at ratione pariatur nostrum, corrupti, laudantium et cum dolorum. Nesciunt magni perferendis iusto sed libero!</p>
     <a href="./forms/signup.php" class="btn btn-primary custom-btn" role="button">Sign Up</a>
    </div>

    <footer style="">!Silent corner 1337 2021 Covid-19 ikrkharb</footer>
  </body>
</html>