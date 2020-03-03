<?php

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Camagru</title>
    <link rel="icon" href="../assets/Camagru-favicon.png">
    <link rel="stylesheet" href="../styles/sign.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand h6" href="#">Camagru</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About US</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link signin" href="forms/signin.html">Sign in</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <section class="main">
        <img class="img-fluid group" src="../assets/group.svg" alt="Responsive image">
        <div class="form">
            <h1>GET STARTED</h1>
            <h3>Join a community of over 1 million people </br>
                all sharing and growing the feed.</h3>
            <form class="login-form">
                <div class="form-group">
                    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Your email">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="formGroupExampleInput" placeholder="Password">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="formGroupExampleInput" placeholder="Repeat password">
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                    <label class="custom-control-label" for="customCheck1">Remember your password</label>
                </div>
                <button type="button" class="btn btn-primary btn-lg">Sign in</button>
            </form>
        </div>
    </section>
    <footer>
    </footer>
</body>

</html>