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
        "username" => test_input($_POST['username']),
        "pass" => test_input($_POST['password']),
    );

    // VALIDATE INPUT

    $filters = array(
        "email" => FILTER_VALIDATE_EMAIL,
        "username" => array(
            "filter" => FILTER_CALLBACK,
            "options" => "ucwords"
        ),
        "pass" => array(
            "filter" => FILTER_VALIDATE_REGEXP,
            "options" => array(
                "regexp" => "/^[a-z-0-9]+/i"
            ),
        )
    );

    $results = filter_var_array($data, $filters);

    foreach ($results as $key => $value) {
        if (empty($value)) {
            $error = 1;
            echo "Error in ". $key . " input.";
            break;
        }
    }

    //  CHECK BEFORE INSERTING

    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute([$data['username']]);
    $userCount = $stmt->rowCount();

    if ($userCount != 0) {
        echo "This username is already used";
    }
    else if ($userCount == 0 && $error == 0) {
         // INSERT DATA

        $sql = 'INSERT INTO users(email, username, pass) VALUES(:email, :username, :pass)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);
        echo 'Post Added';
    }
    
    $pdo = null;
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
<?php include '../components/header.html'; ?>

    <section class="main">
        <img class="img-fluid group" src="../assets/group.svg" alt="Responsive image">
        <div class="form">
            <h1>GET STARTED</h1>
            <h3>Join a community of over 1 million people </br>
                all sharing and growing the feed.</h3>
            <form method="POST" class="login-form">
                <div class="form-group">
                    <input type="text" name="email" class="form-control" placeholder="Your email">
                </div>
                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="Your username">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                </div>
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