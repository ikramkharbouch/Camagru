<?php

$host = "localhost";
$user = "admin";
$password = "D9t9lnkEbzti";
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

    // var_dump($username);
    // var_dump($password);

    $sql = "INSERT INTO users(user, pass)
            VALUES ('$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
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
<?php include '../components/header.html'; ?>

    <section class="main">
        <img class="img-fluid group" src="../assets/group.svg" alt="Responsive image">
        <div class="form">
            <h1>GET STARTED</h1>
            <h3>Join a community of over 1 million people </br>
                all sharing and growing the feed.</h3>
            <form method="POST" class="login-form">
                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="Your username">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                </div>
                <!-- <div class="form-group">
                    <input type="password" class="form-control" id="formGroupExampleInput" placeholder="Repeat password">
                </div> -->
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                    <label class="custom-control-label" for="customCheck1">Agree to the <a class="terms" href="./terms.php">terms and conditions.</a></label>
                </div>
                <button type="submit" class="btn btn-primary btn-lg">Sign up</button>
            </form>
        </div>
    </section>

    <?php include '../components/footer.html'; ?>
</body>

</html>