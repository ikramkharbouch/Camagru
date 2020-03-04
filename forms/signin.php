<?php

$host = "localhost";
$user = "root";
$password = "rootroot";
$db = "camagru";

// Create connection
$conn = new mysqli($host, $user, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    var_dump($username);
    var_dump($password);

    // prepare and bind
    $stmt = $conn->prepare("SELECT * FROM users WHERE `username` = ? AND `password` = ?");
    $stmt->bind_param($username, $password);

    $result = $stmt->execute();

    var_dump($result);

    $stmt->close();
}

$conn->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Camagru</title>
    <link rel="icon" href="/assets/Camagru-favicon.png">
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
                        <a class="nav-link signin" href="forms/signin.php">Sign in</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <section class="main">
        <img class="img-fluid group" src="../assets/group.svg" alt="Responsive image">
        <div class="form">
            <h1>Welcome Back</h1>
            <h3>Camagru is a community of over 1 million </br>
                people all sharing and growing the feed.</h3>
            <form method="POST" class="login-form">
                <div class="form-group">
                    <input type="text" name="username" class="form-control" id="formGroupExampleInput" placeholder="Enter your username...">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" id="formGroupExampleInput" placeholder="Enter your password">
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                    <label class="custom-control-label" for="customCheck1">Remember your password</label>
                </div>
                <button type="submit" class="btn btn-primary btn-lg">Sign in</button>
            </form>
        </div>
    </section>
    <footer>
    </footer>
</body>

</html>
