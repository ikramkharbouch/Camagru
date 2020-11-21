<?php
session_start();

if(isset($_SESSION['blah']) && !empty($_SESSION['blah'])) {
   echo 'Set and not empty, and no undefined index error!';
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
    <link rel="icon" href="./assets/Camagru-favicon.png" />
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
     <a href="./forms/signup.php" class="btn btn-primary btn-lg" role="button">Sign Up</a>

    </div>
    
      <!-- <div class="content">
        <div class="title">
          <h3>Hello.</h3>
        </div>
      <div class="text">
        <h1>Lorem ipsum dolor sit amet consectetur
       <br>adipisicing elit</h1>
      </div>

       <div class="start">
         <a href="./forms/signup.php"><p>Get Started</p></a>
         <img src="./assets/arrow.svg" width="20">
       </div>

    </div> -->

    <?php include './components/footer.html';?>
  </body>
</html>