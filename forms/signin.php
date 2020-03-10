<?php

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $host = 'localhost';
    $user = 'root';
    $password = 'root1234@';
    $dbname = 'camagru';

    // Set DSN
    $dsn = 'mysql:host='.$host.';dbname='.$dbname;

    // Create a PDO instance
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

    // User Input

    $data = array(
        "email" => test_input($_POST['email']),
        "pass" => test_input($_POST['password']),
    );

    print_r($data);

    // COMPARE DATA

    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email AND pass = :pass');
    $stmt->execute($data);
    $userCount = $stmt->rowCount();

    if ($userCount == 1) {
        header('Location:../index.php');
    }
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
    <?php include '../components/header.html'; ?>

    <section class="main">
        <img class="img-fluid group" src="../assets/group.svg" alt="Responsive image">
        <div class="form">
            <h1>Welcome Back</h1>
            <h3>Camagru is a community of over 1 million </br>
                people all sharing and growing the feed.</h3>
            <form method="POST" class="login-form">
                <div class="form-group">
                    <input type="text" name="email" class="form-control" id="formGroupExampleInput" placeholder="Enter your email">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" id="formGroupExampleInput" placeholder="Enter your password">
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="customCheck1" required>
                    <label class="custom-control-label" for="customCheck1">Remember your password</label>
                </div>
                <button type="submit" class="btn btn-primary btn-lg">Sign in</button>
            </form>
        </div>
    </section>

    <?php include '../components/footer.html'; ?>
</body>

</html>
