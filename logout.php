<?php
@require('./init.php');

session_destroy();
?>

<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Camagru</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<style>
body {
    text-align: center;
}

.main {
    margin: 0 auto;
}

a {
    text-decoration: none;
}

.custom-btn {
    background-color: #9364A8;
    /* border: 0; */
    /* padding: 16px 40px 16px 40px; */
    color : #fff;
}
</style>
</head>

<body>

<div class="main">
<h1> You can sign in or go to the landing page </h1>
<a href="./forms/signin.php"><button type="button" class="btn custom-btn">Sign In</button></a>
<a href="./forms/signup.php"><button type="button" class="btn btn-secondary">Sign Up</button></a>

</div>


</body>
</html>


